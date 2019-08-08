$('.draggable').draggable({
    helper:"clone",
    containment:"document",
    zIndex: 100
});
  $( '.droppable' ).droppable({
     activeClass: "ui-hover",
     hoverClass: "ui-active",
     accept: '.draggable',
     drop: function(event, ui) {
      $(this)
      .append(ui.draggable.css({
        position: 'relative',
        background: 'green'
     }))

  
   }
  });