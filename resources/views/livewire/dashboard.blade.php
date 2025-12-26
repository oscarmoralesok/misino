<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Dashboard') }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <!-- Top Section: Stats Cards and Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            
            <!-- Left Column: Stats Cards (2x2 Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Income -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Ingresos (Mes)</div>
                    <div class="text-3xl font-bold text-green-500">
                        ${{ number_format($income, 2) }}
                    </div>
                </div>

                <!-- Expense -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Gastos (Mes)</div>
                    <div class="text-3xl font-bold text-red-500">
                        ${{ number_format($expense, 2) }}
                    </div>
                </div>

                <!-- Balance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Balance (Mes)</div>
                    <div class="text-3xl font-bold {{ $balance >= 0 ? 'text-blue-500' : 'text-red-500' }}">
                        ${{ number_format($balance, 2) }}
                    </div>
                </div>

                <!-- Historical Income -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Ingresos (Histórico)</div>
                    <div class="text-3xl font-bold text-teal-500">
                        ${{ number_format($historicalIncome, 2) }}
                    </div>
                </div>
            </div>

            <!-- Right Column: Chart -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 h-full flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Ingresos/Egresos Anuales</h3>
                    <div id="incomeExpenseChart" class="flex-1" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>


    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        const options = {
            series: [{
                name: 'Ingresos',
                data: @json($incomeData)
            }, {
                name: 'Egresos',
                data: @json($expenseData)
            }],
            chart: {
                height: 250,
                type: 'area',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: @json($chartLabels),
                labels: {
                    style: {
                        colors: '#9ca3af' // gray-400
                    }
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#9ca3af'
                    },
                    formatter: function (value) {
                         // Short number format for better mobile fit e.g. 1.2k
                        return value >= 1000 ? '$' + (value / 1000).toFixed(1) + 'k' : '$' + value;
                    }
                }
            },
            colors: ['#3b82f6', '#10b981'], // Blue for Income, Emerald for Expense
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            grid: {
                borderColor: '#e5e7eb', // gray-200
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                },   
            },
            tooltip: {
                theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
                y: {
                    formatter: function (val) {
                        return "$" + new Intl.NumberFormat('en-US').format(val)
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            }
        };

        if (document.documentElement.classList.contains('dark')) {
            options.grid.borderColor = '#374151'; // gray-700
            options.chart.foreColor = '#9ca3af';
        }

        const chart = new ApexCharts(document.querySelector("#incomeExpenseChart"), options);
        chart.render();
    });
</script>
@endpush
