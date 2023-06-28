var subMenus = document.getElementsByClassName('sub-menu');
var btnOpenNav = document.getElementById('open-main-nav');
var mainNav = document.getElementById('main-nav');
var btnOpenCart = document.getElementById('open-cart');
var cart = document.getElementById('s-cart');

for (var i = 0; i < subMenus.length; i++) {
  subMenus[i].onclick = function () {
    this.classList.toggle('sub-menu-open');
  };
}

function showNav(bool) {
  if (bool) {
    btnOpenNav.style.display = 'none';
    mainNav.style.width = 'min(100%,255px)';
    showCart(false);
  }
  else {
    btnOpenNav.style.display = 'block';
    mainNav.style.width = '0px';
  }
}

function showCart(bool) {
  if (bool) {
    cart.style.width = 'min(100%,400px)';
    showNav(false); 
  }
  else {
    cart.style.width = '0px';
  }
}

var visScroll = document.getElementById("vis-scroll");
var div = document.getElementById("s-product");
if (div != null) {
  div.addEventListener("scroll", function () {
    // Code à exécuter lorsque l'utilisateur fait défiler la div
    var scrollTop = div.scrollTop;
    var scrollHeight = div.scrollHeight;
    var clientHeight = div.clientHeight;
  
    var scrollPercent = (scrollTop / (scrollHeight - clientHeight)) * 100;
    visScroll.style.width = scrollPercent + "%";
  });
  
}

// document.getElementById('filter-categorie').addEventListener('change', function(event) {
//   var value = event.target.value;
//   window.location.href = "https://index.php&Controller=";

// });


// popup profile
document.addEventListener("click", function (event) {
  var bouton = event.target.closest("#btn-popup-profile");
  var div = document.getElementById("popup-profile");
  
  if (bouton) {
      if (div.style.display === "none" || div.style.display === "") {
          div.style.display = "block";
      } else {
          div.style.display = "none";
      }
      event.stopPropagation();
  } else if (!event.target.closest("#popup-profile")) {
      div.style.display = "none";
  }
});


// banniere
var colorThief = new ColorThief();

function setUserBannerColor() {
    var image = document.getElementById('main-profile-img');
    var palette = colorThief.getPalette(image, 2);

    var banner = document.getElementById('user-banner');
    banner.style.background = "linear-gradient(-90deg, " + rgbToHex(palette[0]) + ", " + rgbToHex(palette[1]) + ")";
}

function rgbToHex(rgb) {
    return '#' + ((rgb[0] << 16) | (rgb[1] << 8) | rgb[2]).toString(16).padStart(6, '0');
}


document.addEventListener('DOMContentLoaded', function() {
  // album
  // Sélectionnez tous les éléments .img-action
  var imgActions = document.querySelectorAll('.profile-item');
  
  // Parcourez chaque élément .img-action
  imgActions.forEach(function(imgAction) {
    // Ajoutez un gestionnaire d'événements de clic à chaque élément
    imgAction.addEventListener('click', function() {
      // Obtenez l'élément parent .gallery-item
      var galleryItem = this.parentNode;

      // Obtenez la source de l'image de l'élément .gallery-item
      var imageSource = galleryItem.querySelector('img').src;

      // Mettez à jour la source de l'image #main-profile-img
      var mainProfileImg = document.getElementById('main-profile-img');
      mainProfileImg.src = imageSource;

      // Récupérer l'identifiant de l'image à partir de l'attribut data-image-id
      var imageId = galleryItem.querySelector('img').dataset.imageId;
      
      // Mettre à jour la valeur de l'élément selected-image-id
      var selectedImageId = document.getElementById('selected-image-id');
      selectedImageId.value = imageId;
    });
  });

  // loader
  var container = document.getElementById("loading-container");
  var text = document.getElementById("loading-text");

  var percentageLoaded = 0;
  var totalResources = 0;
  var loadedResources = 0;

  // Fonction pour mettre à jour le pourcentage de chargement
  function updatePercentage() {
    if (totalResources === 0) {
      percentageLoaded = 100; // Si aucun élément à charger, le chargement est complet
    } else {
      percentageLoaded = Math.floor((loadedResources / totalResources) * 100);
    }
    text.innerHTML = percentageLoaded + "%";
    // Si le chargement est complet, masquer l'élément de chargement
    if (percentageLoaded >= 100) {
      container.style.display = "none";
    }
  }

  // Sélectionnez les ressources que vous souhaitez surveiller
  var resourcesToLoad = document.querySelectorAll(".product-image");
  totalResources = resourcesToLoad.length;

  // Attachez les gestionnaires d'événements aux ressources
  for (var i = 0; i < totalResources; i++) {
    resourcesToLoad[i].addEventListener("load", handleResourceLoad);
    resourcesToLoad[i].addEventListener("error", handleResourceLoad); // Gérer également les erreurs de chargement
    resourcesToLoad[i].addEventListener("abort", handleResourceLoad); // Gérer les chargements interrompus
    resourcesToLoad[i].setAttribute("crossorigin", "anonymous"); // Ajouter l'attribut crossorigin pour gérer les erreurs de chargement des images externes
  }

  // Gestionnaire d'événement pour les ressources chargées
  function handleResourceLoad() {
    loadedResources++;
    updatePercentage();

    // Vérifier si toutes les ressources ont été chargées (y compris celles ayant échoué)
    if (loadedResources >= totalResources) {
      container.style.display = "none";
    }
  }
});



// tinyEditor
tinymce.init({
  selector: 'textarea',
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
  ],
});