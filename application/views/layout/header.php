<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard App - Sistem Informasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                            base: '#f8fafc',    /* Slate 50 */
                            navy: '#0f172a',    /* Slate 900 */
                            navyDark: '#020617', /* Slate 950 */
                            emerald: '#0D9488', /* Teal 600 */
                            emeraldLight: '#14b8a6', /* Teal 500 */
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Styling Scrollbar agar rapi */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #D97706; /* Hover menggunakan warna Gold */
        }
    </style>
</head>

<body
    class="bg-brand-base font-sans text-slate-800 antialiased selection:bg-emerald-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    <nav
        class="fixed top-0 left-0 md:left-64 right-0 h-[76px] bg-white/80 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 z-40 transition-all duration-300">

        <div class="flex items-center gap-4">
            <h1 class="text-xl md:text-2xl font-bold text-slate-900 tracking-tight">Portal Admin</h1>
        </div>

        <div class="hidden sm:flex items-center gap-5">
            <div
                class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 relative cursor-pointer hover:bg-slate-100 hover:text-emerald-600 transition-colors border border-slate-200 shadow-sm">
                <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
            </div>
            <div
                class="flex items-center gap-3 bg-white border border-slate-200 py-1.5 px-3 rounded-full shadow-sm cursor-pointer hover:shadow-md hover:border-slate-300 transition-all">
                <div
                    class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-xs">
                    U
                </div>
                <span class="text-sm font-semibold text-slate-900">Administrator</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 w-full pt-[76px]">