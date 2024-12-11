function myFunction() {
  var x = document.querySelector("nav");
  if (x.className === "") {
    x.className += " responsive";
  } else {
    x.className = "";
  }
}

document.addEventListener("DOMContentLoaded", function() {
  // Hakee kaikki navigointilinkit
  var navLinks = document.querySelectorAll("nav a");

  // Saa nykyisen sivun URL:n
  var currentUrl = window.location.href;

  // Käy läpi kaikki navigointilinkit ja vertaa niitä URL-osoitteeseen
  navLinks.forEach(function(link) {
    if (link.href === currentUrl) {
      link.classList.add("active"); // Lisää "active"-luokka, jos linkin osoite on sama kuin nykyinen URL
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  fetch('suomen_kaupungit.json')
    .then(response => response.json())
    .then(data => {
      const datalist = document.getElementById('cities');
      data.cities.forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        datalist.appendChild(option);
      });
    })
    .catch(error => console.error('Error fetching city data:', error));
});

//Bootstrap JS kirjastot ovat tiedostossa rekisteroidy.html on the bottom