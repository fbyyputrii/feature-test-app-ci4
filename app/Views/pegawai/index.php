<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pegawai</h2>

<a href="/pegawai/create" class="btn btn-primary mb-3">+ Tambah</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($pegawai as $p): ?>
            <tr>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['email'] ?></td>
                <td>
                    <a href="/pegawai/detail/<?= $p['id'] ?>" class="btn btn-info btn-sm">
                        Detail
                    </a>
                    <a href="/pegawai/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>

                    <form action="/pegawai/delete/<?= $p['id'] ?>" method="post" class="d-inline delete-form">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?= $this->endSection() ?>
<script>
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        let form = this;

        Swal.fire({
            title: 'Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>