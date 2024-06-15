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
                                <p class="card-title">Detail Produk</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="btn btn-dark " href="/produk/">Kembali</a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="demo">
                                        <ul id="lightSlider">
                                            <?php if (!empty($detail)) : ?>
                                                <?php foreach ($detail as $row) : ?>

                                                    <li data-thumb=" <?= base_url('uploads/' . $row['nama_file']); ?>"> <img src=" <?= base_url('uploads/' . $row['nama_file']); ?>" /> </li>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
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
                                        <td><?= nl2br(wordwrap($produk['deskripsi'], 65, "\n", true)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ditambahkan oleh</b></td>
                                        <td>:</td>
                                        <td><?= $produk['email']; ?></td>
                                    </tr>
                                </table>
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Kelola Detail
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="collapse" id="collapseExample">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-10">
                                                <p class="card-title">Detail Produk</p>
                                            </div>
                                            <div class="col-2 text-end">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Tambah Detail
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="table-1" class="display expandable-table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama File</th>
                                                                <th>aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($detail)) : ?>
                                                                <?php $no = 1; ?>
                                                                <?php foreach ($detail as $row) : ?>
                                                                    <tr>
                                                                        <td><?= $no++ ?></td>
                                                                        <td><?= $row['nama_file']; ?></td>
                                                                        <td> <a href="/detailproduk/delete/<?= $row['id_detail']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <td class="text-center" colspan="3">belum ada data</td>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="forms-sample" action="/detailproduk/add/<?= $produk['id_produk']; ?>" enctype="multipart/form-data" method="post">
                                                            <div class="form-group mb-3">
                                                                <label for="fileInput" class="form-label">Upload File</label>
                                                                <input type="file" class="form-control" id="fileInput" name="file" accept="image/*">
                                                            </div>
                                                            <div id="filePreview" class="mb-3">
                                                                <!-- Preview will be shown here -->
                                                            </div>
                                                            <button type="submit" style="float: right;" class="btn btn-primary ">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->
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
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <style>
        .demo {
            width: 100%
        }

        ul {
            list-style: none outside none;
            padding-left: 0;
            margin-bottom: 0
        }

        li {
            display: block;
            float: left;
            margin-right: 6px;
            cursor: pointer
        }

        img {
            display: block;
            height: auto;
            width: 100%
        }

        #filePreview img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 10px;
        }
    </style>
    <?= $this->endSection() ?>

    <?= $this->section('javascript') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
    <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 6
        });

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const preview = document.getElementById('filePreview');
            preview.innerHTML = ''; // Clear any previous content

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <?= $this->endSection() ?>