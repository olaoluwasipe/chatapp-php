const form = document.querySelector(".typing-area"),
      sendBtn = document.getElementById("sendBtn"),
      attachBtn = document.getElementById("attachBtn"),
      chatBox = document.querySelector(".chat-box"),
      attachBox = document.querySelector(".attach"),
      attachImage = document.querySelector(".attach img"),
      attachedFile = document.getElementById("attachedFile"),
      inputField = document.querySelector(".input-field");

let chatData = "";

form.onsubmit = (e) => {
    e.preventDefault();
}

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

attachBtn.onclick = () => {
    attachBox.classList.toggle("active")
}

attachImage.onclick = () => {
    attachedFile.click();
}

attachedFile.onchange = () => {
    const fileArr = ['png', 'jpeg', 'jpg'];
    var img = URL.createObjectURL(attachedFile.files[0]);
    var imgName = attachedFile.files[0].name;
    var imgExt = imgName.split('.')[1];
    if(fileArr.includes(imgExt)) {
        attachImage.src = img;
    } else {
        alert("We only accept png, jpeg and jpg files")
        attachedFile.value = "";
    }
}

sendBtn.onclick = (e) => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/insert-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                inputField.value = "";
                attachedFile.value = "";
                attachImage.src = "https://cpworldgroup.com/wp-content/uploads/2021/01/placeholder.png";
                attachBox.classList.remove("active")
                chatBox.scrollTo(0, chatBox.scrollHeight)
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/get-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                if(chatData !== data) {
                    chatBox.innerHTML = data;
                }
                chatData = data;
                if(!chatBox.classList.contains("active")) chatBox.scrollTo(0, chatBox.scrollHeight)
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}, 500)