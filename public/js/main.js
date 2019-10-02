// Début fonction supprimer projet //

$('.delete-projet').click(function () {
  const id = $(this).data('id');
  if (bootbox.confirm("Êtes-vous sûr?", function (result) {

      if (result == false) {
        return
      }


      fetch(`/accueil/delete/${id}`, {
        method: 'DELETE'
      }).then(function () {
        bootbox.alert({
          message: "Projet suprimer!",
          className: 'rubberBand animated',
          size: 'small'
        });
      }).then(res => window.location.reload());
    })) {

  }
});
// Fin fonction supprimer projet //

// Début fonction DARK MODE //
function toggleDarkLight() {
  var body = document.getElementById("body");
  var currentClass = body.className;
  var newClass = body.className == "dark-mode" ? "light-mode" : "dark-mode"
  body.className = newClass
  document.documentElement.classList.add('color-theme-in-transition')
  window.setTimeout(function () {
    document.documentElement.classList.remove('color-theme-in-transition')
  }, 1000)
  document.cookie = 'theme=' + (newClass == 'light-mode' ? 'light-mode' : 'dark-mode')
  console.log('Cookies are now: ' + document.cookie)

};

function isDarkThemeSelected() {
  return document.cookie.match(/theme=dark-mode/i) != null
}

function setThemeFromCookie() {
  var body = document.getElementById('body')
  body.className = isDarkThemeSelected() ? 'dark-mode' : 'light-mode'
}
(function () {
  setThemeFromCookie()
})();
// Fin fonction DARK MODE //

// Début fonction scroll back to top //
$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#myBtn').fadeIn();
    } else {
      $('#myBtn').fadeOut();
    }
  });
  $('#myBtn').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
});
// Fin fonction scroll back to top //

// Début Fonction Cookie //
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#252e39"
    },
    "button": {
      "background": "#14a7d0"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Ce site web utilise les cookies pour vous assurer la meilleur expérience possible.",
    "dismiss": "D'accord",
    "link": "En savoir plus"
  }
});
// Fin fonction Cookie //