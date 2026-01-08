<?php require_once '../app/views/layouts/header.php'; ?>

<div class="flex">
    <?php require_once '../app/views/layouts/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">
        <?php require_once '../app/views/layouts/topbar.php'; ?>

        <!-- Dashboard Content -->
        <div class="p-4 sm:p-6 lg:p-8">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-primary to-primary-light rounded-xl shadow-lg p-6 mb-8 text-white">
                <h2 class="text-2xl font-bold mb-2">Selamat Datang, <?php echo Auth::user()->nama; ?>!</h2>
                <p class="text-primary-accent">Sistem Manajemen Satker dan PPBJ</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Satker Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-primary-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-building text-2xl text-primary-dark"></i>
                            </div>
                            <span class="text-3xl font-bold text-primary-dark"><?php echo $totalSatker; ?></span>
                        </div>
                        <h3 class="text-gray-600 font-medium">Total Satker</h3>
                        <a href="<?php echo BASE_URL; ?>/satker" class="inline-block mt-3 text-primary hover:text-primary-dark text-sm font-medium">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- PPBJ Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-primary-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-2xl text-primary-dark"></i>
                            </div>
                            <span class="text-3xl font-bold text-primary-dark"><?php echo $totalPpbj; ?></span>
                        </div>
                        <h3 class="text-gray-600 font-medium">Total PPBJ</h3>
                        <a href="<?php echo BASE_URL; ?>/ppbj" class="inline-block mt-3 text-primary hover:text-primary-dark text-sm font-medium">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-primary-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-cog text-2xl text-primary-dark"></i>
                            </div>
                            <span class="text-3xl font-bold text-primary-dark"><?php echo $totalUsers; ?></span>
                        </div>
                        <h3 class="text-gray-600 font-medium">Total Users</h3>
                        <a href="<?php echo BASE_URL; ?>/user" class="inline-block mt-3 text-primary hover:text-primary-dark text-sm font-medium">
                            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-primary-dark mb-4">
                    <i class="fas fa-bolt mr-2"></i>Quick Actions
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="<?php echo BASE_URL; ?>/satker/create" class="flex items-center p-4 bg-primary-accent bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all">
                        <i class="fas fa-plus-circle text-2xl text-primary mr-3"></i>
                        <span class="font-medium text-primary-dark">Tambah Satker</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/ppbj/create" class="flex items-center p-4 bg-primary-accent bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all">
                        <i class="fas fa-user-plus text-2xl text-primary mr-3"></i>
                        <span class="font-medium text-primary-dark">Tambah PPBJ</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/user/create" class="flex items-center p-4 bg-primary-accent bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all">
                        <i class="fas fa-user-shield text-2xl text-primary mr-3"></i>
                        <span class="font-medium text-primary-dark">Tambah User</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>