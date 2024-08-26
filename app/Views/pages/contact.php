<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Contact</h1>
                <?php foreach ($alamat as $a) : ?>
                    <ul>
                        <li><?= $a['tipe']; ?></li>
                        <li><?= $a['alamat']; ?></li>
                        <li><?= $a['kota']; ?></li>
                    </ul>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui voluptas optio numquam ad id modi incidunt perferendis cupiditate veritatis earum.
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
