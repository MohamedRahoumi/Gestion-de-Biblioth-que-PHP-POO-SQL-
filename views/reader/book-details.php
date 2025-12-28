<?php $pageTitle = $book->getTitle(); ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-5xl mx-auto px-4 py-10">

    <!-- Retour -->
    <a href="/reader/books"
       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 mb-6 transition">
        ← Retour aux livres
    </a>

    <!-- Carte principale -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <!-- Titre -->
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4">
            <?= htmlspecialchars($book->getTitle()) ?>
        </h1>

        <!-- Alerts -->
        <?php if ($success = Session::getFlash('success')): ?>
            <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <?php if ($error = Session::getFlash('error')): ?>
            <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Infos livre -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">

            <div>
                <p class="text-sm text-gray-500">Auteur</p>
                <p class="text-lg font-semibold text-gray-800">
                    <?= htmlspecialchars($book->getAuthor()) ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Année de publication</p>
                <p class="text-lg font-semibold text-gray-800">
                    <?= $book->getYear() ?>
                </p>
            </div>

            <div class="sm:col-span-2">
                <p class="text-sm text-gray-500 mb-1">Statut</p>

                <?php if ($book->isAvailable()): ?>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                                 bg-green-100 text-green-700 font-medium text-sm">
                        ✓ Disponible
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                                 bg-red-100 text-red-700 font-medium text-sm">
                        ✗ Emprunté
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-10 border-t pt-6">

            <?php if ($book->isAvailable() && !$hasActiveBorrow): ?>
                <form method="POST" action="/reader/borrow">
                    <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                    <button type="submit"
                            onclick="return confirm('Voulez-vous emprunter ce livre ?')"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700
                                   text-white px-8 py-3 rounded-xl font-semibold transition shadow">
                        📖 Emprunter ce livre
                    </button>
                </form>

            <?php elseif ($hasActiveBorrow): ?>
                <div class="rounded-lg bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3">
                    ℹ️ Vous avez déjà emprunté ce livre.
                </div>

            <?php else: ?>
                <div class="rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3">
                    ⏳ Ce livre n'est pas disponible pour le moment.
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
