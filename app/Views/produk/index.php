<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-10">
                                <p class="card-title">Data Produk</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/produk/create">Tambah Produk</a>
                            </div>
                        </div>
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
                                                <th>Stok Awal</th>
                                                <th>aksi</th>
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
                                                    <td>
                                                        <a href="/detailproduk/show/<?= $row['id_produk']; ?>" class="btn btn-sm btn-dark">Detail</a>
                                                        <a href="/produk/edit/<?= $row['id_produk']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="/produk/delete/<?= $row['id_produk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                                                    </td>
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