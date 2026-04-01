<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Role</h3>

<form method="post" action="/roles/update/<?= $role['id'] ?>">
    <input type="text" name="name" value="<?= $role['name'] ?>" class="form-control mb-2">
    <button class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>