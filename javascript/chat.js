const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendbtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); //eviter la soumission du formulaire via la touche netree du clavier
}

sendbtn.onclick = () => {
    //debut ajax
    let xhr = new XMLHttpRequest(); //creer un objet XML
    xhr.open("POST", "PHP/insertChat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollBottom();
            }
        }
    }

    //envoyer tout le formulaire en ajax
    let formData = new FormData(form); //creons un nouveau objet formData
    xhr.send(formData); //envoie des donnes du formulaire pen php 
}

//arretons la fonction scrollBttom quand l'utilisateur veut scroller vers le haut
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

//definissons un intervalle de temps bien précis chaque 500ms pour afficher l'ensemble des users en bd
setInterval(() => {
    //debut ajax
    let xhr = new XMLHttpRequest(); //creer un objet XML
    xhr.open("POST", "PHP/getChat.php", true);
    xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;

                    //le scroll automatiqueau dernier message
                    if (!chatBox.classList.contains("active")) { //if active not contains in chatBox the scroll to bottom
                        scrollBottom();
                    }
                }
            }
        }
        //envoyer tout le formulaire en ajax
    let formData = new FormData(form); //creons un nouveau objet formData
    xhr.send(formData); //envoie des donnes du formulaire pen php
}, 500)


//scroller automatiquement au dernier messages
function scrollBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}