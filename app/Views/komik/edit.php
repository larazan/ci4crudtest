<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-md-6">
                    <h1>Edit</h1>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row">


                <form class="row g-3" action="/komik/update/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $komik['slug']; ?>" />
                    <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>" />
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $komik['judul']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                        <div class="col-sm-2">
                            <img src="/img/<?= $komik['sampul'] ?>" class="img-thumbnail img-preview" />
                            <!-- <img src="/img/default.jpg" class="img-thumbnail img-preview" /> -->
                        </div>
                        <div class="col-sm-8">
                            <input class="custom-file-input form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>