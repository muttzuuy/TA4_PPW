<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h1 class="h3"><i class="fas fa-address-book me-2"></i> Daftar Kontak Anda</h1>
    <a href="tambah.php" class="btn btn-success">➕ Tambah Kontak Baru</a>
</div>

<form method="GET" action="index.php" class="mb-4">
    <div class="input-group shadow-sm">
        <input type="text" class="form-control" placeholder="Cari berdasarkan Nama, Email, atau Telepon..." name="search" value="<?= htmlspecialchars($keyword) ?>">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        <?php if (!empty($keyword)): ?>
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
        <?php endif; ?>
    </div>
</form>
<div class="card shadow-lg border-0">
    <div class="card-header card-header-accent">
        Hasil Ditemukan: <span class="badge rounded-pill bg-primary"><?= count($filtered_contacts) ?></span>
        <?php if (!empty($keyword)): ?>
            <span class="ms-3 badge bg-info text-dark">Filter Aktif: "<?= htmlspecialchars($keyword) ?>"</span>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th style="width: 170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    if (empty($filtered_contacts)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <?php if (!empty($keyword)): ?>
                                    Kontak dengan kata kunci "<?= htmlspecialchars($keyword) ?>" tidak ditemukan.
                                <?php else: ?>
                                    Belum ada kontak yang tersimpan.
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($filtered_contacts as $id => $contact): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><span class="fw-bold"><?= sanitize_output($contact['name']) ?></span></td>
                                <td><?= sanitize_output($contact['email']) ?></td>
                                <td><?= format_phone($contact['phone']) ?></td> 
                                <td>
                                    <a href="edit.php?id=<?= $id ?>" class="btn btn-sm btn-info me-1" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="hapus.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kontak <?= sanitize_output($contact['name']) ?>?');" title="Hapus"><i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>