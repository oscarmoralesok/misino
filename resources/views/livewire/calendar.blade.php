<div>
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Calendario de Eventos</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Visualización mensual de tus compromisos confirmados.</p>
            </div>
        </div>
        <div class="premium-card overflow-hidden">
            <div class="p-4 md:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm">
                <div id="calendar" wire:ignore class="premium-calendar"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('livewire:navigated', function() {
        initCalendar();
    });

    document.addEventListener('DOMContentLoaded', function() {
        initCalendar();
    });

    function initCalendar() {
        var calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            },
            events: @json($events),
            eventClassNames: 'premium-event-pill',
            dayMaxEvents: true,
            height: 'auto',
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            }
        });
        calendar.render();
    }
</script>

<style>
    /* Premium Calendar Styling */
    .premium-calendar {
        --fc-border-color: rgba(229, 231, 235, 0.5);
        --fc-button-bg-color: transparent;
        --fc-button-border-color: rgba(229, 231, 235, 1);
        --fc-button-hover-bg-color: #f9fafb;
        --fc-button-active-bg-color: #f3f4f6;
        --fc-today-bg-color: rgba(64, 137, 150, 0.05);
        --fc-page-bg-color: transparent;
        font-family: 'Inter', sans-serif;
    }

    .dark .premium-calendar {
        --fc-border-color: rgba(55, 65, 81, 0.5);
        --fc-button-border-color: rgba(55, 65, 81, 1);
        --fc-button-hover-bg-color: rgba(55, 65, 81, 0.5);
        --fc-button-active-bg-color: rgba(55, 65, 81, 0.8);
        --fc-today-bg-color: rgba(64, 137, 150, 0.15);
    }

    /* Header Toolbar */
    .fc .fc-toolbar-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.25rem !important;
        color: #1f2937;
    }
    .dark .fc .fc-toolbar-title { color: #f9fafb; }

    /* Buttons */
    .fc .fc-button {
        padding: 0.5rem 1rem !important;
        font-size: 0.8125rem !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.025em !important;
        border-radius: 0.75rem !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        color: #6b7280 !important;
        box-shadow: none !important;
    }
    .dark .fc .fc-button { color: #9ca3af !important; }

    .fc .fc-button-primary:not(:disabled):active, 
    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #408996 !important;
        border-color: #408996 !important;
        color: white !important;
    }

    .fc .fc-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
    }

    /* Grid Styling */
    .fc-theme-standard td, .fc-theme-standard th {
        border-color: var(--fc-border-color) !important;
    }
    
    .fc .fc-col-header-cell {
        padding: 12px 0 !important;
        background: #f9fafb;
    }
    .dark .fc .fc-col-header-cell { background: #111827; }

    .fc .fc-col-header-cell-cushion {
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        color: #9ca3af !important;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    /* Event Styling */
    .premium-event-pill {
        border: none !important;
        padding: 2px 4px !important;
        background: transparent !important;
    }

    .fc-event {
        cursor: pointer;
        border-radius: 6px !important;
        padding: 4px 8px !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        transition: all 0.2s !important;
    }

    /* Colores por tipo de evento (simulado o basado en el color del evento) */
    .fc-daygrid-event {
        background: #408996 !important; /* Primary */
        border-left: 3px solid #1e40af !important;
        color: white !important;
    }

    .fc-daygrid-event:hover {
        filter: brightness(110%);
        transform: scale(1.02);
    }

    /* Today highlight */
    .fc .fc-day-today {
        background-color: var(--fc-today-bg-color) !important;
    }

    .fc .fc-daygrid-day-number {
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 8px !important;
        color: #4b5563;
    }
    .dark .fc .fc-daygrid-day-number { color: #9ca3af; }

    /* Remove focus outlines */
    .fc .fc-button:focus, .fc .fc-button-primary:focus {
        box-shadow: 0 0 0 2px rgba(64, 137, 150, 0.2) !important;
    }
</style>
@endpush
</div>
