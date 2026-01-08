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
                    <h1 class="text-2xl font-bold text-primary-dark">Edit PPBJ</h1>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="max-w-3xl mx-auto">
                <!-- Back Button -->
                <a href="<?php echo BASE_URL; ?>/ppbj" class="inline-flex items-center text-primary hover:text-primary-dark mb-6">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-md p-6 sm:p-8">
                    <form action="<?php echo BASE_URL; ?>/ppbj/update/<?php echo $ppbj->id; ?>" method="POST">
                        <!-- Nama -->
                        <div class="mb-6">
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   value="<?php echo Helper::old('nama', $ppbj->nama); ?>"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                   placeholder="Masukkan nama PPBJ">
                            <?php 
                            $error = Helper::getFlashMessage('nama_error');
                            if($error): 
                            ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- NIP -->
                        <div class="mb-6">
                            <label for="nip" class="block text-sm font-semibold text-gray-700 mb-2">
                                NIP <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nip" 
                                   name="nip" 
                                   value="<?php echo Helper::old('nip', $ppbj->nip); ?>"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                   placeholder="Masukkan NIP">
                            <?php 
                            $error = Helper::getFlashMessage('nip_error');
                            if($error): 
                            ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo $error['message']; ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-6">
                            <label for="jabatan" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jabatan
                            </label>
                            <input type="text" 
                                   id="jabatan" 
                                   name="jabatan" 
                                   value="<?php echo Helper::old('jabatan', $ppbj->jabatan); ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                   placeholder="Masukkan jabatan">
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                            <a href="<?php echo BASE_URL; ?>/ppbj" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all">
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