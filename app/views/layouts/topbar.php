<!-- Top Bar -->
<div class="bg-white shadow-sm border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button id="toggleSidebar" class="sm:hidden mr-4 text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
            </div>
            
            <!-- Right Section: Date and Profile -->
            <div class="flex items-center gap-4">
                <!-- Date Display -->
                <div class="hidden md:flex items-center text-sm text-gray-600">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <?php echo date('d F Y'); ?>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-9 h-9 rounded-full bg-primary-accent flex items-center justify-center">
                            <i class="fas fa-user text-primary-dark"></i>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-gray-900"><?php echo Auth::user()->nama; ?></p>
                            <p class="text-xs text-gray-500 capitalize"><?php echo Auth::user()->role; ?></p>
                        </div>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50"
                         style="display: none;">
                        
                        <!-- User Info Section -->
                        <div class="px-4 py-3 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-primary-accent flex items-center justify-center">
                                    <i class="fas fa-user text-xl text-primary-dark"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate"><?php echo Auth::user()->nama; ?></p>
                                    <p class="text-xs text-gray-500"><?php echo Auth::user()->email ?? Auth::user()->username; ?></p>
                                    <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-primary-accent text-primary-dark capitalize">
                                        <?php echo Auth::user()->role; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a href="<?php echo BASE_URL; ?>/profile" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-accent hover:bg-opacity-20 transition-colors">
                                <i class="fas fa-user-circle w-5 text-primary"></i>
                                <span>Profil Saya</span>
                            </a>
                        </div>

                        <!-- Logout Section -->
                        <div class="border-t border-gray-200 py-2">
                            <a href="<?php echo BASE_URL; ?>/auth/logout" 
                               onclick="return confirm('Apakah Anda yakin ingin logout?')"
                               class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>