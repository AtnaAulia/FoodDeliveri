document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('deleteModal');
  const btnCancel = document.getElementById('btnCancel');
  const btnConfirm = document.getElementById('btnConfirmDelete');

  if (!modal || !btnConfirm) return;

  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
      const url = this.dataset.url;
      if (!url) return;

      btnConfirm.href = BASE_URL + url;
      modal.classList.add('show');
    });
  });

  btnCancel?.addEventListener('click', () => {
    modal.classList.remove('show');
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) {
      modal.classList.remove('show');
    }
  });
});
