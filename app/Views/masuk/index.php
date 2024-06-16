<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-9">
                                <p class="card-title">Data Barang Masuk</p>
                            </div>
                            <div class="col-3 text-end">
                                <a class="btn btn-sm btn-dark btn-icon-text text-white" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    cetak
                                    <i class="ti-printer btn-icon-append"></i>
                                </a>
                                <a class="btn btn-success btn-sm" href="/masuk/create">Tambah</a>
                            </div>
                        </div>
                        <div class="row">

                            <div class="collapse col-12" id="collapseExample">
                                <div class="card">
                                    <div class="card-body">
                                        anu
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="table-1" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Barang Masuk</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($masuk as $row) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row['nama_produk']; ?></td>
                                                    <td><?= $row['jumlah_barang']; ?></td>
                                                    <td><?= $row['tanggal_masuk']; ?></td>
                                                    <td>
                                                        <!-- <a href="/detailproduk/show/<?= $row['id_produk']; ?>" class="btn btn-sm btn-dark">Detail</a> -->
                                                        <a href="/masuk/edit/<?= $row['id_barangmasuk']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="/masuk/delete/<?= $row['id_barangmasuk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="/masuk/cetak/" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Mulai Tanggal</label>
                                                                <input class="form-control" type="date" name="tgl_awal" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>sampai Tanggal</label>
                                                                <input class="form-control" type="date" name="tgl_akhir" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" style="float: right;" class="btn btn-primary ">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- link ref -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-1').DataTable();
    });
</script>

<?= $this->endSection() ?>