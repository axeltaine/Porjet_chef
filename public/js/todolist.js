$('.draggable').draggable({
  helper: "clone",
  containment: "document",
  zIndex: 100


});
$('.droppable').droppable({

  activeClass: "ui-hover",
  hoverClass: "ui-active",
  accept: '.draggable',
  drop: function (event, ui) {

    $(this)
      .append(ui.draggable.css({
        position: 'relative',
        background: 'green'
      }))
    id = $(".global").data('id');
    idcard = $(this).attr("id");

    if (bootbox.confirm("Êtes-vous sûr?", function (result) {
       if (result == false ){return}
        fetch(`/position/${id}/${idcard}`, {
          method: 'POST',
        }).then(function () {
          bootbox.alert({
            message: "Mise à jour de la position ok!",
            className: 'rubberBand animated',
            size: 'small'
          });
        })

      })) {

    }
  }
});

function init() {  
  main.classList.add("loading");
  setTimeout(function() { main.classList.remove("loading"); }, 1800); 
}
window.onload = function() {
	init();
};