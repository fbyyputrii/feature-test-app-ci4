<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">

    <h2>Dashboard</h2>
    <p>Selamat Datang, <strong><?= esc($username) ?></strong> - <em><?= esc($role) ?></em></p>

    <?php if ($role === 'manager'): ?>

        <!-- Statistik Pegawai -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Pegawai</h5>
                        <p class="fs-3"><?= esc($total_pegawai) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Pegawai Tetap</h5>
                        <p class="fs-3"><?= esc($total_tetap) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Pegawai Kontrak</h5>
                        <p class="fs-3"><?= esc($total_kontrak) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Magang</h5>
                        <p class="fs-3"><?= esc($total_magang) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pegawai Kontrak Terbaru -->
        <div class="card">
            <div class="card-header">5 Pegawai Kontrak Terbaru</div>
            <div class="card-body">
                <table id="pegawaiTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pegawai_baru as $p): ?>
                            <tr>
                                <td><?= esc($p['nama']) ?></td>
                                <td><?= esc($p['tanggal_masuk']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pegawaiTable').DataTable({
            pageLength: 5,
            lengthChange: false
        });
    });
</script>

<?= $this->endSection() ?>