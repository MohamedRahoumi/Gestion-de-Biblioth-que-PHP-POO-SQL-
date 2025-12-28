<?php $pageTitle = "Connexion - BiblioTech"; ?>
<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="min-h-screen flex">
    <!-- Left Side - Hero Image (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary to-primary-dark items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=1200'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        
        <div class="relative z-10 max-w-lg p-12 text-white">
            <div class="mb-8 inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h2 class="text-4xl font-bold mb-4 leading-tight">Bienvenue sur BiblioTech</h2>
            <p class="text-lg text-white/90 leading-relaxed">
                Votre portail de gestion de bibliothèque moderne. Gérez vos emprunts, consultez le catalogue et découvrez de nouveaux ouvrages en toute simplicité.
            </p>
            <div class="mt-8 flex gap-6">
                <div class="flex flex-col">
                    <span class="text-3xl font-bold">10K+</span>
                    <span class="text-sm text-white/70">Livres disponibles</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-bold">2.5K+</span>
                    <span class="text-sm text-white/70">Lecteurs actifs</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
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
        <div class="flex-1 flex items-center justify-center px-6 sm:px-12 lg:px-20 py-8">
            <div class="w-full max-w-md">
                <!-- Welcome Text -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Connexion</h1>
                    <p class="text-gray-600 dark:text-gray-400">Connectez-vous pour accéder à votre espace</p>
                </div>

                <!-- Tabs -->
                <div class="mb-8">
                    <div class="flex border-b border-gray-200 dark:border-gray-700">
                        <button class="flex-1 pb-4 text-sm font-semibold text-primary border-b-2 border-primary transition-colors">
                            Connexion
                        </button>
                        <a href="/register" class="flex-1 pb-4 text-sm font-semibold text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 border-b-2 border-transparent transition-colors text-center">
                            Inscription
                        </a>
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

                <?php if ($success = Session::getFlash('success')): ?>
                    <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm"><?= htmlspecialchars($success) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="/login" class="space-y-5">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                                placeholder="votre.email@example.com"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Mot de passe
                            </label>
                            <a href="/forgot-password" class="text-sm font-medium text-primary hover:text-primary-dark">
                                Mot de passe oublié ?
                            </a>
                        </div>
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
                                class="w-full pl-10 pr-12 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eye-icon" class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                            class="w-4 h-4 text-primary border-gray-300 dark:border-gray-600 rounded focus:ring-primary"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            Se souvenir de moi
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 px-4 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-lg shadow-primary/30 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Se connecter
                    </button>
                </form>

                <!-- Sign Up Link -->
                <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                    Pas encore de compte ? 
                    <a href="/register" class="font-semibold text-primary hover:text-primary-dark">
                        S'inscrire
                    </a>
                </p>

                <!-- Demo Credentials (Uncomment if needed) -->
                <!-- <div class="mt-6 p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                    <p class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-2">Compte de démo Admin :</p>
                    <p class="text-xs text-blue-600 dark:text-blue-300">Email: admin@library.com</p>
                    <p class="text-xs text-blue-600 dark:text-blue-300">Mot de passe: admin123</p>
                </div> -->
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
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    
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