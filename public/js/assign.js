$('.assign-projet').click(function () {
  const id = $(this).data('id');
  const mid = $(this).data('modalid');
  const user = $(`.modal-body#${mid} select`).val();

  if (user == null) {
    return;
  }

  if (confirm('Are you sure?')) {
    fetch(`/assign/${id}/${user}`, {
      method: 'POST'
    }).then(res => location.reload());
  }
});