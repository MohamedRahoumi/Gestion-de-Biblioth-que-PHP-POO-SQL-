<?php $pageTitle = "Gérer les lecteurs"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-content">
    <h1>Gestion des lecteurs 👥</h1>
    
    <?php if (empty($readers)): ?>
        <p class="empty-message">Aucun lecteur inscrit.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($readers as $reader): ?>
                        <tr>
                            <td><?= $reader->getId() ?></td>
                            <td><?= htmlspecialchars($reader->getFullName()) ?></td>
                            <td><?= htmlspecialchars($reader->getEmail()) ?></td>
                            <td>
                                <span class="badge badge-info">
                                    <?= ucfirst($reader->getRole()) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="stats-info">
            <p>Total de lecteurs: <strong><?= count($readers) ?></strong></p>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>