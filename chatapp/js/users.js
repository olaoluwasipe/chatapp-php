const searchBar = document.querySelector(".users .search input"),
      searchBtn = document.querySelector(".users .search button");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "functions/users.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                if(data == "Success") {
                    
                } else {
                    
                }
            }
        }
    }
    xhr.send();
}, 500)