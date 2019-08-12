
$('.delete-projet').click(function() {
    if (confirm('Are you sure?')) {
        const id = $(this).data('id');

        fetch(`/accueil/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
});