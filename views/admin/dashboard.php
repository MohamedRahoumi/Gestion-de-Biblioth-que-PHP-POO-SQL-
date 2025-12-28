<?php $pageTitle = "Tableau de bord - Admin"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="dashboard">
    <h1>Tableau de bord Administrateur 🔧</h1>
    
    <?php if ($success = Session::getFlash('success')): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total des livres</h3>
            <p class="stat-number"><?= $totalBooks ?></p>
        </div>
        
        <div class="stat-card stat-success">
            <h3>Livres disponibles</h3>
            <p class="stat-number"><?= $availableBooks ?></p>
        </div>
        
        <div class="stat-card stat-warning">
            <h3>Livres empruntés</h3>
            <p class="stat-number"><?= $borrowedBooks ?></p>
        </div>
        
        <div class="stat-card stat-info">
            <h3>Emprunts actifs</h3>
            <p class="stat-number"><?= count($activeBorrows) ?></p>
        </div>
    </div>
    
    <div class="quick-actions">
        <a href="/admin/books/add" class="btn btn-primary">➕ Ajouter un livre</a>
        <a href="/admin/books" class="btn btn-secondary">📚 Gérer les livres</a>
        <a href="/admin/users" class="btn btn-secondary">👥 Gérer les lecteurs</a>
        <a href="/admin/borrows" class="btn btn-secondary">📖 Voir les emprunts</a>
    </div>
    
    <div class="section">
        <h2>Emprunts récents</h2>
        
        <?php if (empty($activeBorrows)): ?>
            <p class="empty-message">Aucun emprunt actif.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lecteur</th>
                            <th>Livre</th>
                            <th>Date d'emprunt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($activeBorrows, 0, 5) as $borrow): 
                            $reader = $borrow->getReader();
                            $book = $borrow->getBook();
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($reader->getFullName()) ?></td>
                                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($borrow->getBorrowDate())) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (count($activeBorrows) > 5): ?>
                <a href="/admin/borrows" class="btn btn-link">Voir tous les emprunts</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>