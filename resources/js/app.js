import 'flowbite';

window.onload = function() {
    if (window.location.pathname == "/events" || window.location.pathname == "/events/edit") {
        function initField(check, field) {
            if (check.checked == true) {
                field.removeAttribute("disabled");
                field.classList.add("block");
            } else {
                field.classList.add("hidden");
            }
        }

        function toggleField(field) {
            field.toggleAttribute("disabled");
            field.classList.toggle("block");
            field.classList.toggle("hidden");
        }

        let colorCheck = document.querySelector("#color-checkbox");
        let color = document.querySelector("#color");
        let rememberCheck = document.querySelector("#remember-checkbox");
        let remember = document.querySelector("#remember");
        let date = document.querySelector("#datetime");

        initField(colorCheck, color);
        initField(rememberCheck, remember);

        colorCheck.onclick = function() { toggleField(color); };
        rememberCheck.onclick = function() { toggleField(remember); };
        remember.addEventListener("focus", function() { remember.setAttribute("max", date.value); });
    }

    let events = document.querySelectorAll("*[data-color]");

    if (events.length > 0) {
        for (let i = 0; i < events.length; i++) {
            events[i].setAttribute("style", "background-color: " + events[i].getAttribute("data-color"))
        }
    }
};
