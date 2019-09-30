// DESASSIGN //
$('.desassign-projet').click(function () {
  const id = $(this).data('id');
  const mid = $(this).data('modalid');
  const user = $(`.modal-body#${mid} select`).val();

  if (user == null) {
    return;
  }

  if (bootbox.confirm("Êtes-vous sûr?", function (result) {
    if (result == false ){return}
    fetch(`/desassign/${id}/${user}`, {
        method: 'POST'
    }).then(function () {
      bootbox.alert({
        message: "Mise à jour ok!",
        className: 'rubberBand animated',
        size: 'small'
      });
    }).then(res => location.reload());
       
  })) {
    
  }
});