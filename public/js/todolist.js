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
      console.log('id element droppé :'+$(ui.draggable).attr('idcard')+', sur id du parent :'+$(event.target).attr('id'));
      $(this)
      .append(ui.draggable.css({
        position: 'relative',
        background: 'green'
     }))
     id = $(".global").data('id');
     idcard = $(this).attr("id");
     if (confirm('Are you sure?')) {
       
      fetch(`/position/${id}/${idcard}`, {
        method: 'POST',
       }).then( function(){
         alert('Position Update');
       })
      }
    
     }});
  
        
      
