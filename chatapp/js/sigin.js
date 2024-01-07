const form = document.querySelector(".signup form"),
      continueBtn = document.querySelector(".signup .btn input"),
      userImg = document.querySelector(".signup .image-box img"),
      imgBtn = form.querySelector("input[type='file']"),
      errorTxt = document.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();

}

userImg.onclick = () => {
    imgBtn.click()
}

imgBtn.onchange = () => {
    const fileArr = ['png', 'jpeg', 'jpg'];
    var img = URL.createObjectURL(imgBtn.files[0]);
    var imgName = imgBtn.files[0].name;
    var imgExt = imgName.split('.')[1];
    if(fileArr.includes(imgExt)) {
        userImg.src = img;
    } else {
        alert("We only accept png, jpeg and jpg files")
        imgBtn.value = "";
    }
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