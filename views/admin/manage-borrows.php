<?php $pageTitle = "Gérer les emprunts"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-content">
    <h1>Gestion des emprunts 📖</h1>
    
    <?php if (empty($borrows)): ?>
        <p class="empty-message">Aucun emprunt enregistré.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lecteur</th>
                        <th>Livre</th>
                        <th>Date d'emprunt</th>
                        <th>Date de retour</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borrows as $borrow): 
                        $reader = $borrow->getReader();
                        $book = $borrow->getBook();
                    ?>
                        <tr>
                            <td><?= $borrow->getId() ?></td>
                            <td><?= htmlspecialchars($reader->getFullName()) ?></td>
                            <td><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($borrow->getBorrowDate())) ?></td>
                            <td>
                                <?= $borrow->getReturnDate() ? date('d/m/Y H:i', strtotime($borrow->getReturnDate())) : '-' ?>
                            </td>
                            <td>
                                <span class="badge badge-<?= $borrow->isActive() ? 'warning' : 'success' ?>">
                                    <?= $borrow->isActive() ? 'En cours' : 'Retourné' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="stats-info">
            <p>Total d'emprunts: <strong><?= count($borrows) ?></strong></p>
            <p>Emprunts actifs: <strong><?= count(array_filter($borrows, fn($b) => $b->isActive())) ?></strong></p>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>