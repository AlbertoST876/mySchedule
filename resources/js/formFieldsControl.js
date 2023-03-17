window.onload = function() {
    function initField(check, field) {
        if (check.checked == true) {
            field.removeAttribute("disabled");
            field.classList.add("bg-gray-50");
        } else {
            field.classList.add("bg-gray-300");
        }
    }

    function toggleField(field) {
        field.toggleAttribute("disabled");
        field.classList.toggle("bg-gray-50");
        field.classList.toggle("bg-gray-300");
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
};
