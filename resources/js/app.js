import "./bootstrap";

window.onload = function() {
    // Colorear los eventos
    let events = document.querySelectorAll("*[data-color]");

    if (events.length > 0) {
        events.forEach(event => {
            event.style.backgroundColor = event.getAttribute("data-color");
        });
    }

    // Controles de edición de los eventos
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

    // Recordar si las categorias de eventos pasados o proximos están desplegados o sin desplegar
    function toggleOpen(tag, name) {
        if (tag instanceof Element) {
            tag.addEventListener("toggle", function() { localStorage.setItem(name, tag.open); });

            if (localStorage.getItem(name) == "true") {
                tag.open = true;
            }
        }
    }

    toggleOpen(document.querySelector("#prevEvents"), "prevEventsOpen");
    toggleOpen(document.querySelector("#nextEvents"), "nextEventsOpen");

    // Actualiza el modal de eliminacion para eliminar el evento seleccionado
    let deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');

    if (deleteButtons.length > 0) {
        deleteButtons.forEach(deleteButton => {
            deleteButton.onclick = function() { document.getElementById("deleteEventId").value = deleteButton.getAttribute("data-event-id"); };
        });
    }

    // Guarda la posición del scroll al borrar un evento y vuelve a dicha posición
    function saveScrollPosition() {
        localStorage.setItem("eventsScrollPosition", window.scrollY);
    }

    function restoreScrollPosition() {
        let scrollPosition = localStorage.getItem("eventsScrollPosition");

        if (scrollPosition != null) {
            window.scrollTo(0, parseInt(scrollPosition));
            localStorage.removeItem("eventsScrollPosition");
        }
    }

    let deleteForm = document.querySelector("#deleteModal form");

    if (deleteForm instanceof Element) {
        deleteForm.onsubmit = function() { saveScrollPosition(); };

        restoreScrollPosition();
    }
};
