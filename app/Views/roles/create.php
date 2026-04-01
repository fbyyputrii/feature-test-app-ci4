<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Role</h3>

<form method="post" action="/roles/store">
    <input type="text" name="name" class="form-control mb-2" placeholder="Nama Role">
    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>