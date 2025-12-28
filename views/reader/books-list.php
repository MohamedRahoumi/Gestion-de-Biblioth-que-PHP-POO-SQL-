<?php $pageTitle = "Catalogue de livres"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Titre -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800">
            Catalogue de livres 📚
        </h1>
    </div>

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

    <!-- Liste -->
    <?php if (empty($books)): ?>
        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-10 text-center">
            <p class="text-gray-600">
                Aucun livre disponible pour le moment.
            </p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php foreach ($books as $book): ?>
                <div class="group bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                    <!-- Status -->
                    <div class="p-4 flex justify-end">
                        <?php if ($book->isAvailable()): ?>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                         bg-green-100 text-green-700">
                                ✓ Disponible
                            </span>
                        <?php else: ?>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                         bg-red-100 text-red-700">
                                ✗ Emprunté
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Contenu -->
                    <div class="px-6 pb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-1 line-clamp-2">
                            <?= htmlspecialchars($book->getTitle()) ?>
                        </h3>

                        <p class="text-sm text-gray-600">
                            <?= htmlspecialchars($book->getAuthor()) ?>
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Année : <?= $book->getYear() ?>
                        </p>

                        <!-- Action -->
                        <div class="mt-5">
                            <a href="/reader/book/<?= $book->getId() ?>"
                               class="block text-center bg-blue-600 hover:bg-blue-700
                                      text-white py-2 rounded-xl text-sm font-semibold transition">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
