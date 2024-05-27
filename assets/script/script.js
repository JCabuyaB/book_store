let eye1 = document.getElementById("eye1");
let eye2 = document.getElementById("eye2");

let pass1 = document.getElementById("password1");
let pass2 = document.getElementById("password2");

function cambiarEstado(input, eye) {
    if (input.type === "password") {
        input.type = "text";
        eye.classList.toggle("bi-eye-slash-fill");
        eye.classList.toggle("bi-eye-fill");
    } else {
        input.type = "password";
        eye.classList.toggle("bi-eye-slash-fill");
        eye.classList.toggle("bi-eye-fill");
    }
}

eye1.addEventListener("click", function () {
    cambiarEstado(pass1, eye1);
});
eye2.addEventListener("click", function () {
    cambiarEstado(pass2, eye2);
});
