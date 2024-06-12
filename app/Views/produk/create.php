<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Produk</h4>
                        <form class="forms-sample" action="/produk/add" method="post">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control js-example-basic-single w-100" name="id_kategori" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($kategori as $key) : ?>
                                        <option value="<?= $key['id_kategori']; ?>"><?= $key['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <select class="form-control js-example-basic-single w-100" name="id_jenis" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($jenis as $key) : ?>
                                        <option value="<?= $key['id_jenis']; ?>"><?= $key['nama_jenis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" required>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Stok</label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="harga" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" required class="form-control" style="min-height:100px"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/produk'); ?>" class="btn btn-danger">Batal</a>
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
<!--  script src -->
<?= $this->endSection() ?>