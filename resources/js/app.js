import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datetimepicker", {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        // 其他选项...
    });

    flatpickr("#open_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        // 其他选项...
    });

    flatpickr("#close_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        // 其他选项...
    });
});