document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('deleteModal');
  const btnCancel = document.getElementById('btnCancel');
  const btnConfirm = document.getElementById('btnConfirmDelete');

  /* =========================
     DELETE
  ========================== */
  document.addEventListener('click', function (e) {
    const btnDelete = e.target.closest('.btn-delete');
    if (!btnDelete) return;

    const url = btnDelete.dataset.url;
    if (!url) return;

    btnConfirm.href = BASE_URL + url;
    btnConfirm.textContent = 'Hapus';

    modal.querySelector('h4').textContent = 'Hapus Data';
    modal.querySelector('p').textContent =
      'Apakah Anda yakin ingin menghapus data ini?';

    modal.classList.add('show');
  });

  /* =========================
     SELESAI ORDER (PAKAI MODAL)
  ========================== */
  document.addEventListener('click', function (e) {
    const btnSelesai = e.target.closest('.btn-selesai');
    if (!btnSelesai) return;

    const url = btnSelesai.dataset.url;
    if (!url) return;

    btnConfirm.href = url;
    btnConfirm.textContent = 'Selesaikan';

    modal.querySelector('h4').textContent = 'Konfirmasi Pesanan';
    modal.querySelector('p').textContent =
      'Apakah Anda yakin ingin menyelesaikan pesanan ini?';

    modal.classList.add('show');
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
