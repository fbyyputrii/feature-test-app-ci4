<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-clipboard-list"></i> Log Aktivitas</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <table id="tableLogs" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($logs as $log): ?>
                <tr>
                    <td>
                        <i class="fa fa-user"></i> <?= $log['username'] ?>
                    </td>

                    <td>
                        <span class="badge 
                            <?= $log['action'] == 'create' ? 'bg-success' : '' ?>
                            <?= $log['action'] == 'update' ? 'bg-warning text-dark' : '' ?>
                            <?= $log['action'] == 'delete' ? 'bg-danger' : '' ?>
                            <?= $log['action'] == 'login' ? 'bg-primary' : '' ?>
                        ">
                            <?= ucfirst($log['action']) ?>
                        </span>
                    </td>

                    <td>
                        <span class="badge bg-secondary">
                            <?= ucfirst($log['module']) ?>
                        </span>
                    </td>

                    <td><?= $log['description'] ?></td>

                    <td>
                        <small class="text-muted">
                            <?= date('d M Y H:i', strtotime($log['created_at'])) ?>
                        </small>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
$(document).ready(function() {
    $('#tableLogs').DataTable({
        order: [[4, 'desc']] 
    });
});
</script>

<?= $this->endSection() ?>