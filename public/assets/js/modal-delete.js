document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('deleteModal');
  const btnCancel = document.getElementById('btnCancel');
  const btnConfirm = document.getElementById('btnConfirmDelete');

  if (!modal) return;

  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.dataset.id;

      btnConfirm.href = BASE_URL + 'customers/delete/' + id;
      modal.classList.add('show'); 
    });
  });

  btnCancel.addEventListener('click', () => {
    modal.classList.remove('show'); 
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) {
      modal.classList.remove('show'); 
    }
  });
});
