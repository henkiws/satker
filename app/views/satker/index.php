<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">
        <!-- Top Bar -->
        <?php require_once '../app/views/layouts/topbar.php'; ?>

        <!-- Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo BASE_URL; ?>/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-sm font-medium text-primary">Data Satker</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Flash Message -->
            <?php 
            $flash = Helper::getFlashMessage('satker_message');
            if($flash): 
            ?>
            <div class="mb-6 p-4 <?php echo $flash['type'] == 'success' ? 'bg-green-50 border-green-500 text-green-700' : 'bg-red-50 border-red-500 text-red-700'; ?> border-l-4 rounded alert-auto-hide">
                <div class="flex items-center">
                    <i class="fas <?php echo $flash['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?> mr-2"></i>
                    <span><?php echo $flash['message']; ?></span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Header Section with Add Button -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-primary-dark">Data Satker</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola data Satuan Kerja</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/satker/create" class="inline-flex items-center px-4 py-2.5 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition-all shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Satker
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-dark">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Satker</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if(empty($satkers)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada data satker</p>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach($satkers as $satker): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-primary-accent text-primary-dark">
                                            <?php echo $satker->kode; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo $satker->nama; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo $satker->alamat ?: '-'; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="<?php echo BASE_URL; ?>/satker/edit/<?php echo $satker->id; ?>" class="text-blue-600 hover:text-blue-900 mx-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-<?php echo $satker->id; ?>" action="<?php echo BASE_URL; ?>/satker/delete/<?php echo $satker->id; ?>" method="POST" class="inline">
                                            <button type="button" onclick="confirmDelete('delete-form-<?php echo $satker->id; ?>')" class="text-red-600 hover:text-red-900 mx-2" title="Hapus">
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