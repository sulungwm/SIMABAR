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
                                <p class="card-title">Rekapitulasi Stok Produk</p>
                            </div>
                            <!-- <div class="col-2 text-end">
                                <a class="btn btn-success btn-sm" href="/produk/create">Tambah Produk</a>
                            </div> -->
                        </div>
                        <form action="/produk/cetakrekap" method="post" target="_blank">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_awal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_akhir" required>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Cetak Rekap</button>
                                </div>


                            </div>
                        </form>

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

<?= $this->section('javascript') ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection() ?>