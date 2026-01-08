<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            dark: '#0F2854',
                            DEFAULT: '#1C4D8D',
                            light: '#4988C4',
                            accent: '#BDE8F5'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primary-dark via-primary to-primary-light min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-primary-dark p-8 text-center">
                <div class="w-20 h-20 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-user-shield text-4xl text-primary-dark"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">SATKER-PPBJ</h1>
                <p class="text-primary-accent text-sm">Management System</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <?php 
                $flash = Helper::getFlashMessage('login_error');
                if($flash): 
                ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded alert-auto-hide">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo $flash['message']; ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>/auth/loginProcess" method="POST" class="space-y-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-primary"></i>Username
                        </label>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               required
                               autocomplete="username"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                               placeholder="Masukkan username">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-primary"></i>Password
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                               placeholder="Masukkan password">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 text-center text-sm text-gray-600">
                <p>&copy; <?php echo date('Y'); ?> SATKER-PPBJ System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert-auto-hide');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);
    </script>
</body>
</html>