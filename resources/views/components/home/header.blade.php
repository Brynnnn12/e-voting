    <!-- Header/Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 text-white shadow-2xl backdrop-blur-sm border-b border-blue-500/20 transition-all duration-300"
        x-data="{ open: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo dengan animasi -->
                <a href="#" class="flex items-center space-x-3 group">
                    <div
                        class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110 group-hover:rotate-12 logo-pulse">
                        <i class="fas fa-vote-yea text-xl"></i>
                    </div>
                    <span
                        class="text-2xl font-bold tracking-wide group-hover:text-blue-200 transition-colors duration-300">
                        SisVo<span class="text-blue-200">Online</span>
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#"
                        class="px-4 py-2 rounded-xl hover:bg-white/10 transition-all duration-300 font-medium hover:scale-105 flex items-center space-x-2 glow-on-hover">
                        <i class="fas fa-home text-sm"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="#kandidat"
                        class="px-4 py-2 rounded-xl hover:bg-white/10 transition-all duration-300 font-medium hover:scale-105 flex items-center space-x-2 glow-on-hover">
                        <i class="fas fa-users text-sm"></i>
                        <span>Kandidat</span>
                    </a>
                    <a href="#tata-cara"
                        class="px-4 py-2 rounded-xl hover:bg-white/10 transition-all duration-300 font-medium hover:scale-105 flex items-center space-x-2 glow-on-hover">
                        <i class="fas fa-list-ol text-sm"></i>
                        <span>Tata Cara</span>
                    </a>
                    <a href="#hasil"
                        class="px-4 py-2 rounded-xl hover:bg-white/10 transition-all duration-300 font-medium hover:scale-105 flex items-center space-x-2 glow-on-hover">
                        <i class="fas fa-chart-bar text-sm"></i>
                        <span>Hasil</span>
                    </a>

                    <!-- Auth Section -->
                    @if (Route::has('login'))
                        @auth
                            <div class="ml-4 flex items-center space-x-3">
                                <div class="h-8 w-px bg-white/20"></div>
                                <a href="{{ url('/dashboard') }}"
                                    class="bg-white/20 backdrop-blur-sm text-white px-6 py-2 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2 glow-on-hover">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        @else
                            <div class="ml-4 flex items-center space-x-3">
                                <div class="h-8 w-px bg-white/20"></div>
                                <a href="{{ route('login') }}"
                                    class="bg-white text-blue-700 px-6 py-2 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl glow-on-hover">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-2 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl glow-on-hover">
                                        Register
                                    </a>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="open = !open"
                        class="p-2 rounded-xl hover:bg-white/10 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/20">
                        <i :class="open ? 'fa-times' : 'fa-bars'" class="fas text-2xl transition-transform duration-300"
                            :style="open && 'transform: rotate(180deg)'"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                class="md:hidden pb-6 border-t border-white/10 mt-4 pt-4">

                <div class="space-y-2">
                    <a href="#"
                        class="flex items-center space-x-3 py-3 px-4 hover:bg-white/10 rounded-xl transition-all duration-300 mobile-menu-item">
                        <i class="fas fa-home w-5"></i>
                        <span class="font-medium">Beranda</span>
                    </a>
                    <a href="#kandidat"
                        class="flex items-center space-x-3 py-3 px-4 hover:bg-white/10 rounded-xl transition-all duration-300 mobile-menu-item">
                        <i class="fas fa-users w-5"></i>
                        <span class="font-medium">Kandidat</span>
                    </a>
                    <a href="#tata-cara"
                        class="flex items-center space-x-3 py-3 px-4 hover:bg-white/10 rounded-xl transition-all duration-300 mobile-menu-item">
                        <i class="fas fa-list-ol w-5"></i>
                        <span class="font-medium">Tata Cara</span>
                    </a>
                    <a href="#hasil"
                        class="flex items-center space-x-3 py-3 px-4 hover:bg-white/10 rounded-xl transition-all duration-300 mobile-menu-item">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span class="font-medium">Hasil</span>
                    </a>

                    @if (Route::has('login'))
                        @auth
                            <div class="pt-4 border-t border-white/10 mt-4">
                                <a href="{{ url('/dashboard') }}"
                                    class="flex items-center space-x-3 py-3 px-4 bg-white/20 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300 glow-on-hover">
                                    <i class="fas fa-tachometer-alt w-5"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        @else
                            <div class="pt-4 border-t border-white/10 mt-4 space-y-3">
                                <a href="{{ route('login') }}"
                                    class="block py-3 px-4 bg-white text-blue-700 rounded-xl font-semibold text-center hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-lg glow-on-hover">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="block py-3 px-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-semibold text-center hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg glow-on-hover">
                                        <i class="fas fa-user-plus mr-2"></i>Register
                                    </a>
                                @endif
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Navbar Enhancement Scripts & Styles -->
        <style>
            /* Body padding for fixed navbar */
            body {
                padding-top: 80px;
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            /* Navigation active state enhancement */
            .nav-link-active {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                transform: scale(1.05);
            }

            /* Mobile menu backdrop */
            .mobile-menu-backdrop {
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(5px);
            }

            /* Glowing effect for buttons */
            .glow-on-hover {
                position: relative;
                overflow: hidden;
            }

            .glow-on-hover::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .glow-on-hover:hover::before {
                left: 100%;
            }

            /* Navbar hide/show animation */
            .navbar-hidden {
                transform: translateY(-100%);
            }

            /* Enhanced mobile menu */
            .mobile-menu-item {
                position: relative;
                overflow: hidden;
            }

            .mobile-menu-item::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                background: linear-gradient(90deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.8));
                transition: width 0.3s ease;
            }

            .mobile-menu-item:hover::after {
                width: 100%;
            }

            /* Logo pulse animation */
            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.3);
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
                }
            }

            .logo-pulse:hover {
                animation: pulse 1.5s infinite;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add active state to current section
                const sections = document.querySelectorAll('section[id]');
                const navLinks = document.querySelectorAll('nav a[href^="#"]');

                function updateActiveNav() {
                    let current = '';
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionHeight = section.clientHeight;
                        if (pageYOffset >= sectionTop - 200) {
                            current = section.getAttribute('id');
                        }
                    });

                    navLinks.forEach(link => {
                        link.classList.remove('nav-link-active');
                        if (link.getAttribute('href') === `#${current}`) {
                            link.classList.add('nav-link-active');
                        }
                    });
                }

                window.addEventListener('scroll', updateActiveNav);

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    const navbar = document.querySelector('nav[x-data]');
                    const mobileButton = document.querySelector('button[\\@click="open = !open"]');

                    if (!navbar.contains(event.target) && !mobileButton.contains(event.target)) {
                        // Use Alpine.js to close menu
                        if (window.Alpine) {
                            const component = Alpine.$data(navbar);
                            if (component && component.open) {
                                component.open = false;
                            }
                        }
                    }
                });

                // Add scroll effect to navbar
                let lastScrollTop = 0;
                const navbar = document.querySelector('nav');

                window.addEventListener('scroll', function() {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    if (scrollTop > lastScrollTop && scrollTop > 100) {
                        // Scrolling down
                        navbar.style.transform = 'translateY(-100%)';
                        navbar.style.transition = 'transform 0.3s ease-in-out';
                    } else {
                        // Scrolling up
                        navbar.style.transform = 'translateY(0)';
                    }

                    // Add backdrop blur when scrolled
                    if (scrollTop > 50) {
                        navbar.classList.add('backdrop-blur-md', 'bg-opacity-95');
                    } else {
                        navbar.classList.remove('backdrop-blur-md', 'bg-opacity-95');
                    }

                    lastScrollTop = scrollTop;
                });
            });
        </script>
    </nav>
