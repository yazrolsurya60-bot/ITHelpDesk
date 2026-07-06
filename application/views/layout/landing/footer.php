</main>

<footer class="bg-brand-navy text-gray-300 mt-16 pt-12 pb-8 border-t-4 border-brand-emerald">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Branding -->
            <div>
                <h5 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-headset text-brand-emerald mr-2"></i> IT HelpDesk
                </h5>
                <p class="text-sm leading-relaxed max-w-xs text-slate-400">
                    Pusat Layanan Bantuan IT yang cepat, terpadu, dan termonitor untuk kelancaran operasional Anda.
                </p>
            </div>

            <!-- Navigasi -->
            <div>
                <h5 class="text-lg font-semibold text-brand-emerald mb-4">Menu Tautan</h5>
                <ul class="space-y-2">
                    <li>
                        <a href="<?= base_url('landing/home') ?>"
                            class="text-sm hover:text-white transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs text-brand-emerald mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('landing/profil') ?>"
                            class="text-sm hover:text-white transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs text-brand-emerald mr-2"></i> Profil
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('landing/hubungi') ?>"
                            class="text-sm hover:text-white transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-chevron-right text-xs text-brand-emerald mr-2"></i> Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h5 class="text-lg font-semibold text-brand-emerald mb-4">Informasi Kontak</h5>
                <ul class="space-y-3">
                    <li class="flex items-start text-sm">
                        <i class="fas fa-map-marker-alt mt-1 text-brand-emerald mr-3"></i>
                        <span>Ruang Server & IT, Lantai 1 Gedung Utama</span>
                    </li>
                    <li class="flex items-center text-sm">
                        <i class="fas fa-envelope text-brand-emerald mr-3"></i>
                        <span>support@ithelpdesk.com</span>
                    </li>
                    <li class="flex items-center text-sm">
                        <i class="fas fa-phone text-brand-emerald mr-3"></i>
                        <span>+62 812 3456 7890</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-8 mt-8 text-center text-sm text-gray-500">
            <p>&copy; <?= date('Y') ?> IT HelpDesk System. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- AOS Animation Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
    });
</script>

</body>

</html>