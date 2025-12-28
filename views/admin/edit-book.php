<?php 
$pageTitle = "Modifier un livre";
$errors = Session::get('errors', []);
$old = Session::get('old', []);
Session::remove('errors');
Session::remove('old');
?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-content">
    <div class="form-container">
        <a href="/admin/books" class="btn btn-secondary">← Retour</a>
        
        <h1>Modifier le livre 📚</h1>
        
        <?php if ($error = Session::getFlash('error')): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST" action="/admin/books/edit/<?= $book->getId() ?>" class="form">
            <div class="form-group">
                <label for="title">Titre *</label>
                <input type="text" id="title" name="title" value="<?= $old['title'] ?? htmlspecialchars($book->getTitle()) ?>" required>
                <?php if (isset($errors['title'])): ?>
                    <span class="error"><?= $errors['title'][0] ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="author">Auteur *</label>
                <input type="text" id="author" name="author" value="<?= $old['author'] ?? htmlspecialchars($book->getAuthor()) ?>" required>
                <?php if (isset($errors['author'])): ?>
                    <span class="error"><?= $errors['author'][0] ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="year">Année de publication *</label>
                <input type="number" id="year" name="year" value="<?= $old['year'] ?? $book->getYear() ?>" required min="1000" max="<?= date('Y') ?>">
                <?php if (isset($errors['year'])): ?>
                    <span class="error"><?= $errors['year'][0] ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-info">
                <p><strong>Statut actuel:</strong> 
                    <span class="badge badge-<?= $book->isAvailable() ? 'success' : 'danger' ?>">
                        <?= $book->isAvailable() ? 'Disponible' : 'Emprunté' ?>
                    </span>
                </p>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                <a href="/admin/books" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>