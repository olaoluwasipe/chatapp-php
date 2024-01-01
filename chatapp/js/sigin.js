const form = document.querySelector(".signup form"),
      continueBtn = document.querySelector(".signup .btn input");

form.onsubmit = (e) => {
    e.preventDefault();

}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/signup.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
            }
        }
    }
    let formData = new FormData(form);
    console.log(form)
    xhr.send(formData);
}