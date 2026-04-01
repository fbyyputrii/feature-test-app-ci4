<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>User Management</h3>
<a href="/users/create" class="btn btn-primary mb-3">Tambah User</a>

<table id="tableUser" class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u): ?>
        <tr>
            <td><?= $u['nama'] ?></td>
            <td><?= $u['username'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['role'] ?></td>
            <td><?= $u['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
            <td>
                <a href="/users/edit/<?= $u['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/users/delete/<?= $u['id'] ?>" class="btn btn-danger btn-sm btn-delete">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#tableUser').DataTable();

    $('.btn-delete').click(function(e){
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: 'Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

<?= $this->endSection() ?>