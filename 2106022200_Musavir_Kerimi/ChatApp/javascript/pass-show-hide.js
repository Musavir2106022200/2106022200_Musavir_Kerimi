const pswrdField = document.querySelector(".form input[type='password']"), //burda konumda şifre alir
  toggleIcon = document.querySelector(".form .field i"); //icon oyarisine aliyor

toggleIcon.onclick = () => {  //bunu bastiğimizda
  if (pswrdField.type === "password") { //eğer şifre sakli bir halde ise 
    pswrdField.type = "text"; //onu text halene donuşturyoruz
    toggleIcon.classList.add("active"); //active hale getiriyoruz
  } else { //değilse 
    pswrdField.type = "password"; //şifreye sakli hale getiriyoruz
    toggleIcon.classList.remove("active"); //ve çalişmasne durduruyoruz
  }
}
