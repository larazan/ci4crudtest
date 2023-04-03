<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Contact us</h1>
            <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Message</label>
                <textarea class="form-control" id="exampleInputPassword1"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <?php foreach ($alamat as $a) : ?>
            <ul>
                <li><?= $a['tipe']; ?></li>
                <li><?= $a['alamat']; ?></li>
                <li><?= $a['kota']; ?></li>
            </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>