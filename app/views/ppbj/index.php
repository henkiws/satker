<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <button id="toggleSidebar" class="sm:hidden mr-4 text-gray-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-primary-dark">Data PPBJ</h1>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/ppbj/create" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg transition-all inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>Tambah PPBJ
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <?php 
            $flash = Helper::getFlashMessage('ppbj_message');
            if($flash): 
            ?>
            <div class="mb-6 p-4 <?php echo $flash['type'] == 'success' ? 'bg-green-50 border-green-500 text-green-700' : 'bg-red-50 border-red-500 text-red-700'; ?> border-l-4 rounded alert-auto-hide">
                <div class="flex items-center">
                    <i class="fas <?php echo $flash['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                    <span><?php echo $flash['message']; ?></span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-dark">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">NIP</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Jabatan</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(empty($ppbjs)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada data PPBJ</p>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($ppbjs as $ppbj): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-primary-accent text-primary-dark">
                                            <?php echo $ppbj->nip; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo $ppbj->nama; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo $ppbj->jabatan ?: '-'; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="<?php echo BASE_URL; ?>/ppbj/edit/<?php echo $ppbj->id; ?>" class="text-blue-600 hover:text-blue-900 mx-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-<?php echo $ppbj->id; ?>" action="<?php echo BASE_URL; ?>/ppbj/delete/<?php echo $ppbj->id; ?>" method="POST" class="inline">
                                            <button type="button" onclick="confirmDelete('delete-form-<?php echo $ppbj->id; ?>')" class="text-red-600 hover:text-red-900 mx-2" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>