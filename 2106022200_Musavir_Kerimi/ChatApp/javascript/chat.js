const form = document.querySelector(".typing-area"), //burda kullanıcının mesjlaşak yerdir
    incoming_id = form.querySelector(".incoming_id").value, //buda gelen mesajlar içindir
    inputField = form.querySelector(".input-field"), //burda kullanicinin yazdiği yerdir
    sendBtn = form.querySelector("button"), //bu kullanıcının butonu tekladığı zaman mesaj geden yerdir
    chatBox = document.querySelector(".chat-box"); //burda mesajlaşma kisimdir 

form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => { //bu botun öesaj gonder botunu komutudur
    if (inputField.value != "") { //eğer yazdiğimizyer boş değilse aşağidaki komut çalişir
        sendBtn.classList.add("active"); //bu botun active hale gelerek çalişir
    } else { //eğer boş ise
        sendBtn.classList.remove("active"); //active hale gelmez ve çalişmaz
    }
}

sendBtn.onclick = () => { //bu button tiklandiğida
    let xhr = new XMLHttpRequest(); //XHR
    xhr.open("POST", "php/insert-chat.php", true); //burda insert_cahtphp ye açiyor yani mesaj gönderme kdou
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) { //eğer xhr çaliştiğida
            if (xhr.status === 200) {
                inputField.value = ""; //burda kullanıcı mesajini gonderdikten sonra yeni mesaj için mesaj yeri boş olacak
                scrollToBottom(); //en sona gider yani en aşaği
            }
        }
    }
    let formData = new FormData(form); //veri aliyoruz
    xhr.send(formData); //verilere gonderiyoruz
}
chatBox.onmouseenter = () => { //measaj uztune geldğiğnde mouse değişiyor
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => { //mmouse olmamasi durumdu mousee notmal haline doner
    chatBox.classList.remove("active");
}

setInterval(() => { //bu kod her yarim saniyde çalişir
    let xhr = new XMLHttpRequest(); //yeni XHR
    xhr.open("POST", "php/get-chat.php", true); //getcaht.php aliyoruz verilere alamk istek gonderiyor
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) { //eğer gonderilen istek gittiyse
            if (xhr.status === 200) { //eğer sonuc geldiyse 200 olsa evet
                let data = xhr.response; //eğere istek kabul edeleyse işlemler baçlar
                chatBox.innerHTML = data; //burda mesajlar gider ve gelir
                if (!chatBox.classList.contains("active")) { //bu bakar chatbxta veri varmi diye
                    scrollToBottom(); //en sona kaydirir
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //measjlara  gondermek için istek alir
    xhr.send("incoming_id=" + incoming_id); //measjalra gonderir
}, 500);

function scrollToBottom() { //mesajin en sona gorebilirmesi için en sonu kaydirir yeni mesaj gelince
    chatBox.scrollTop = chatBox.scrollHeight;
}
