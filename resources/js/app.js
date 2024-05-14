import "./bootstrap";
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

    function toggleOpen(tag, name) {
        if (tag instanceof Element) {
            tag.addEventListener("toggle", function() { localStorage.setItem(name, tag.open); });

            if (localStorage.getItem(name) == "true") { tag.open = true; }
        }
    }

    toggleOpen(document.querySelector("#prevEvents"), "prevEventsOpen");
    toggleOpen(document.querySelector("#nextEvents"), "nextEventsOpen");

    let deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');

    if (deleteButtons.length > 0) {
        deleteButtons.forEach(function(button) {
            button.onclick = function() { document.getElementById("deleteEventId").value = button.getAttribute("data-event-id"); };
        });
    }
};
