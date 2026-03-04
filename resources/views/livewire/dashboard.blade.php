<div>
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Panel de Control</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Resumen general de tu actividad financiera y eventos.</p>
            </div>
        </div>

        <div class="space-y-8 animate-translate-up">
        <!-- Top Section: Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Income Card -->
            <div class="premium-card p-8 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-24 h-24 text-primary-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Ingresos (Mes)</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-4xl font-display font-bold text-primary-600 dark:text-primary-400">${{ number_format($income, 0) }}</span>
                        <span class="text-xs font-bold text-green-500/80">+12%</span>
                    </div>
                </div>
            </div>

            <!-- Expense Card -->
            <div class="premium-card p-8 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-24 h-24 text-accent-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11 15h2v2h-2zm0-8h2v6h-2zm1-5C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Gastos (Mes)</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-4xl font-display font-bold text-accent-600 dark:text-accent-400">${{ number_format($expense, 0) }}</span>
                    </div>
                </div>
            </div>

            <!-- Balance Card -->
            <div class="premium-card p-8 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-24 h-24 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Balance (Mes)</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-4xl font-display font-bold {{ $balance >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-accent-600' }}">${{ number_format($balance, 0) }}</span>
                    </div>
                </div>
            </div>

            <!-- Historical Card -->
            <div class="premium-card p-8 group relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-24 h-24 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14H11V7h2v9z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Total Acumulado</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-4xl font-display font-bold text-blue-600 dark:text-blue-400">${{ number_format($historicalIncome, 0) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Section: Chart and Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Chart Column -->
            <div class="lg:col-span-2 premium-card p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-10">
                    <div>
                        <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white">Flujo de Caja Anual</h3>
                        <p class="text-sm text-gray-400 mt-1 font-medium">Comparativa mensual de ingresos y egresos.</p>
                    </div>
                    <div class="flex items-center space-x-4 bg-gray-50/50 dark:bg-gray-800/50 p-2 px-4 rounded-xl border border-gray-100 dark:border-gray-700/50">
                        <div class="flex items-center">
                            <span class="w-2.5 h-2.5 rounded-full bg-primary-500 mr-2 shadow-[0_0_10px_rgba(64,137,150,0.4)]"></span>
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Ingresos</span>
                        </div>
                        <div class="flex items-center pl-4 border-l border-gray-200 dark:border-gray-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-accent-400 mr-2 shadow-[0_0_10px_rgba(236,72,153,0.4)]"></span>
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Egresos</span>
                        </div>
                    </div>
                </div>
                <div id="incomeExpenseChart" style="min-height: 350px;"></div>
            </div>

            <!-- Recent Info Placeholder (Can be refined later) -->
            <div class="premium-card p-8">
                <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">Actividad Reciente</h3>
                <div class="space-y-6">
                    <p class="text-gray-400 text-center italic text-sm py-10">Cargando últimos movimientos...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        const isDark = document.documentElement.classList.contains('dark');
        
        const options = {
            series: [{
                name: 'Ingresos',
                data: @json($incomeData)
            }, {
                name: 'Egresos',
                data: @json($expenseData)
            }],
            chart: {
                height: 350,
                type: 'area',
                fontFamily: 'Inter, sans-serif',
                toolbar: { show: false },
                sparkline: { enabled: false },
                zoom: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3,
                colors: ['#408996', '#ec4899'] // primary-500, accent-500
            },
            xaxis: {
                categories: @json($chartLabels),
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: {
                        colors: '#9ca3af',
                        fontSize: '11px',
                        fontWeight: 600
                    }
                }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: '#9ca3af',
                        fontSize: '11px',
                        fontWeight: 600
                    },
                    formatter: function (value) {
                        return '$' + (value / 1000).toFixed(1) + 'k';
                    }
                }
            },
            colors: ['#408996', '#ec4899'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.15,
                    opacityTo: 0.02,
                    stops: [0, 90, 100]
                }
            },
            grid: {
                borderColor: isDark ? '#374151' : '#f3f4f6',
                strokeDashArray: 4,
                padding: { left: 0, right: 0, bottom: 0 }
            },
            legend: { show: false },
            tooltip: {
                theme: isDark ? 'dark' : 'light',
                x: { show: true },
                y: {
                    formatter: function (val) {
                        return "$" + new Intl.NumberFormat('es-AR').format(val)
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#incomeExpenseChart"), options);
        chart.render();
    });
</script>
@endpush
