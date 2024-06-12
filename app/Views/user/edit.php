<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit User</h4>
                        <form class="forms-sample" action="/user/update/<?= $user['id_user']; ?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email </label>
                                <input type="email" class="form-control" id="exampleInputEmail3" name="email" placeholder="Email" value="<?= $user['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control js-example-basic-single w-100" name="role" required>
                                    <option selected disabled>--- Pilih Role ---</option>
                                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="pegawai" <?php if ($user['role'] == 'pegawai') echo 'selected'; ?>>Pegawai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Simpan</button>
                            <!-- <button class="btn btn-light">Batal</button> -->
                            <a href="<?= base_url('/user'); ?>" class="btn btn-danger">Batal</a>
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