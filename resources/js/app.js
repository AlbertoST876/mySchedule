import 'flowbite';

window.onload = function() {
    function init(check, field) {
        if (check.checked == true) {
            field.removeAttribute("disabled");
            field.classList.add("bg-gray-50");
        } else {
            field.setAttribute("disabled", "");
            field.classList.add("bg-gray-300");
        }
    }

    function enableDisableField(field) {
        field.toggleAttribute("disabled");
        field.classList.toggle("bg-gray-50");
        field.classList.toggle("bg-gray-300");
    }

    let colorCheck = document.querySelector("#color-checkbox"),
        color = document.querySelector("#color"),
        rememberCheck = document.querySelector("#remember-checkbox"),
        remember = document.querySelector("#remember"),
        datetime = document.querySelector("#datetime");

    init(colorCheck, color);
    init(rememberCheck, remember);

    colorCheck.onclick = function() {
        enableDisableField(color);
    };

    rememberCheck.onclick = function() {
        enableDisableField(remember);
    };

    remember.addEventListener("focus", () => {
        remember.setAttribute("max", datetime.value);
    });
};
