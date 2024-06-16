<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Barang Keluar</h4>
                        <form class="forms-sample" action="/keluar/update/<?= $barangkeluar['id_barangkeluar']; ?>" method="post" id="form-barang-keluar">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select class="form-control js-example-basic-single w-100" name="id_produk" id="id_produk" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($produk as $key) : ?>
                                        <option value="<?= $key['id_produk']; ?>" <?php if ($key['id_produk'] == $barangkeluar['id_produk']) echo 'selected="selected"'; ?>><?= $key['nama_produk']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang <span id="stok-produk">(Stok: <?= $stok_produk; ?>)</span></label>
                                <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" value="<?= $barangkeluar['jumlah_barang']; ?>" required>
                                <span class="text-danger" id="error-jumlah-barang" style="display: none;">Jumlah barang melebihi stok!</span>
                            </div>
                            <div class="form-group">
                                <label>Tanggal keluar</label>
                                <input type="date" class="form-control" name="tanggal_keluar" value="<?= $barangkeluar['tanggal_keluar']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2" id="btn-submit">Simpan</button>
                            <a href="<?= base_url('/keluar'); ?>" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
    <!-- partial -->
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- link ref -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function() {
        // Load default stock
        var defaultStock = <?= json_encode($stok_produk); ?>;
        if (defaultStock !== null) {
            $('#jumlah_barang').data('max', defaultStock);
        }

        $('#id_produk').change(function() {
            var id_produk = $(this).val();
            if (id_produk) {
                $.ajax({
                    url: '/produk/cekstok',
                    type: 'POST',
                    data: {
                        id_produk: id_produk
                    },
                    success: function(response) {
                        $('#stok-produk').text('(Stok: ' + response.stock + ')');
                        $('#jumlah_barang').data('max', response.stock);
                        validateJumlahBarang();
                    }
                });
            }
        });

        $('#jumlah_barang').on('input', function() {
            validateJumlahBarang();
        });

        function validateJumlahBarang() {
            var jumlah_barang = $('#jumlah_barang').val();
            var max_stock = $('#jumlah_barang').data('max');
            if (parseInt(jumlah_barang) > parseInt(max_stock)) {
                $('#error-jumlah-barang').show();
                $('#btn-submit').prop('disabled', true);
            } else {
                $('#error-jumlah-barang').hide();
                $('#btn-submit').prop('disabled', false);
            }
        }
    });
</script>
<?= $this->endSection() ?>