<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT HelpDesk - <?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in-up': 'fadeInUp 0.5s ease-out forwards',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen flex bg-slate-50 relative overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-slate-900 text-white flex flex-col fixed inset-y-0 left-0 z-50 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out">
            <div class="p-6 text-xl font-bold border-b border-slate-800 flex items-center justify-between">
                <div class="leading-tight">
                    <span class="block text-white">IT<span class="text-emerald-400">SmartDesk</span></span>
                </div>
                <button class="md:hidden text-slate-400 hover:text-white" onclick="toggleSidebar()">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <?php
            $current = $this->uri->segment(2);
            $is_dashboard = ($current == '' || $current == 'index') ? true : false;
            $is_chatbot = ($current == 'chatbot') ? true : false;
            $is_profil = ($current == 'profil') ? true : false;

            $active = "bg-emerald-600/10 text-emerald-400 font-bold border-r-4 border-emerald-500 rounded-l-xl";
            $inactive = "text-slate-400 hover:bg-slate-800 hover:text-white border-r-4 border-transparent rounded-l-xl font-medium";
            ?>

            <nav class="flex-1 py-6 pl-4 space-y-1.5 overflow-y-auto">
                <a href="<?php echo base_url('karyawan'); ?>"
                    class="flex items-center px-4 py-3 transition-all text-sm <?php echo $is_dashboard ? $active : $inactive; ?>">
                    <i
                        class="fas fa-chart-line w-7 <?php echo $is_dashboard ? 'text-emerald-400' : 'opacity-60'; ?>"></i>
                    Dashboard
                </a>
                <a href="<?php echo base_url('karyawan/chatbot'); ?>"
                    class="flex items-center px-4 py-3 transition-all text-sm <?php echo $is_chatbot ? $active : $inactive; ?>">
                    <i class="fas fa-robot w-7 <?php echo $is_chatbot ? 'text-emerald-400' : 'opacity-60'; ?>"></i> AI
                    Assistant
                </a>
                <a href="<?php echo base_url('karyawan/profil'); ?>"
                    class="flex items-center px-4 py-3 transition-all text-sm <?php echo $is_profil ? $active : $inactive; ?>">
                    <i class="fas fa-user w-7 <?php echo $is_profil ? 'text-emerald-400' : 'opacity-60'; ?>"></i> Profil
                    Saya
                </a>
            </nav>

            <!-- User Profile Widget (Sidebar Bottom) -->
            <div class="p-4 border-t border-slate-800 bg-slate-900">
                <?php
                $user_id = $this->session->userdata('user_id');
                $user_data = $this->db->get_where('users', ['id_user' => $user_id])->row();
                $name = $user_data->nama_lengkap;
                $foto = $user_data->foto;
                $initial = strtoupper(substr($name, 0, 1));
                ?>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <?php if (!empty($foto) && file_exists('./uploads/profil/' . $foto)): ?>
                            <img src="<?php echo base_url('uploads/profil/' . $foto); ?>" alt="Profile"
                                class="w-10 h-10 rounded-full object-cover border border-slate-700 flex-shrink-0">
                        <?php else: ?>
                            <div
                                class="w-10 h-10 rounded-full bg-slate-800 text-emerald-400 font-bold flex items-center justify-center border border-slate-700 text-sm flex-shrink-0">
                                <?php echo $initial; ?>
                            </div>
                        <?php endif; ?>

                        <div class="truncate">
                            <p class="text-sm font-bold text-white truncate"><?php echo $name; ?></p>
                            <p class="text-xs text-emerald-400 font-medium">Karyawan</p>
                        </div>
                    </div>

                    <a href="<?php echo base_url('auth/logout'); ?>"
                        class="text-slate-400 hover:text-white transition p-2" title="Logout">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden w-full md:w-auto">
            <!-- Mobile Header with Hamburger -->
            <div class="md:hidden bg-white border-b border-slate-200 p-4 flex items-center justify-between shadow-sm flex-shrink-0 z-30">
                <div class="font-bold text-lg text-slate-800">
                    IT<span class="text-emerald-600">SmartDesk</span>
                </div>
                <button onclick="toggleSidebar()" class="text-slate-500 hover:text-emerald-600 focus:outline-none p-2 rounded-lg bg-slate-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Dashboard Content Scrollable -->
            <main class="flex-1 p-4 md:p-6 overflow-y-auto w-full">
                <script>
                    function toggleSidebar() {
                        const sidebar = document.getElementById('sidebar');
                        const overlay = document.getElementById('sidebarOverlay');
                        
                        if (window.innerWidth < 768) {
                            if (sidebar.classList.contains('-translate-x-full')) {
                                sidebar.classList.remove('-translate-x-full');
                                overlay.classList.remove('hidden');
                            } else {
                                sidebar.classList.add('-translate-x-full');
                                overlay.classList.add('hidden');
                            }
                        } else {
                            sidebar.classList.toggle('md:-ml-64');
                        }
                    }
                </script>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-slate-800"><?php echo $title; ?></h2>
                </div>