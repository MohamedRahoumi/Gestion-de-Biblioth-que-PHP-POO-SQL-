<?php $pageTitle = "Gérer les livres"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-content">
    <div class="page-header">
        <h1>Gestion des livres 📚</h1>
        <a href="/admin/books/add" class="btn btn-primary">➕ Ajouter un livre</a>
    </div>
    
    <?php if ($success = Session::getFlash('success')): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    
    <?php if ($error = Session::getFlash('error')): ?>
        <div class="alert alert-error"><?= $error ?></div>
    <?php endif; ?>
    
    <?php if (empty($books)): ?>
        <p class="empty-message">Aucun livre dans la bibliothèque.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Année</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= $book->getId() ?></td>
                            <td><?= htmlspecialchars($book->getTitle()) ?></td>
                            <td><?= htmlspecialchars($book->getAuthor()) ?></td>
                            <td><?= $book->getYear() ?></td>
                            <td>
                                <span class="badge badge-<?= $book->isAvailable() ? 'success' : 'danger' ?>">
                                    <?= $book->isAvailable() ? 'Disponible' : 'Emprunté' ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="/admin/books/edit/<?= $book->getId() ?>" class="btn btn-sm btn-secondary">✏️ Modifier</a>
                                
                                <form method="POST" action="/admin/books/delete" style="display: inline;">
                                    <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>