<?php $pageTitle = "Mes emprunts"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Titre -->
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8">
        Mes emprunts 📖
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

    <!-- Emprunts en cours -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Emprunts en cours
        </h2>

        <?php if (empty($activeBorrows)): ?>
            <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-8 text-center">
                <p class="text-gray-600">
                    Vous n'avez aucun emprunt en cours.
                </p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($activeBorrows as $borrow):
                    $book = $borrow->getBook();
                ?>
                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6 flex flex-col justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">
                                <?= htmlspecialchars($book->getTitle()) ?>
                            </h3>

                            <p class="text-sm text-gray-600">
                                <?= htmlspecialchars($book->getAuthor()) ?>
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                Emprunté le :
                                <?= date('d/m/Y', strtotime($borrow->getBorrowDate())) ?>
                            </p>
                        </div>

                        <form method="POST" action="/reader/return" class="mt-6">
                            <input type="hidden" name="borrow_id" value="<?= $borrow->getId() ?>">
                            <button type="submit"
                                    onclick="return confirm('Confirmer le retour ?')"
                                    class="w-full bg-gray-200 hover:bg-gray-300
                                           text-gray-800 py-2 rounded-xl text-sm font-semibold transition">
                                Retourner le livre
                            </button>
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Historique -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            Historique des emprunts
        </h2>

        <?php if (empty($pastBorrows)): ?>
            <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-8 text-center">
                <p class="text-gray-600">
                    Aucun emprunt passé.
                </p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto bg-white rounded-2xl shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-6 py-4 text-left">Livre</th>
                            <th class="px-6 py-4 text-left">Auteur</th>
                            <th class="px-6 py-4 text-left">Date d'emprunt</th>
                            <th class="px-6 py-4 text-left">Date de retour</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php foreach ($pastBorrows as $borrow):
                            $book = $borrow->getBook();
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    <?= htmlspecialchars($book->getTitle()) ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= htmlspecialchars($book->getAuthor()) ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= date('d/m/Y', strtotime($borrow->getBorrowDate())) ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?= date('d/m/Y', strtotime($borrow->getReturnDate())) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
