            </main>
        </div>
    </div>
    <!-- Global Toast Notifications -->
    <?php if($this->session->flashdata('success')): ?>
    <div id="global-toast" class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 bg-white rounded-xl shadow-2xl border-l-4 border-emerald-500 z-50 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-emerald-500 bg-emerald-100 rounded-full">
            <i class="fas fa-check"></i>
        </div>
        <div class="ml-4 text-sm font-bold text-slate-700">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg p-1.5 hover:bg-slate-100 inline-flex h-8 w-8 transition outline-none" onclick="closeGlobalToast()" aria-label="Close">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    <script>
        function closeGlobalToast() {
            var toast = document.getElementById('global-toast');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(function() { toast.remove(); }, 500);
            }
        }
        setTimeout(closeGlobalToast, 4000);
    </script>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
    <div id="global-toast-error" class="fixed bottom-6 right-6 flex items-center w-full max-w-sm p-4 bg-white rounded-xl shadow-2xl border-l-4 border-rose-500 z-50 transform transition-all duration-500 translate-y-0 opacity-100" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-rose-500 bg-rose-100 rounded-full">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="ml-4 text-sm font-bold text-slate-700">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg p-1.5 hover:bg-slate-100 inline-flex h-8 w-8 transition outline-none" onclick="closeGlobalToastError()" aria-label="Close">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    <script>
        function closeGlobalToastError() {
            var toast = document.getElementById('global-toast-error');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(function() { toast.remove(); }, 500);
            }
        }
        setTimeout(closeGlobalToastError, 5000);
    </script>
    <?php endif; ?>
</body>
</html>
