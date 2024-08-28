<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/comics/create" class="btn btn-primary mb-3">Add new comic</a>
                <h1 class="mt-2">Daftar Komik</h1>
                <?php if( session()->getFlashdata('pesan') ) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($comics as $comic) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><img src="/img/<?= $comic['sampul']; ?>" alt="" class="sampul"></td>
                                <td><?= $comic['judul']; ?></td>
                                <td>
                                    <a href="/comics/<?= $comic['slug']; ?>" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
