<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-4 mb-2 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Jumlah Produk</p>
                                <p class="fs-30 mb-2"><?= $stok; ?></p>
                                <p>total jenis produk</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Barang Masuk</p>
                                <p class="fs-30 mb-2"><?= $masuk; ?></p>
                                <p>total transaksi barang masuk</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Barang Keluar</p>
                                <p class="fs-30 mb-2"><?= $keluar; ?></p>
                                <p>total transaksi barang keluar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="table-1" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Jenis</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($produk as $row) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row['nama_produk']; ?></td>
                                                    <td><?= $row['nama_kategori']; ?></td>
                                                    <td><?= $row['nama_jenis']; ?></td>
                                                    <td><?= 'Rp ' . number_format($row['harga'], 0, ',', '.'); ?></td>
                                                    <td><?= $row['stock']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
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
        $('#table-1').DataTable();
    });
</script>
<?= $this->endSection() ?>