<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT HelpDesk - <?= $title ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            base: '#f8fafc',
                            navy: '#0f172a',
                            navyDark: '#020617',
                            emerald: '#0D9488',
                            emeraldLight: '#14b8a6',
                        }
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            /* Hide scrollbar for Chrome, Safari and Opera */
            body::-webkit-scrollbar {
                display: none;
            }
            body {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
                @apply bg-brand-base font-sans text-brand-navy antialiased min-h-screen flex flex-col;
            }
            .content-section {
                @apply py-16 md:py-24;
            }
            .page-title {
                @apply text-4xl md:text-5xl font-bold mb-6 text-brand-navy tracking-tight;
            }
        }
    </style>
</head>

<body class="">

    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?= base_url('landing') ?>" class="text-2xl font-extrabold tracking-tight flex items-center text-white" id="navLogoText">
                        IT<span class="text-brand-emerald">SmartDesk</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex md:items-center md:space-x-2" id="navLinks">
                    <?php 
                        $link_normal = 'text-slate-300 hover:text-white hover:bg-white/10';
                        $link_active = 'bg-brand-emerald/20 text-brand-emeraldLight font-bold';
                    ?>
                    <a href="<?= base_url('landing/home') ?>"
                        class="px-4 py-2 rounded-full text-sm transition-colors duration-200 nav-item <?= ($active == 'home') ? $link_active : $link_normal ?>">
                        Home
                    </a>
                    <a href="<?= base_url('landing/profil') ?>"
                        class="px-4 py-2 rounded-full text-sm transition-colors duration-200 nav-item <?= ($active == 'profil') ? $link_active : $link_normal ?>">
                        Profil
                    </a>
                    <a href="<?= base_url('landing/hubungi') ?>"
                        class="px-4 py-2 rounded-full text-sm transition-colors duration-200 nav-item <?= ($active == 'hubungi') ? $link_active : $link_normal ?>">
                        Hubungi Kami
                    </a>
                    <a href="<?= base_url('landing/login') ?>"
                        class="ml-4 inline-flex items-center justify-center px-6 py-2.5 border rounded-full text-sm font-bold transition-all duration-300 border-white/20 text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm" id="navLoginBtn">
                        Login System
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-brand-primary hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-primary"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="w-full flex-grow">

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.remove('bg-transparent', 'py-4');
                nav.classList.add('bg-brand-navy/95', 'backdrop-blur-md', 'shadow-lg');
            } else {
                nav.classList.add('bg-transparent', 'py-4');
                nav.classList.remove('bg-brand-navy/95', 'backdrop-blur-md', 'shadow-lg');
            }
        });
    </script>