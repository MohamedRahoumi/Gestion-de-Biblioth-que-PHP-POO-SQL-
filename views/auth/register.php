<?php 
$pageTitle = "Inscription - BiblioTech";
$errors = Session::get('errors', []);
$old = Session::get('old', []);
Session::remove('errors');
Session::remove('old');
?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="min-h-screen flex">
    <!-- Left Side - Hero Image (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary to-primary-dark items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1200'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        
        <div class="relative z-10 max-w-lg p-12 text-white">
            <div class="mb-8 inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h2 class="text-4xl font-bold mb-4 leading-tight">Rejoignez BiblioTech</h2>
            <p class="text-lg text-white/90 leading-relaxed mb-8">
                Créez votre compte et accédez à des milliers de livres. Empruntez, lisez et découvrez votre prochaine lecture préférée.
            </p>
            
            <!-- Features -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-white/90">Accès à plus de 10 000 livres</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-white/90">Emprunts gratuits et illimités</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm text-white/90">Recommandations personnalisées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Registration Form -->
    <div class="w-full lg:w-1/2 flex flex-col bg-white dark:bg-gray-900">
        <!-- Mobile Logo (Visible only on mobile) -->
        <div class="lg:hidden flex items-center justify-between px-6 py-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900 dark:text-white">BiblioTech</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-6 sm:px-12 lg:px-20 py-8 overflow-y-auto">
            <div class="w-full max-w-md">
                <!-- Welcome Text -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Créer un compte</h1>
                    <p class="text-gray-600 dark:text-gray-400">Inscrivez-vous pour commencer votre aventure</p>
                </div>

                <!-- Tabs -->
                <div class="mb-8">
                    <div class="flex border-b border-gray-200 dark:border-gray-700">
                        <a href="/login" class="flex-1 pb-4 text-sm font-semibold text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 border-b-2 border-transparent transition-colors text-center">
                            Connexion
                        </a>
                        <button class="flex-1 pb-4 text-sm font-semibold text-primary border-b-2 border-primary transition-colors">
                            Inscription
                        </button>
                    </div>
                </div>

                <!-- Flash Messages -->
                <?php if ($error = Session::getFlash('error')): ?>
                    <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm"><?= htmlspecialchars($error) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form method="POST" action="/register" class="space-y-5">
                    <!-- First Name & Last Name Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- First Name -->
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Prénom <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="firstName" 
                                name="firstName" 
                                value="<?= htmlspecialchars($old['firstName'] ?? '') ?>"
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white <?= isset($errors['firstName']) ? 'border-red-500 dark:border-red-500' : '' ?>"
                                placeholder="Jean"
                            >
                            <?php if (isset($errors['firstName'])): ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <?= htmlspecialchars($errors['firstName'][0]) ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nom <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="lastName" 
                                name="lastName" 
                                value="<?= htmlspecialchars($old['lastName'] ?? '') ?>"
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white <?= isset($errors['lastName']) ? 'border-red-500 dark:border-red-500' : '' ?>"
                                placeholder="Dupont"
                            >
                            <?php if (isset($errors['lastName'])): ?>
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <?= htmlspecialchars($errors['lastName'][0]) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white <?= isset($errors['email']) ? 'border-red-500 dark:border-red-500' : '' ?>"
                                placeholder="jean.dupont@example.com"
                            >
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <?= htmlspecialchars($errors['email'][0]) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Mot de passe <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white <?= isset($errors['password']) ? 'border-red-500 dark:border-red-500' : '' ?>"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eye-icon-1" class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <?= htmlspecialchars($errors['password'][0]) ?>
                            </p>
                        <?php else: ?>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Minimum 8 caractères avec lettres et chiffres
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Password Confirmation Input -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Confirmer le mot de passe <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eye-icon-2" class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            required
                            class="w-4 h-4 mt-1 text-primary border-gray-300 dark:border-gray-600 rounded focus:ring-primary"
                        >
                        <label for="terms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            J'accepte les <a href="/terms" class="text-primary hover:underline">conditions d'utilisation</a> et la <a href="/privacy" class="text-primary hover:underline">politique de confidentialité</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 px-4 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Créer mon compte
                    </button>
                </form>

                <!-- Login Link -->
                <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                    Déjà un compte ? 
                    <a href="/login" class="font-semibold text-primary hover:text-primary-dark">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="py-6 text-center border-t border-gray-200 dark:border-gray-700">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                © <?= date('Y') ?> BiblioTech. Tous droits réservés.
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(iconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
    }
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>