<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Comic</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $comic['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comic['judul']; ?></h5>
                            <p class="card-text">Penulis : <?= $comic['penulis']; ?></p>
                            <p class="card-text"><small class="text-body-secondary">Penerbit : <?= $comic['penerbit']; ?></small></p>

                            <a href="/comics/edit/<?= $comic['slug']; ?>" class="btn btn-warning">Edit</a>
                            
                            <form action="/comics/<?= $comic['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            <!-- <a href="/comics/delete/<?= $comic['id']; ?>" class="btn btn-danger">Delete</a> -->

                            <br><br>
                            <a href="/comics">Back to comics list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
