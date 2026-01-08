<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center">
                    <button id="toggleSidebar" class="sm:hidden mr-4 text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-primary-dark">Edit User</h1>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-3xl mx-auto">
                <!-- Back Button -->
                <a href="<?php echo BASE_URL; ?>/user" class="inline-flex items-center text-primary hover:text-primary-dark mb-6">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-md p-6 sm:p-8">
                    <form action="<?php echo BASE_URL; ?>/user/update/<?php echo $user->id; ?>" method="POST">
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

                        <!-- Password -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-gray-500 text-xs">(Kosongkan jika tidak ingin mengubah)</span>
                            </label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                   placeholder="Masukkan password baru">
                            <?php 
                            $error = Helper::getFlashMessage('password_error');
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

                        <!-- Role -->
                        <div class="mb-6">
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select id="role" 
                                    name="role" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                <option value="">Pilih Role</option>
                                <option value="admin" <?php echo Helper::old('role', $user->role) == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="satker" <?php echo Helper::old('role', $user->role) == 'satker' ? 'selected' : ''; ?>>Satker</option>
                                <option value="ppbj" <?php echo Helper::old('role', $user->role) == 'ppbj' ? 'selected' : ''; ?>>PPBJ</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       <?php echo $user->is_active ? 'checked' : ''; ?>
                                       class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Aktif</span>
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                            <a href="<?php echo BASE_URL; ?>/user" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg transition-all inline-flex items-center">
                                <i class="fas fa-save mr-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
Helper::clearOld();
require_once '../app/views/layouts/footer.php'; 
?>