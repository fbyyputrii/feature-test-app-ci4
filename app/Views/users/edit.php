<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit User</h3>

<form method="post" action="/users/update/<?= $user['id'] ?>">

    <div class="mb-2">
        <label>Pegawai</label>
        <select name="pegawai_id" class="form-control">
            <?php foreach($pegawai as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $user['pegawai_id'] ? 'selected' : '' ?>>
                <?= $p['nama'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-2">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php foreach($roles as $r): ?>
            <option value="<?= $r['id'] ?>" <?= $r['id'] == $user['role_id'] ? 'selected' : '' ?>>
                <?= $r['name'] ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control mb-2">
    <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control mb-2">
    <input type="text" name="phone" value="<?= $user['phone'] ?>" class="form-control mb-2">

    <div class="mb-2">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" <?= $user['is_active'] ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= !$user['is_active'] ? 'selected' : '' ?>>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>