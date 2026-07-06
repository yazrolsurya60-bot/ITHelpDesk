<aside
    class="fixed top-0 left-0 w-64 h-screen bg-white flex flex-col border-r border-slate-200 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300">

    <div class="h-[76px] flex items-center px-8 border-b border-slate-200 shrink-0">
        <div class="flex items-center gap-3">
            <div
                class="w-9 h-9 rounded-xl bg-slate-900 flex items-center justify-center text-emerald-600 shadow-sm border border-slate-200">
                <i class="fas fa-chart-line text-lg"></i>
            </div>
            <span class="font-extrabold text-2xl text-slate-900 tracking-tight">
                IT<span class="text-emerald-600">HelpDesk</span>
            </span>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-8 px-5 sidebar-scroll">
        
        <?php
        $username = $this->session->userdata('username') ?: 'Guest';
        $role = $this->session->userdata('role') ?: 'user';
        $inisial = strtoupper(substr($username, 0, 1));
        $roleLabel = $role == 'admin' ? 'Administrator' : 'User';
        ?>
        <div class="flex items-center gap-4 mb-8 px-2 bg-slate-50 p-4 rounded-2xl border border-slate-200">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-slate-900 font-extrabold text-lg shadow-sm border border-slate-200 shrink-0">
                <?= $inisial ?>
            </div>
            <div class="overflow-hidden">
                <p class="font-bold text-slate-900 text-sm truncate"><?= htmlspecialchars($username) ?></p>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider"><?= $roleLabel ?></p>
            </div>
        </div>

        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4 block px-2">Main Menu</span>

        <ul class="space-y-1.5 mb-6">
            <li>
                <a href="<?= base_url('dashboard') ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-full <?= (uri_string() == 'dashboard' && $this->uri->segment(2) == '') ? 'bg-slate-100 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium' ?> transition-all group">
                    <i class="fas fa-home w-5 text-center <?= (uri_string() == 'dashboard' && $this->uri->segment(2) == '') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' ?> transition-colors text-lg"></i>
                    <span class="text-sm tracking-wide">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 rounded-full text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium transition-all group">
                    <i class="fas fa-user w-5 text-center text-slate-400 group-hover:text-emerald-600 transition-colors text-lg"></i>
                    <span class="text-sm tracking-wide">Profile</span>
                </a>
            </li>
        </ul>
        
        <?php if($role == 'admin'): ?>
        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4 block px-2">Management</span>
        
        <ul class="space-y-1.5">
            <!-- Menu Users -->
            <li>
                <button type="button" class="w-full flex items-center justify-between px-4 py-3 rounded-full <?= (uri_string() == 'dashboard' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit')) ? 'bg-slate-50 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium' ?> transition-all group" onclick="toggleSubmenu('userMenu', 'userArrow')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-users w-5 text-center <?= (uri_string() == 'dashboard' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit')) ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' ?> transition-colors text-lg"></i>
                        <span class="text-sm tracking-wide">Users</span>
                    </div>
                    <i id="userArrow" class="fas fa-chevron-down text-xs transform transition-transform duration-300 <?= (uri_string() == 'dashboard' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit')) ? '-rotate-180' : '' ?>"></i>
                </button>
                
                <ul id="userMenu" class="mt-1 space-y-1 overflow-hidden transition-all duration-300 <?= (uri_string() == 'dashboard' && ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'edit')) ? 'max-h-40' : 'max-h-0' ?>">
                    <li>
                        <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'dashboard' && $this->uri->segment(2) == '') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-list text-xs opacity-70"></i> List User
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('dashboard/add') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'dashboard' && $this->uri->segment(2) == 'add') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-plus text-xs opacity-70"></i> Add User
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menu Mahasiswa -->
            <li>
                <button type="button" class="w-full flex items-center justify-between px-4 py-3 rounded-full <?= (uri_string() == 'mhs' || $this->uri->segment(1) == 'mhs') ? 'bg-slate-50 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium' ?> transition-all group" onclick="toggleSubmenu('mhsMenu', 'mhsArrow')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-graduation-cap w-5 text-center <?= (uri_string() == 'mhs' || $this->uri->segment(1) == 'mhs') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' ?> transition-colors text-lg"></i>
                        <span class="text-sm tracking-wide">Mahasiswa</span>
                    </div>
                    <i id="mhsArrow" class="fas fa-chevron-down text-xs transform transition-transform duration-300 <?= (uri_string() == 'mhs' || $this->uri->segment(1) == 'mhs') ? '-rotate-180' : '' ?>"></i>
                </button>
                
                <ul id="mhsMenu" class="mt-1 space-y-1 overflow-hidden transition-all duration-300 <?= (uri_string() == 'mhs' || $this->uri->segment(1) == 'mhs') ? 'max-h-40' : 'max-h-0' ?>">
                    <li>
                        <a href="<?= base_url('mhs') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'mhs' && $this->uri->segment(2) == '') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-list text-xs opacity-70"></i> List Mahasiswa
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('mhs/print_data') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'mhs/print_data') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-print text-xs opacity-70"></i> Print Laporan
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menu Dosen -->
            <li>
                <button type="button" class="w-full flex items-center justify-between px-4 py-3 rounded-full <?= (uri_string() == 'dosen' || $this->uri->segment(1) == 'dosen') ? 'bg-slate-50 text-slate-900 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium' ?> transition-all group" onclick="toggleSubmenu('dosenMenu', 'dosenArrow')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chalkboard-teacher w-5 text-center <?= (uri_string() == 'dosen' || $this->uri->segment(1) == 'dosen') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' ?> transition-colors text-lg"></i>
                        <span class="text-sm tracking-wide">Dosen</span>
                    </div>
                    <i id="dosenArrow" class="fas fa-chevron-down text-xs transform transition-transform duration-300 <?= (uri_string() == 'dosen' || $this->uri->segment(1) == 'dosen') ? '-rotate-180' : '' ?>"></i>
                </button>
                
                <ul id="dosenMenu" class="mt-1 space-y-1 overflow-hidden transition-all duration-300 <?= (uri_string() == 'dosen' || $this->uri->segment(1) == 'dosen') ? 'max-h-40' : 'max-h-0' ?>">
                    <li>
                        <a href="<?= base_url('dosen') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'dosen' && $this->uri->segment(2) == '') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-list text-xs opacity-70"></i> List Dosen
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('dosen/print_data') ?>" class="flex items-center gap-3 px-4 py-2 pl-12 rounded-full <?= (uri_string() == 'dosen/print_data') ? 'text-slate-900 font-bold bg-slate-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50 font-medium' ?> text-sm transition-all">
                            <i class="fas fa-print text-xs opacity-70"></i> Print Laporan
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php endif; ?>

        <div class="h-px bg-slate-200 my-6 mx-2"></div>

        <ul class="space-y-1.5">
            <li>
                <a href="<?= base_url('auth/logout') ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-full text-slate-500 hover:bg-rose-50 hover:text-rose-600 font-medium transition-all group">
                    <i class="fas fa-sign-out-alt w-5 text-center text-slate-400 group-hover:text-rose-500 transition-colors text-lg"></i>
                    <span class="text-sm tracking-wide">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<main class="flex-1 w-full md:ml-64 p-6 md:p-8 lg:p-10 transition-all duration-300">

<style>
    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .sidebar-scroll:hover::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    function toggleSubmenu(menuId, arrowId) {
        const menu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);
        
        if (menu.classList.contains('max-h-0')) {
            menu.classList.remove('max-h-0');
            menu.classList.add('max-h-40');
            arrow.classList.add('-rotate-180');
        } else {
            menu.classList.add('max-h-0');
            menu.classList.remove('max-h-40');
            arrow.classList.remove('-rotate-180');
        }
    }
</script>