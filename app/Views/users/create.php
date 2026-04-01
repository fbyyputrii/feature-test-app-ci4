<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah User</h3>

<form method="post" action="/users/store">

    <div class="mb-2">
        <label>Pegawai</label>
        <select name="pegawai_id" class="form-control">
            <?php foreach($pegawai as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-2">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php foreach($roles as $r): ?>
            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="text" name="username" class="form-control mb-2" placeholder="Username">
    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
    <input type="text" name="phone" class="form-control mb-2" placeholder="Phone">

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>