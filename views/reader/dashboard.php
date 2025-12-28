<?php $pageTitle = "Tableau de bord - Lecteur"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-8">

    <!-- Titre -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Bienvenue, <?= htmlspecialchars($reader->getFullName()) ?> 👋
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

    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Emprunts actifs</p>
                <p class="text-3xl font-bold text-gray-800">
                    <?= count($activeBorrows) ?>
                </p>
            </div>
            <div class="text-blue-500 text-4xl">📚</div>
        </div>
    </div>

    <!-- Section emprunts -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Mes emprunts en cours
        </h2>

        <?php if (empty($activeBorrows)): ?>
            <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-6 text-center">
                <p class="text-gray-600 mb-4">
                    Vous n'avez aucun emprunt en cours.
                </p>
                <a href="/reader/books"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Parcourir les livres
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($activeBorrows as $borrow):
                    $book = $borrow->getBook();
                ?>
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                                <?= htmlspecialchars($book->getTitle()) ?>
                            </h3>
                            <p class="text-sm text-gray-600">
                                Par <?= htmlspecialchars($book->getAuthor()) ?>
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                Année : <?= $book->getYear() ?>
                            </p>
                            <p class="text-sm text-gray-500 mt-2">
                                Emprunté le :
                                <?= date('d/m/Y', strtotime($borrow->getBorrowDate())) ?>
                            </p>
                        </div>

                        <form method="POST" action="/reader/return" class="mt-4">
                            <input type="hidden" name="borrow_id" value="<?= $borrow->getId() ?>">
                            <button type="submit"
                                    onclick="return confirm('Confirmer le retour de ce livre ?')"
                                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 rounded-lg transition">
                                Retourner le livre
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Actions rapides -->
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="/reader/books"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-center transition">
            📚 Voir tous les livres
        </a>

        <a href="/reader/borrows"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg text-center transition">
            📖 Historique des emprunts
        </a>
    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
