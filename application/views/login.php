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

<body class="bg-brand-base min-h-screen flex items-center justify-center p-4 md:p-6 lg:p-8 antialiased">

    <div
        class="bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row w-full max-w-[1100px] overflow-hidden min-h-[600px]">

        <div class="hidden md:block md:w-1/2 relative bg-brand-navy">
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1000&auto=format&fit=crop"
                alt="Background IT Helpdesk" class="object-cover w-full h-full opacity-90">
            <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/90 to-brand-navy/20"></div>

            <div class="absolute inset-0 flex flex-col justify-center px-12 pointer-events-none">
                <h2 class="text-3xl font-bold text-white mb-4 leading-tight">Pusat Layanan Bantuan<br>dan Pengaduan
                    Terpadu.
                </h2>
                <p class="text-brand-emeraldLight text-sm font-medium">Layanan helpdesk untuk menunjang kelancaran
                    operasional.</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center relative">

            <div class="flex items-center gap-3 mb-10">
                <span class="font-extrabold text-2xl text-brand-navy tracking-tight">
                    IT<span class="text-brand-emerald">SmartDesk</span>
                </span>
            </div>

            <a href="<?= base_url() ?>"
                class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-brand-emerald transition-colors mb-6 w-fit">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <h2 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Nice to see you again</h2>

            <?php echo form_open('auth/login_action'); ?>
            <div class="space-y-5">

                <div>
                    <label
                        class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 ml-1">Username</label>
                    <input type="text" name="username"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-brand-emerald/40 focus:border-brand-emerald transition-all"
                        placeholder="Enter your username" required>
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 ml-1">Password</label>
                    <div class="relative flex items-center">
                        <input type="password" name="password" id="passwordInput"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-brand-emerald/40 focus:border-brand-emerald transition-all"
                            placeholder="Enter password" required>
                        <div id="togglePassword"
                            class="absolute right-4 text-gray-400 cursor-pointer hover:text-brand-emerald transition-colors">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>



                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-brand-emerald hover:bg-emerald-600 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-brand-emerald/30 transform hover:-translate-y-0.5">
                        Login
                    </button>
                </div>

            </div>
            <?php echo form_close(); ?>


            <p class="text-center text-sm text-gray-500 mt-8">
                Don't have an account?
                <a href="<?= base_url('auth/register') ?>"
                    class="text-brand-navy font-bold hover:text-brand-emerald transition-colors ml-1">Sign up
                    now</a>
            </p>

            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between opacity-60">
                <div class="flex items-center gap-1.5">
                    <span class="text-xs font-bold text-brand-navy">ITSmartDesk</span>
                </div>
                <span class="text-xs font-medium text-gray-500">© IT HelpDesk <?= date('Y'); ?></span>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change to eye-slash icon
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                passwordInput.type = 'password';
                // Change back to normal eye icon
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
            }
        });
    </script>
</body>

</html>