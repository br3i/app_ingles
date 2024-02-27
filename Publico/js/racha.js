url = window.location.href;
if (url.includes('modulo=racha')) {
    const startDateStr  = document.getElementById('start').textContent.trim();
    const endDateStr  = document.getElementById('end').textContent.trim();
    
    // Convertir las cadenas de fecha en objetos Date
    const startDate = new Date(startDateStr);
    const endDate = new Date(endDateStr);

    const calendarsDiv = document.getElementById('calendars');

    // Crear y mostrar el calendario para cada mes
    calendarsDiv.innerHTML = '';

    let currentDate = new Date(startDate);

    while (currentDate <= endDate) {
        const calendarDiv = document.createElement('div');
        calendarDiv.classList.add('calendar');

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Mostrar el nombre del mes y el año
        const monthDiv = document.createElement('div');
        monthDiv.classList.add('month');
        const monthName = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(currentDate);
        const year = currentDate.getFullYear();
        monthDiv.textContent = `${monthName} ${year}`;
        calendarDiv.appendChild(monthDiv);

        // Mostrar los nombres de los días de la semana
        const weekdaysDiv = document.createElement('div');
        weekdaysDiv.classList.add('weekdays');
        for (let day of daysOfWeek) {
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            dayElement.textContent = day;
            weekdaysDiv.appendChild(dayElement);
        }
        calendarDiv.appendChild(weekdaysDiv);

        // Mostrar los días del mes
        const daysDiv = document.createElement('div');
        daysDiv.classList.add('days');

        let startOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        let startDayOfWeek = startOfMonth.getDay(); // Obtener el día de la semana del primer día del mes

        // Agregar espacios vacíos para compensar el desfase
        for (let i = 0; i < startDayOfWeek; i++) {
            const emptyDayElement = document.createElement('div');
            emptyDayElement.classList.add('day', 'empty');
            daysDiv.appendChild(emptyDayElement);
        }

        let endOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

        while (startOfMonth <= endOfMonth) {
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');

            // Marcar los días dentro del rango con un color diferente
            if (startOfMonth >= startDate && startOfMonth <= endDate) {
                dayElement.classList.add('highlight');
            }

            dayElement.textContent = startOfMonth.getDate();
            daysDiv.appendChild(dayElement);

            // Avanzar al siguiente día
            startOfMonth.setDate(startOfMonth.getDate() + 1);
        }

        calendarDiv.appendChild(daysDiv);
        calendarsDiv.appendChild(calendarDiv);

        // Avanzar al siguiente mes
        currentDate.setMonth(currentDate.getMonth() + 1);
    }
}
