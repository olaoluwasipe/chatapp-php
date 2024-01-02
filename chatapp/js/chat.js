const form = document.querySelector(".typing-area"),
      sendBtn = document.querySelector("button"),
      chatBox = document.querySelector(".chat-box"),
      inputField = document.querySelector(".input-field");


form.onsubmit = (e) => {
    e.preventDefault();
}


chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
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
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")) chatBox.scrollTo(0, chatBox.scrollHeight)
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}, 500)