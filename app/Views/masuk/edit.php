<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Data Barang Masuk</h4>
                        <form class="forms-sample" action="/masuk/update/<?= $barangmasuk['id_barangmasuk']; ?>" method="post">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select class="form-control js-example-basic-single w-100" name="id_produk" required>
                                    <option selected disabled>-</option>
                                    <?php foreach ($produk as $key) : ?>
                                        <option value="<?= $key['id_produk']; ?>" <?php if ($key['id_produk'] == $barangmasuk['id_produk']) echo 'selected="selected"'; ?>><?= $key['nama_produk']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" value="<?= $barangmasuk['jumlah_barang']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" value="<?= $barangmasuk['tanggal_masuk']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/masuk'); ?>" class="btn btn-danger">Batal</a>
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