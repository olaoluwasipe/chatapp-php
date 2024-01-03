const form = document.querySelector(".signup form"),
      continueBtn = document.querySelector(".signup .btn input"),
      errorTxt = document.querySelector(".error-txt");

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
                if(data == "Success") {
                    location.href = 'users.php';
                } else {
                    errorTxt.textContent = data;
                    errorTxt.style.display = "block";
                }
            }
        }
    }
    let formData = new FormData(form);
    console.log(form)
    xhr.send(formData);
}