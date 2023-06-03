const searchBar = document.querySelector(".search input"), //burada arama yapilecek yere aldik
  searchIcon = document.querySelector(".search button"), //burada butonu aldik
  usersList = document.querySelector(".users-list");

searchIcon.onclick = () => { //burda arama butonuna tikyayinca ne işleme yapan metod
  searchBar.classList.toggle("show");//burda tikyainda arama yapabiliir ve yeniden tiklayinda yapamaz
  searchIcon.classList.toggle("active"); //burda aaktive hale gelmesi ve gelmemesine bakicez
  searchBar.focus();

  if (searchBar.classList.contains("active")) {//burdad arama yerine her şeye sildireek 
    searchBar.value = "";
    searchBar.classList.remove("active");//ve  disaktiv ediyor
  }
}

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value; //burada aradiğimiz veri tutanacak
  if (searchTerm != "") { //eğer boş ise 
    searchBar.classList.add("active"); //sadece ilsteye yazicek
  } else { //eüer bos işe 
    searchBar.classList.add("offline"); //oraya offline ekleyecekj
  }
  let xhr = new XMLHttpRequest(); //XHR
  xhr.open("POST", "php/search.php", true); //veri almaya ister
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { //eğer istek işlemi bittiyse
      if (xhr.status === 200) { //eğer her şey evet ve hazir ise
        let data = xhr.response; //veri aliniyor
        usersList.innerHTML = data; //ver veri ekleyecek başka sayfayi
      }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() => { //bu kod her yarim saniye calişmasi içindir
  let xhr = new XMLHttpRequest(); //XRH
  xhr.open("GET", "php/users.php", true); //user.php den istek alir
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { //istek durumunu bakar
      if (xhr.status === 200) {//eğer bittiyse
        let data = xhr.response; //veriler işler
        if (!searchBar.classList.contains("active")) { //eğer arama yapilmiyorsa burda sonuc sadece başka kullaniciler olacak
          usersList.innerHTML = data; //baska kullanıcıalr yazıcak yukleme yapıcak
        }
      }
    }
  }
  xhr.send(); //veriler gonderilir
}, 500);

