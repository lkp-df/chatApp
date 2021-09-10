const form = document.querySelector(".login form"),
    continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt"); //c'est la qu'on affiche les erreurs

//pour la soumission du formulaire
form.onsubmit = (e) => {
        e.preventDefault(); //preventing fomr from submitting
    }
    //pour le bouton continuer vers le chat
continueBtn.onclick = () => {
    //debut ajax
    let xhr = new XMLHttpRequest(); //creer un objet XML
    xhr.open("POST", "PHP/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                //si le resultat est de succes
                if (data == "succes") {
                    window.location.href = "user.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    console.log(data)
                }
            }
        }
    }

    //envoyer tout le formulaire en ajax
    let formData = new FormData(form); //creons un nouveau objet formData
    xhr.send(formData); //envoie des donnes du formulaire pen php 
}