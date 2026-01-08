<!-- Sidebar -->
<aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" id="sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-primary-dark">
        <!-- Logo/Brand -->
        <div class="mb-8 px-4 py-3">
            <h2 class="text-xl font-bold text-white">SATKER-PPBJ</h2>
            <p class="text-xs text-primary-accent mt-1">Management System</p>
        </div>

        <!-- User Info -->
        <div class="mb-6 px-4 py-3 bg-primary rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-primary-accent flex items-center justify-center">
                    <i class="fas fa-user text-primary-dark"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-white"><?php echo Auth::user()->nama; ?></p>
                    <p class="text-xs text-primary-accent capitalize"><?php echo Auth::user()->role; ?></p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <ul class="space-y-2 font-medium">
            <li>
                <a href="<?php echo BASE_URL; ?>/dashboard" class="sidebar-link flex items-center p-3 text-white rounded-lg hover:bg-primary group transition-all <?php echo (isset($title) && $title == 'Dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-home w-5 h-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            
            <?php if(Auth::isAdmin()): ?>
            <li>
                <a href="<?php echo BASE_URL; ?>/satker" class="sidebar-link flex items-center p-3 text-white rounded-lg hover:bg-primary group transition-all <?php echo (isset($title) && strpos($title, 'Satker') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-building w-5 h-5"></i>
                    <span class="ml-3">Data Satker</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo BASE_URL; ?>/ppbj" class="sidebar-link flex items-center p-3 text-white rounded-lg hover:bg-primary group transition-all <?php echo (isset($title) && strpos($title, 'PPBJ') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-users w-5 h-5"></i>
                    <span class="ml-3">Data PPBJ</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo BASE_URL; ?>/user" class="sidebar-link flex items-center p-3 text-white rounded-lg hover:bg-primary group transition-all <?php echo (isset($title) && strpos($title, 'User') !== false) ? 'active' : ''; ?>">
                    <i class="fas fa-user-cog w-5 h-5"></i>
                    <span class="ml-3">Data User</span>
                </a>
            </li>
            <?php endif; ?>
            
            <li class="pt-4 mt-4 border-t border-primary">
                <a href="<?php echo BASE_URL; ?>/auth/logout" class="sidebar-link flex items-center p-3 text-white rounded-lg hover:bg-red-600 group transition-all" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt w-5 h-5"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>