
// DELETE PROJET //
$('.delete-projet').click(function() {
    if (confirm('Are you sure?')) {
        const id = $(this).data('id');

        fetch(`/accueil/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
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