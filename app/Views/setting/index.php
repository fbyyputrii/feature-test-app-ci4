<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-cogs"></i> Setting Tunjangan</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="/setting/update">

            <div class="mb-3">
                <label class="form-label">Tarif per KM (Base Fare)</label>
                <input 
                    type="number" 
                    step="0.01"
                    name="base_fare" 
                    value="<?= old('base_fare', $setting['base_fare'] ?? '') ?>" 
                    class="form-control"
                    placeholder="Contoh: 2000"
                >
                <small class="text-muted">
                    Digunakan untuk menghitung tunjangan transport
                </small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/dashboard" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>


<?php if(session()->getFlashdata('errors')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Validasi Gagal',
    html: `<?php foreach(session()->getFlashdata('errors') as $e): ?>
                <div><?= $e ?></div>
           <?php endforeach; ?>`
});
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
<script>
Swal.fire('Berhasil', '<?= session()->getFlashdata('success') ?>', 'success');
</script>
<?php endif; ?>

<?= $this->endSection() ?>