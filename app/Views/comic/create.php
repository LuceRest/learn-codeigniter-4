<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="my-3">Form Add New Comic</h2>
                <!-- error data -->
                <!-- <?php if (session('validation')) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            <?php foreach (session('validation')->getErrors() as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?> -->
                <!-- error data --> 
                <form action="/comics/save" method="post">
                    <?= csrf_field(); ?>
                    <div class=" row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                            <?php if (session('validation')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('judul'); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                            <?php if (session('validation')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('penulis'); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                            <?php if (session('validation')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('penerbit'); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= (session('validation')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" value="<?= old('sampul'); ?>">
                            <?php if (session('validation')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('sampul'); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comic</button>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
