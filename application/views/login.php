<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System - IT HelpDesk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
                            base: '#F8FAFC',    /* 60% White/Base */
                            navy: '#0F172A',    /* 30% Primary Navy */
                            navyDark: '#020617',
                            emerald: '#0D9488', /* 10% Accent Teal */
                            emeraldLight: '#14B8A6',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'fade-in': 'fadeIn 0.8s ease-out forwards',
                        'slide-in-right': 'slideInRight 0.6s ease-out forwards',
                        'slide-in-left': 'slideInLeft 0.6s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(-30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Toggle Switch Styles */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #10B981;
        }

        .toggle-checkbox:checked+.toggle-label {
            background-color: #10B981;
        }

        .toggle-checkbox:checked+.toggle-label:after {
            transform: translateX(100%);
            border-color: white;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col md:flex-row antialiased font-sans bg-white overflow-x-hidden">

    <!-- Left Panel (Image + Overlay) -->
    <div class="w-full md:w-1/2 relative flex flex-col p-8 md:p-16 lg:p-20 justify-between min-h-[40vh] md:min-h-screen overflow-hidden animate-fade-in">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1000&auto=format&fit=crop"
             alt="Background IT Helpdesk" class="absolute inset-0 object-cover w-full h-full opacity-90 transition-transform duration-700 hover:scale-105">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/90 to-brand-navy/60"></div>
        
        <!-- Logo -->
        <div class="flex items-center gap-3 z-10 animate-fade-in-up">
            <span class="font-extrabold text-2xl text-white tracking-tight">IT<span class="text-brand-emeraldLight">SmartDesk</span></span>
        </div>

        <!-- Typography / Copywriting -->
        <div class="mt-16 md:mt-auto z-10 animate-slide-in-right" style="animation-delay: 0.2s; opacity: 0;">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4 leading-tight tracking-tight">
                Pusat Layanan Bantuan<br>
                <span class="text-brand-emeraldLight">Terpadu.</span>
            </h1>
            <p class="text-brand-base text-sm md:text-base lg:text-lg max-w-md leading-relaxed opacity-90">
                Layanan helpdesk untuk menunjang kelancaran operasional IT Anda.
            </p>
        </div>
    </div>

    <!-- Right Panel (Form) -->
    <div class="w-full md:w-1/2 bg-white flex flex-col justify-center p-8 md:p-16 lg:p-24 relative animate-slide-in-left">
        <div class="w-full max-w-md mx-auto">
            
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Selamat Datang!</h2>
                <p class="text-slate-500 text-sm">Silakan masukkan detail akun Anda untuk melanjutkan.</p>
            </div>

            <?php echo form_open('auth/login_action'); ?>
                <div class="space-y-5">
                    <!-- Username Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" name="username" class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-emerald/40 focus:border-brand-emerald transition-all bg-white hover:bg-slate-50" placeholder="Masukkan username Anda" required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2 ml-1">Password</label>
                        <div class="relative flex items-center">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" name="password" id="passwordInput" class="w-full pl-11 pr-12 py-3.5 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-emerald/40 focus:border-brand-emerald transition-all bg-white hover:bg-slate-50" placeholder="Masukkan kata sandi" required>
                            
                            <div id="togglePassword" class="absolute right-4 text-slate-400 cursor-pointer hover:text-brand-emerald transition-colors">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-brand-emerald hover:bg-emerald-600 text-white font-bold py-3.5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-brand-emerald/30 transform hover:-translate-y-1 hover:shadow-brand-emerald/50 hover:scale-[1.02] active:scale-95">
                            Masuk ke Dashboard 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>

            <!-- Back to Home Link -->
            <div class="text-center mt-10">
                <a href="<?= base_url() ?>" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-brand-emerald transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
            
            <p class="text-center text-sm text-slate-500 mt-6">
                Belum punya akun? 
                <a href="<?= base_url('auth/register') ?>" class="text-brand-navy font-bold hover:text-brand-emerald transition-colors ml-1">Daftar sekarang</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        });
    </script>
</body>

</html>