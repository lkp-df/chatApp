const searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button"),
    userList = document.querySelector(".users .users-list");

//on clique sur le btoun de rechere pour afficher la barre de recherche
searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    //on vide la barre de recherche
    searchBar.value = "";
}

//pour chercher un utiliseur un bd avec input
searchBar.onkeyup = () => {
    let searchUser = searchBar.value;

    if (searchUser != "") {
        //debut ajax
        let xhr = new XMLHttpRequest(); //creer un objet XML
        xhr.open("POST", "PHP/searchUsers.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    userList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchUser=" + searchUser); //on envoie l'element a chercher vers la bd pour la recherche

    } else { searchBar.classList.remove("active"); }

}


//definissons un intervalle de temps bien précis chaque 500ms pour afficher l'ensemble des users en bd
setInterval(() => {
    //debut ajax
    let xhr = new XMLHttpRequest(); //creer un objet XML
    xhr.open("GET", "PHP/users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!searchBar.classList.contains("active")) { //if active active contains in search bar then add this data
                    userList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500)