import "flowbite";

window.onload = function() {
    let events = document.querySelectorAll("*[data-color]");

    if (events.length > 0) {
        events.forEach(event => {
            event.style.backgroundColor = event.getAttribute("data-color");
        });
    }

    let colorCheck = document.querySelector("#color-checkbox");
    let color = document.querySelector("#color");
    let rememberCheck = document.querySelector("#remember-checkbox");
    let remember = document.querySelector("#remember");
    let date = document.querySelector("#datetime");

    if (date instanceof Element) {
        function initField(check, field) {
            if (check.checked == true) {
                field.removeAttribute("disabled");
                field.classList.remove("hidden");
                field.classList.add("block");
            }
        }

        function toggleField(field) {
            field.toggleAttribute("disabled");
            field.classList.toggle("hidden");
            field.classList.toggle("block");
        }

        initField(colorCheck, color);
        initField(rememberCheck, remember);

        colorCheck.onclick = function() { toggleField(color); };
        rememberCheck.onclick = function() { toggleField(remember); };
        remember.addEventListener("focus", function() { remember.setAttribute("max", date.value); });
    }

    let prevEvents = document.querySelector("#prevEvents");
    let nextEvents = document.querySelector("#nextEvents");

    if (prevEvents instanceof Element && nextEvents instanceof Element) {
        prevEvents.addEventListener("toggle", function() { localStorage.setItem("prevEventsOpen", prevEvents.open); });
        nextEvents.addEventListener("toggle", function() { localStorage.setItem("nextEventsOpen", nextEvents.open); });

        if (localStorage.getItem("prevEventsOpen") == "true") { prevEvents.open = true; }
        if (localStorage.getItem("nextEventsOpen") == "true") { nextEvents.open = true; }
    }

    let deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');

    if (deleteButtons.length > 0) {
        deleteButtons.forEach(function(button) {
            button.onclick = function() { document.getElementById("deleteEventId").value = button.getAttribute("data-event-id"); };
        });
    }
};
