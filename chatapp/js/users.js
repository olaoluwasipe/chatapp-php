const searchBar = document.querySelector(".users .search input"),
      searchBtn = document.querySelector(".users .search button"),
      userList = document.querySelector(".users .users-list");

let userData = "";

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchTerm = "";
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/search.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                if(userData !== data) {
                    console.log(data);
                    userList.innerHTML = data;
                }
                userData = data;
                // clearInterval(loadUsers);
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

const loadUsers = setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "functions/users.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                if(userData !== data) {
                    console.log(data);
                    if(!searchBar.classList.contains("active")) userList.innerHTML = data;
                }
                userData = data;
            }
        }
    }
    xhr.send();
}, 500)