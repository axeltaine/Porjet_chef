
// DELETE PROJET //

$('.delete-projet').click(function() {
  const id = $(this).data('id');
    if (bootbox.confirm("Êtes-vous sûr?", function (result) {
      
      if (result == false ){return}
        
      
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
// DARK MODE //
function toggleDarkLight() {
  var body = document.getElementById("body");
  var currentClass = body.className;
  body.className = currentClass == "dark-mode" ? "light-mode" : "dark-mode";
  document.documentElement.classList.add('color-theme-in-transition')
  window.setTimeout(function () {
  document.documentElement.classList.remove('color-theme-in-transition')
  }, 1000)
};

$(document).ready(function(){ 
  $(window).scroll(function(){ 
      if ($(this).scrollTop() > 100) { 
          $('#myBtn').fadeIn(); 
      } else { 
          $('#myBtn').fadeOut(); 
      } 
  }); 
  $('#myBtn').click(function(){ 
      $("html, body").animate({ scrollTop: 0 }, 600); 
      return false; 
  }); 
});