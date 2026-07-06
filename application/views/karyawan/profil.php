<div class="max-w-4xl mx-auto">


    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 px-8 py-10 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-12 -right-12 w-40 h-40 bg-emerald-500 rounded-full opacity-10"></div>
            <div class="absolute top-10 right-20 w-16 h-16 bg-emerald-400 rounded-full opacity-20"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <?php 
                    $foto = $user->foto;
                    $initial = strtoupper(substr($user->nama_lengkap, 0, 1));
                ?>
                <div class="relative">
                    <?php if(!empty($foto) && file_exists('./uploads/profil/' . $foto)): ?>
                        <img src="<?php echo base_url('uploads/profil/' . $foto); ?>" alt="Profile" class="w-32 h-32 rounded-full object-cover border-4 border-slate-800 shadow-xl">
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-5xl font-bold border-4 border-slate-800 shadow-xl">
                            <?php echo $initial; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="text-center md:text-left text-white">
                    <h2 class="text-3xl font-bold mb-2"><?php echo $user->nama_lengkap; ?></h2>
                    <div class="inline-flex items-center px-3 py-1 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 rounded-full text-sm font-medium">
                        <i class="fas fa-id-badge mr-2"></i> Karyawan
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-3">Edit Profil</h3>
            
            <?php echo form_open_multipart('karyawan/update_profil', ['class' => 'space-y-6']); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?php echo $user->nama_lengkap; ?>" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition text-slate-700">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                        <input type="text" name="username" value="<?php echo $user->username; ?>" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition text-slate-700">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition text-slate-700">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ubah Foto Profil <span class="text-xs text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 transition-all cursor-pointer">
                    </div>
                </div>
                
                <div class="pt-6 mt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-emerald-200 transition-all transform hover:-translate-y-0.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
