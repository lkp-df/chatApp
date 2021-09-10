//cette fois on utilise le javascript et non jquery
const pswrdField = document.querySelector(".form  input[type='password']"),
    toogleBtn = document.querySelector(".form .field i");

//sur click on ouvre l'oeil et ferme l'oeil
toogleBtn.onclick = () => {
    if (pswrdField.type == "password") {
        pswrdField.type = "text";
        toogleBtn.classList.add("active");
    } else {
        pswrdField.type = "password";
        toogleBtn.classList.remove("active");
    }
}