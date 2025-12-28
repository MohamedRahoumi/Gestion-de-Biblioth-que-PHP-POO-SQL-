<nav class="sticky top-0 z-50 backdrop-blur bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 text-white font-extrabold text-lg tracking-wide">
                <span class="bg-white/20 rounded-lg px-2 py-1">📚</span>
                <?= APP_NAME ?>
            </a>

            <!-- Menu Desktop -->
            <ul class="hidden md:flex items-center gap-6">
                <?php if (Session::isAdmin()): ?>
                    <li><a href="/admin/dashboard" class="nav-pro">Dashboard</a></li>
                    <li><a href="/admin/books" class="nav-pro">Livres</a></li>
                    <li><a href="/admin/users" class="nav-pro">Lecteurs</a></li>
                    <li><a href="/admin/borrows" class="nav-pro">Emprunts</a></li>
                <?php else: ?>
                    <li><a href="/reader/dashboard" class="nav-pro">Dashboard</a></li>
                    <li><a href="/reader/books" class="nav-pro">Livres</a></li>
                    <li><a href="/reader/borrows" class="nav-pro">Mes emprunts</a></li>
                <?php endif; ?>
            </ul>

            <!-- User -->
            <div class="hidden md:flex items-center gap-4">
                <div class="flex items-center gap-2 bg-white/20 px-3 py-1.5 rounded-full text-white text-sm">
                    <span class="text-lg">👤</span>
                    <?= htmlspecialchars(Session::get('user_name')) ?>
                </div>

                <a href="/logout"
                   class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-white text-sm font-semibold transition">
                    Déconnexion
                </a>
            </div>

            <!-- Mobile button -->
            <button id="mobile-menu-btn" class="md:hidden text-white text-2xl">
                ☰
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gradient-to-b from-indigo-600 to-purple-700">
        <ul class="px-6 py-6 space-y-4 text-white">
            <?php if (Session::isAdmin()): ?>
                <li><a href="/admin/dashboard" class="mobile-pro">Dashboard</a></li>
                <li><a href="/admin/books" class="mobile-pro">Livres</a></li>
                <li><a href="/admin/users" class="mobile-pro">Lecteurs</a></li>
                <li><a href="/admin/borrows" class="mobile-pro">Emprunts</a></li>
            <?php else: ?>
                <li><a href="/reader/dashboard" class="mobile-pro">Dashboard</a></li>
                <li><a href="/reader/books" class="mobile-pro">Livres</a></li>
                <li><a href="/reader/borrows" class="mobile-pro">Mes emprunts</a></li>
            <?php endif; ?>

            <li class="pt-4 border-t border-white/20 text-sm">
                👤 <?= htmlspecialchars(Session::get('user_name')) ?>
            </li>

            <li>
                <a href="/logout"
                   class="block text-center bg-red-500 hover:bg-red-600 py-2 rounded-full font-semibold transition">
                    Déconnexion
                </a>
            </li>
        </ul>
    </div>
</nav>
