<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Role Management</h3>
<a href="/roles/create" class="btn btn-primary mb-3">Tambah Role</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    <?php foreach($roles as $r): ?>
    <tr>
        <td><?= $r['name'] ?></td>
        <td>
            <a href="/roles/edit/<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="/roles/delete/<?= $r['id'] ?>" class="btn btn-danger btn-sm btn-delete">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<script>
$('.btn-delete').click(function(e){
    e.preventDefault();
    let url = $(this).attr('href');

    Swal.fire({
        title: 'Yakin?',
        icon: 'warning',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
});
</script>

<?= $this->endSection() ?>