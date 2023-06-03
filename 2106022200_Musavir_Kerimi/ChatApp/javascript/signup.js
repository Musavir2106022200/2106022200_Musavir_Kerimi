const form = document.querySelector(".signup form"), //verilere sigup formden aliyoruz
  continueBtn = form.querySelector(".button input"), //submit butuno aliyrouz
  errorText = form.querySelector(".error-text"); //hata veren işlem

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => { //butona tiklarsak bu işlem yapilir
  let xhr = new XMLHttpRequest(); // XML
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") { //eger hersey dogru ise 
          location.href = "users.php"; //buraya yani users.php ye geliyor
        } else {
          errorText.style.display = "block"; //hata olursa hata vericek
          errorText.textContent = data;
        }
      }
    }
  }
  let formData = new FormData(form); //yeni FormData işeleme yaptik
  xhr.send(formData); //tum verilere phpye gonderdik
}