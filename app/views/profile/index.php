<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">
        <?php require_once '../app/views/layouts/topbar.php'; ?>

        <!-- Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-4xl mx-auto">
                
                <!-- Flash Messages -->
                <?php 
                $flash = Helper::getFlashMessage('profile_message');
                if($flash): 
                ?>
                <div class="mb-6 p-4 <?php echo $flash['type'] == 'success' ? 'bg-green-50 border-green-500 text-green-700' : 'bg-red-50 border-red-500 text-red-700'; ?> border-l-4 rounded alert-auto-hide">
                    <div class="flex items-center">
                        <i class="fas <?php echo $flash['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                        <span><?php echo $flash['message']; ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php 
                $flashPassword = Helper::getFlashMessage('password_message');
                if($flashPassword): 
                ?>
                <div class="mb-6 p-4 <?php echo $flashPassword['type'] == 'success' ? 'bg-green-50 border-green-500 text-green-700' : 'bg-red-50 border-red-500 text-red-700'; ?> border-l-4 rounded alert-auto-hide">
                    <div class="flex items-center">
                        <i class="fas <?php echo $flashPassword['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                        <span><?php echo $flashPassword['message']; ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Profile Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="text-center">
                                <div class="w-24 h-24 bg-primary-accent rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-primary-dark"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900"><?php echo $user->nama; ?></h3>
                                <p class="text-sm text-gray-600 mt-1">@<?php echo $user->username; ?></p>
                                <span class="inline-block mt-3 px-3 py-1 text-xs font-semibold rounded-full bg-primary-accent text-primary-dark capitalize">
                                    <?php echo $user->role; ?>
                                </span>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="space-y-3 text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-envelope w-5 mr-3 text-primary"></i>
                                        <span><?php echo $user->email ?: 'Email belum diatur'; ?></span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-calendar w-5 mr-3 text-primary"></i>
                                        <span>Bergabung <?php echo date('d M Y', strtotime($user->created_at)); ?></span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-circle w-5 mr-3 <?php echo $user->is_active ? 'text-green-500' : 'text-red-500'; ?>"></i>
                                        <span><?php echo $user->is_active ? 'Aktif' : 'Nonaktif'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Forms -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Update Profile Form -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-primary-dark mb-6 flex items-center">
                                <i class="fas fa-user-edit mr-2"></i>
                                Update Profil
                            </h3>
                            
                            <form action="<?php echo BASE_URL; ?>/profile/update" method="POST">
                                <!-- Username -->
                                <div class="mb-6">
                                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Username <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="username" 
                                           name="username" 
                                           value="<?php echo Helper::old('username', $user->username); ?>"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Masukkan username">
                                    <?php 
                                    $error = Helper::getFlashMessage('username_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Nama -->
                                <div class="mb-6">
                                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           value="<?php echo Helper::old('nama', $user->nama); ?>"
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Masukkan nama lengkap">
                                    <?php 
                                    $error = Helper::getFlashMessage('nama_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="mb-6">
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="<?php echo Helper::old('email', $user->email); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Masukkan email">
                                    <?php 
                                    $error = Helper::getFlashMessage('email_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg transition-all inline-flex items-center justify-center">
                                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                </button>
                            </form>
                        </div>

                        <!-- Change Password Form -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-primary-dark mb-6 flex items-center">
                                <i class="fas fa-key mr-2"></i>
                                Ubah Password
                            </h3>
                            
                            <form action="<?php echo BASE_URL; ?>/profile/changePassword" method="POST">
                                <!-- Current Password -->
                                <div class="mb-6">
                                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Saat Ini <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" 
                                           id="current_password" 
                                           name="current_password" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Masukkan password saat ini">
                                    <?php 
                                    $error = Helper::getFlashMessage('current_password_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- New Password -->
                                <div class="mb-6">
                                    <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Baru <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" 
                                           id="new_password" 
                                           name="new_password" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Masukkan password baru (min. 6 karakter)">
                                    <?php 
                                    $error = Helper::getFlashMessage('new_password_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-6">
                                    <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" 
                                           id="confirm_password" 
                                           name="confirm_password" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                           placeholder="Ulangi password baru">
                                    <?php 
                                    $error = Helper::getFlashMessage('confirm_password_error');
                                    if($error): 
                                    ?>
                                    <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all inline-flex items-center justify-center">
                                    <i class="fas fa-lock mr-2"></i>Ubah Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
Helper::clearOld();
require_once '../app/views/layouts/footer.php'; 
?>