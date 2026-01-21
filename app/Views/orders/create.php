<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3 m-3">
    <h4 class="mb-0">Tambah Menu's</h4>
    <a href="<?= base_url('orders'); ?>" class="btn btn-secondary btn-sm">
        <i class="mdi mdi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('orders/insert'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- memilih restoran -->
            <div class="mb-3">
                <label class="form-label">Restaurants</label>
                <select class="form-control" name="restaurants_id" id="restaurants" required>
                    <option value="">- Pilih Restoran -</option>
                    <?php foreach($restaurants as $data): ?>
                        <option value="<?= $data['restaurants_id'] ?>">
                            <?= $data['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nama Menus -->
            <div class="row mb-3">
                <div class="col-md-6">
                   <label class="form-label">Customers</label>
                   <select class="form-control" id="customers_id" name="customers_id" class="form-select" required>
                   <option value=""> - Select Customers - </option>
                    <?php foreach ($customers as $data) : ?>
                        <option value="<?= $data['customers_id'] ?>" data-alamat="<?= $data['address'] ?>">
                            <?= $data['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>

                <!-- Nama Alamat -->
                <div class="col-md-6">
                    <label  class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="delivery_address"  > 
                </div>
            </div>

            <hr>
            
            <!-- menginput menu -->
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <label class="form-label">Daftar Menu</label>
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnTambahBaris">
                    Tambah Menu
                </button>
            </div>
            <div id="wrapper-menu">
                <div class="row mb-3 baris-tambahan">
                    <div class="col-md-3">
                        <select name="menus_id[]" id="menu" required class="form-select form-control menu">
                            <option value="">- Pilih Menu -</option>
                            <?php foreach($menus as $menu): ?>
                            <option value="<?= $menu['menus_id'] ?>" data-price="<?= $menu['price'] ?>"><?= $menu['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="number" name="qty[]" class="form-control qty" placeholder="Jumlah" >
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <input type="text" class="form-control price"  name="price[]" readonly>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control subtotal" name="subtotal[]" readonly>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 btnHapusBaris">
                            Hapus
                        </button>
                    </div>
               </div>
            </div>

            <!-- Tombol simpan dan reset -->
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>

        </form>  
        
        <!-- untuk menambah dan menghapus baris -->
        <script>
            document.getElementById('btnTambahBaris').addEventListener('click',function(){ //Copy-paste baris menu baru
                const wrapper = document.getElementById('wrapper-menu');
                const first = wrapper.querySelector('.baris-tambahan');
                const clone = first.cloneNode(true);
                
                clone.querySelector('select').selectedIndex = 0;
                wrapper.appendChild(clone);

                addRemoveHandler(clone.querySelector('.btnHapusBaris')) // Hapus baris 
            });

            function addRemoveHandler(btn){  //Hapus baris menyisakan 1 baris
                btn.addEventListener('click',function(){
                    const row = this.closest('.baris-tambahan');
                    const wrapper = document.getElementById('wrapper-menu');

                if(wrapper.querySelectorAll('.baris-tambahan').length > 1){
                    row.remove();
                }
                });
                addRemoveHandler(document.querySelector('.btnHapusBaris'));
            }

            document.addEventListener('input',function(list){ //Kalkulator otomatis
               if(list.target.classList.contains('qty') || list.target.classList.contains('menu')){
                const row = list.target.closest('.baris-tambahan')
                
                const menuSelect = row.querySelector('.menu');
                const qtyInput = row.querySelector('.qty');
                const priceInput = row.querySelector('.price');
                const totalInput = row.querySelector('.subtotal');

                const price = menuSelect.options[menuSelect.selectedIndex]?.dataset.price || 0;
                const qty = qtyInput.value || 0;

                priceInput.value = price;
                totalInput.value   = price * qty;
               }
            });

            document.getElementById('restaurants').addEventListener('change', function () { //Ambil daftar menu dari database sesuai restoran yang dipilih
                const restaurantsId = this.value;
                fetch("<?= base_url('orders/DaftarMenu') ?>/" + restaurantsId)
                .then(response => response.json())
                .then(data => {
                const selects = document.querySelectorAll('.menu');
                    selects.forEach(select => {
                        select.innerHTML = `<option value="">- Pilih Menu -</option>`;
                        data.forEach(menu => {
                            select.innerHTML += `
                            <option value="${menu.menus_id}" data-price="${menu.price}"> ${menu.name}</option>`;
                        });
                    });
                })
                .catch(error => console.error(error));

                document.getElementById('customers_id').addEventListener('change', function(){ //Isi otomatis kolom alamat pas pilih nama orang.
                    let inputAlamat = this.options[this.selectedIndex].getAttribute('data-alamat');
                    document.getElementById('address').value = inputAlamat;
                })
            });
        </script>
    </div>     
</div>
<?= $this->endSection(); ?>