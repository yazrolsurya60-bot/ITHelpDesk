<!-- Hero Section: Full Bleed Window Size -->
<div class="relative w-full min-h-screen flex items-center overflow-hidden mb-20">
    <!-- Real Image Background -->
    <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1200&q=80" alt="Server Room"
        class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-brand-navy/80 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-brand-navy via-brand-navy/80 to-transparent"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 text-center flex flex-col items-center" data-aos="zoom-out">
        <h1
            class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight mb-8 leading-[1.1] max-w-4xl mx-auto">
            Kelola Kendala IT Anda<br>dengan <span class="text-brand-emeraldLight">Lebih Cerdas</span>.
        </h1>
        <p class="text-lg md:text-xl text-slate-200 mb-12 max-w-2xl font-medium mx-auto" data-aos="fade-up" data-aos-delay="200">
            Sistem layanan bantuan terpadu untuk melaporkan masalah jaringan, kerusakan hardware, hingga kebutuhan
            instalasi software dalam satu tempat.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
            <!-- Emerald CTA -->
            <a href="<?= base_url('landing/login') ?>"
                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-brand-emerald text-white text-base font-bold rounded-full hover:bg-emerald-500 transition-colors duration-200 shadow-lg shadow-brand-emerald/30">
                Mulai Gunakan Sistem
            </a>
            <!-- Ghost Outline Button -->
            <a href="#fitur"
                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-white text-base font-semibold rounded-full hover:bg-white/20 transition-colors duration-200">
                Pelajari Fitur
            </a>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
    <div class="text-center mb-16 md:mb-24" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-bold text-brand-navy tracking-tight mb-4">Bagaimana IT HelpDesk Bekerja?
        </h2>
        <p class="text-lg text-slate-500 max-w-2xl mx-auto">Tiga langkah sederhana untuk menyelesaikan masalah IT Anda
            dengan cepat dan terukur.</p>
    </div>

    <!-- Step 1: Right Image, Left Text -->
    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-20 md:mb-32">
        <div class="w-full lg:w-1/2 order-2 lg:order-1" data-aos="fade-right">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-brand-emerald/10 text-brand-emerald font-bold text-xl mb-6">
                1</div>
            <h3 class="text-3xl md:text-4xl font-bold text-brand-navy tracking-tight mb-6">Laporkan Kendala Anda</h3>
            <p class="text-lg text-slate-600 leading-relaxed mb-6">
                Tidak perlu menunggu lama. Cukup login ke dalam sistem, pilih kategori masalah (Hardware, Software, atau
                Jaringan), dan deskripsikan kendala Anda. Anda juga bisa melampirkan foto agar Teknisi kami lebih mudah
                memahaminya.
            </p>
            <ul class="space-y-3 text-slate-600 font-medium">
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Pemilihan
                    Kategori Cerdas</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Dukungan
                    Lampiran Foto</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Terintegrasi
                    dengan Data Aset</li>
            </ul>
        </div>
        <div class="w-full lg:w-1/2 order-1 lg:order-2" data-aos="fade-left">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?w=800&q=80"
                    alt="Melaporkan Kendala"
                    class="w-full h-auto object-cover aspect-[4/3] transform hover:scale-105 transition-transform duration-700">
            </div>
        </div>
    </div>

    <!-- Step 2: Left Image, Right Text -->
    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-20 md:mb-32">
        <div class="w-full lg:w-1/2" data-aos="fade-right">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                <img src="<?= base_url('uploads/it_support.png') ?>"
                    alt="Penanganan oleh IT"
                    class="w-full h-auto object-cover aspect-[4/3] transform hover:scale-105 transition-transform duration-700">
            </div>
        </div>
        <div class="w-full lg:w-1/2" data-aos="fade-left">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-brand-emerald/10 text-brand-emerald font-bold text-xl mb-6">
                2</div>
            <h3 class="text-3xl md:text-4xl font-bold text-brand-navy tracking-tight mb-6">Distribusi dan Penanganan
            </h3>
            <p class="text-lg text-slate-600 leading-relaxed mb-6">
                Laporan Anda akan otomatis diteruskan kepada Staf IT yang sedang tersedia. Mereka akan segera menuju
                lokasi Anda atau memberikan solusi secara remote sesuai dengan tingkat keparahan masalah.
            </p>
            <ul class="space-y-3 text-slate-600 font-medium">
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Notifikasi
                    Real-time</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Penugasan
                    Teknisi Otomatis</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Pembaruan
                    Status Proaktif</li>
            </ul>
        </div>
    </div>

    <!-- Step 3: Right Image, Left Text -->
    <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
        <div class="w-full lg:w-1/2 order-2 lg:order-1" data-aos="fade-right">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-brand-emerald/10 text-brand-emerald font-bold text-xl mb-6">
                3</div>
            <h3 class="text-3xl md:text-4xl font-bold text-brand-navy tracking-tight mb-6">Selesai & Terdokumentasi</h3>
            <p class="text-lg text-slate-600 leading-relaxed mb-6">
                Setelah kendala berhasil diperbaiki, tiket akan ditutup dan dicatat ke dalam riwayat (Log). Manajemen
                dapat melihat laporan bulanan untuk mengevaluasi aset apa saja yang sering rusak dan mengukur kinerja
                Tim IT.
            </p>
            <ul class="space-y-3 text-slate-600 font-medium">
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Rekam Jejak
                    Solusi (Knowledge Base)</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Evaluasi
                    Kinerja Otomatis</li>
                <li class="flex items-center"><i class="fas fa-check-circle text-brand-emerald mr-3"></i> Laporan
                    Analitik Profesional</li>
            </ul>
        </div>
        <div class="w-full lg:w-1/2 order-1 lg:order-2" data-aos="fade-left">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                <img src="<?= base_url('uploads/analytics_dashboard.png') ?>"
                    alt="Laporan dan Analisis"
                    class="w-full h-auto object-cover aspect-[4/3] transform hover:scale-105 transition-transform duration-700">
            </div>
        </div>
    </div>
</div>

<!-- Features Section with Background Image -->
<div id="fitur" class="relative max-w-7xl mx-auto mb-20 rounded-[32px] overflow-hidden">
    <!-- Background Image -->
    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?w=1200&q=80" alt="IT Office"
        class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-brand-navy/95"></div>

    <div class="relative z-10 px-6 py-20 md:py-24 lg:px-16">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4">Fitur Unggulan Kami</h2>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">Dirancang khusus untuk mempermudah alur kerja antara
                Karyawan pelapor dan Staf IT teknisi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
            <!-- Feature 1 -->
            <div class="flex flex-col items-start text-left" data-aos="fade-up" data-aos-delay="100">
                <div
                    class="w-14 h-14 bg-brand-emerald/20 rounded-2xl flex items-center justify-center mb-6 border border-brand-emerald/30">
                    <i class="fas fa-paper-plane text-brand-emeraldLight text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Pelaporan Cepat & Tepat</h3>
                <p class="text-slate-300 leading-relaxed text-lg">
                    Karyawan dapat melaporkan kendala IT hanya dengan beberapa klik. Pilih kategori masalah, tentukan
                    ruangan, dan unggah foto kerusakan. Sistem otomatis meneruskan laporan ke Staf IT yang ahli di
                    bidangnya.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="flex flex-col items-start text-left" data-aos="fade-up" data-aos-delay="200">
                <div
                    class="w-14 h-14 bg-brand-emerald/20 rounded-2xl flex items-center justify-center mb-6 border border-brand-emerald/30">
                    <i class="fas fa-sitemap text-brand-emeraldLight text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Distribusi Tugas Pintar</h3>
                <p class="text-slate-300 leading-relaxed text-lg">
                    Sistem menggunakan algoritma "Least Loaded" untuk mendistribusikan tiket pelaporan secara adil. Staf
                    IT dengan beban kerja paling sedikit akan diprioritaskan, sehingga tidak ada penumpukan tugas.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Toolkit Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
    <div
        class="bg-slate-50 rounded-[32px] p-8 md:p-16 flex flex-col lg:flex-row items-center gap-16 border border-slate-100">
        <!-- Left: Text & Features Checklist -->
        <div class="w-full lg:w-1/2" data-aos="fade-right">
            <h2 class="text-4xl md:text-5xl font-bold text-brand-navy tracking-tight mb-8">
                Alat Lengkap untuk <span class="text-brand-emerald">Manajemen Aset</span> & Evaluasi.
            </h2>
            <p class="text-lg text-slate-600 mb-10">
                Lebih dari sekadar sistem *ticketing*. Pantau inventaris perangkat fisik Anda, catat pekerjaan staf
                (work logs), dan cetak laporan bulanan untuk atasan.
            </p>

            <div class="space-y-6">
                <!-- Active Feature Item -->
                <div class="flex items-center gap-4 bg-white p-4 rounded-[16px] border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-full bg-brand-navy flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-desktop text-white"></i>
                    </div>
                    <span class="text-xl font-semibold text-brand-navy">Pelacakan Aset Terintegrasi</span>
                </div>
                <!-- Inactive Feature Item -->
                <div class="flex items-center gap-4 px-4">
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-clipboard-list text-slate-500"></i>
                    </div>
                    <span class="text-xl font-medium text-slate-500">Catatan Pekerjaan (Work Logs)</span>
                </div>
                <!-- Inactive Feature Item -->
                <div class="flex items-center gap-4 px-4">
                    <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-chart-line text-slate-500"></i>
                    </div>
                    <span class="text-xl font-medium text-slate-500">Laporan & Analitik Bulanan</span>
                </div>
            </div>
        </div>

        <!-- Right: Decorative Elements -->
        <div class="w-full lg:w-1/2" data-aos="fade-left">
            <!-- Emulating the overlapping style from the design system -->
            <div
                class="relative bg-slate-200 rounded-[24px] aspect-[4/3] w-full overflow-hidden flex items-center justify-center border border-slate-200 shadow-inner">
                <div class="absolute inset-0 bg-brand-navy/5"></div>

                <!-- Floating Dashboard Mockup -->
                <div
                    class="absolute -right-8 -bottom-8 w-[110%] h-[110%] bg-white rounded-tl-[32px] border-t-8 border-l-8 border-slate-100 p-8 shadow-xl">
                    <div class="w-1/3 h-4 bg-slate-200 rounded-full mb-8"></div>
                    <div class="w-full h-32 bg-slate-50 rounded-xl mb-6 border border-slate-100"></div>
                    <div class="flex gap-4">
                        <div class="w-1/2 h-24 bg-brand-emerald/10 rounded-xl border border-brand-emerald/20"></div>
                        <div class="w-1/2 h-24 bg-brand-emeraldLight/10 rounded-xl border border-brand-emeraldLight/20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>