<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-money-bill-wave"></i> Data Tunjangan</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
            <h6 class="mb-0">Daftar Tunjangan</h6>
            <a href="/tunjangan/create" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Hitung Tunjangan
            </a>
        </div>

        <table id="tableTunjangan" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>KM / Hari</th>
                    <th>Hari Kerja</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($tunjangan as $t): ?>
                <tr>
                    <td><?= $t['nama'] ?></td>
                    <td><?= $t['km'] ?> km</td>
                    <td><?= $t['hari_kerja'] ?> hari</td>
                    <td>
                        <span class="badge bg-success">
                            Rp <?= number_format($t['total'], 0, ',', '.') ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
$(document).ready(function() {
    $('#tableTunjangan').DataTable();
});
</script>

<?= $this->endSection() ?>