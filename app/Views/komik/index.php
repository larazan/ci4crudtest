<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-md-6">
                    <h1>Daftar Komik</h1>
                </div>
                <div class="col-md-6">
                    <a href="/komik/create" class="btn btn-primary mb-3">Tambah Data</a>
                </div>
            </div>
            <div class="row">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" id="inputGroupFile04" placeholder="search something">
                        <button class="btn btn-outline-secondary" type="submit" name="submit" id="inputGroupFileAddon04">Cari</button>
                    </div>
                </form>
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <img src="/img/aot.jpg" alt="" width="100" class="sampul" />
                        </td>
                        <td>Attact on Titan</td>
                        <td>
                            <button type="button" class="btn btn-success">Success</button>
                            <button type="button" class="btn btn-danger">Danger</button>
                            <button type="button" class="btn btn-warning">Warning</button>
                        </td>
                    </tr>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($komiks as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>
                                <img src="/img/<?= $k['sampul']; ?>" alt="" width="100" class="sampul" />
                            </td>
                            <td><?= $k['judul']; ?></td>
                            <td>
                                <a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?= $pager->links('komik', 'cus_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>