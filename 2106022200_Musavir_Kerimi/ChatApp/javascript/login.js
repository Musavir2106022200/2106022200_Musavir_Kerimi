const form = document.querySelector(".login form"), //burda login.php sayfadan formu aliyoruz
  continueBtn = form.querySelector(".button input"), //butuno aliyoruz
  errorText = form.querySelector(".error-text"); //hata verei yere aliyoruz

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => { //button tiklayinca bu işlemler yapilir
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true); //başka login.phhp dosyaysina açiyoruz
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { //kontrol ediliyor
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {//eğer bilggiler doğru ise
          location.href = "users.php";//buraya yonlendirecek
        } else {
          errorText.style.display = "block"; //hatali olursa hata vericek
          errorText.textContent = data;
        }
      }
    }
  }
  let formData = new FormData(form); //form bilgilere phpp ye gondermek için oluşturduk
  xhr.send(formData); //gonderdik
}