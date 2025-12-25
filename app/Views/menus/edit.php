<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Menus</h4>
    <a href="<?= base_url('menus')?>" class="btn btn-secondary btn-sm">
         <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('menus/update/' . $menu['menus_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Nama Restaurant</label>
                <select name="restaurants_id" class="form-select" required>
                    <option value=""> - Pilih Nama Restaurant - </option>
                    <?php foreach ($restaurants as $data) : ?>
                    <option value="<?=  $data['restaurants_id'] ?>" <?= $menu['restaurants_id'] == $data['restaurants_id'] ? 'selected' : '' ?>>
                        <?= $data['name']; ?>
                    </option>   
                    <?php endforeach; ?> 
                </select>
            </div>
             
            <div class="mb-3">
                <label class="from-label">Menu Makanan</label>
                <input type="text" name="name" class="form-control" value="<?= $menu['name'] ?>" required>
            </div>

            <!-- Gambar Menu Makanan -->
            <div class="mb-3">
                <label class="from-label">Gambar Menu</label>
                <?php if(!empty($menus['cover'])) : ?>
                    <div class="mb-2">
                        <img src="<?= base_url('image/cover/' . $menus['cover']) ?>" alt="" style="max-height: 100px;" class="img-thumbnail">
                    </div>
                <?php endif ?>    
                <input type="file" name="cover" class="form-control">
                <small class="text-muted">Boleh dikosongkan jika tidak ada gambar menu.</small>
            </div>

            <div class="mb-3">
                <label class="from-label">Deskripsi</label>
                <input type="text" name="description" class="form-control" value="<?= $menu['description'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="from-label">Harga</label>
                <input type="number" name="price" class="form-control" value="<?= $menu['price'] ?>" required>
            </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
                <select name="is_available" class="form-select">
                <option value="Available"
            <?= $menu['is_available'] == 'Available' ? 'selected' : '' ?>>
            Available
                </option>

                <option value="Not Available"
            <?= $menu['is_available'] == 'Not Available' ? 'selected' : '' ?>>
            Not Available
                </option>
                </select>
        </div>


            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>    
    </div>
</div>

<?= $this->endSection(); ?>