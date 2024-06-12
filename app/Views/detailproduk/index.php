<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Detail Produk</p>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><b>Nama Produk</b></td>
                                        <td>:</td>
                                        <td><?= $produk['nama_produk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jenis Produk</b></td>
                                        <td>:</td>
                                        <td><?= $produk['nama_jenis']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Kategori Produk</b></td>
                                        <td>:</td>
                                        <td><?= $produk['nama_kategori']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><b>Harga</b></td>
                                        <td>:</td>
                                        <td><?= 'Rp ' . number_format($produk['harga'], 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jumlah Stok</b></td>
                                        <td>:</td>
                                        <td><?= $produk['stock']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Deskripsi</b></td>
                                        <td>:</td>
                                        <td><?= $produk['deskripsi']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><b>Ditambahkan oleh</b></td>
                                        <td>:</td>
                                        <td><?= $produk['email']; ?></td>
                                    </tr>
                                    <tr aria-rowspan="2">
                                        <td colspan="3" style="position: relative; padding-left: 0;">
                                            <button class="btn btn-primary" id="tambahDetailBtn" style="position: absolute; top: 0; right: 0;">Tambah Detail</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="photo-gallery">
                                <div class="container">
                                    <div class="row photos">
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="/assets/images/lightbox/thumb-v-v-1.jpg" data-lightbox="photos"><img class="img-fluid" src="/assets/images/lightbox/thumb-v-v-1.jpg"></a></div>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <style>
        .photo-gallery {
            color: #313437;
            background-color: #fff;
        }

        .photo-gallery p {
            color: #7d8285;
        }

        .photo-gallery h2 {
            font-weight: bold;
            margin-bottom: 40px;
            padding-top: 40px;
            color: inherit;
        }

        @media (max-width:767px) {
            .photo-gallery h2 {
                margin-bottom: 25px;
                padding-top: 25px;
                font-size: 24px;
            }
        }

        .photo-gallery .intro {
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 40px;
        }

        .photo-gallery .intro p {
            margin-bottom: 0;
        }

        .photo-gallery .photos {
            padding-bottom: 20px;
        }

        .photo-gallery .item {
            padding-bottom: 30px;
        }

        .lightbox-large .lb-outerContainer {
            width: 80% !important;
            height: 80% !important;
        }
    </style>
    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightboxItems = document.querySelectorAll('.photo-gallery .item');
            const lightbox = document.querySelector('.lightbox');

            if (lightboxItems.length < 6) {
                lightbox.classList.add('lightbox-large');
            } else {
                lightbox.classList.remove('lightbox-large');
            }
        });
    </script>
    <?= $this->endSection() ?>