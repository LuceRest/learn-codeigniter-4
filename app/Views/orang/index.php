<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="mt-2">Daftar Orang</h1>
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan keyword pencarian..." name="keyword">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = count($orang) * $currentPage - (count($orang) - 1); ?>
                        <?php $j = 1 + (5 * ($currentPage - 1)); ?>
                        <?php foreach ($orang as $org) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $org['nama']; ?></td>
                                <td><?= $org['alamat']; ?></td>
                                <td>
                                    <a href="" class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('orang', 'orang_pagination'); ?>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
