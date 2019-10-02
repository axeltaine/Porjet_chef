// Début fonction chargement de page (preloader) //

$(window).on('load', function () {
  $('#mdb-preloader').addClass('loaded');
});

$('.datepicker').pickadate({
  formatSubmit: 'yyyy-mm-dd',
});

function init() {
  main.classList.add("loading");
  setTimeout(function () {
    main.classList.remove("loading");
  }, 1800);
}
window.onload = function () {
  init();
};
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

// Fin fonction chargement de page (preloader) //