<div class="max-w-6xl mx-auto px-2">

    {{-- ==================== HEADER ==================== --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight mb-1.5">
            Buat Laporan Bencana
        </h1>
        <p class="text-sm text-slate-500">
            Isi data kejadian bencana dengan lengkap dan benar
        </p>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 mb-5 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- ==================== TOKEN ==================== --}}
    @if (session('token'))
    <div class="flex items-start gap-3 bg-blue-50 border border-blue-200 text-blue-800 p-4 mb-5 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
        </svg>
        <div>
            <p class="text-sm font-semibold">Simpan token ini untuk cek status laporan Anda:</p>
            <p class="font-mono text-lg font-bold mt-1 tracking-wider">{{ session('token') }}</p>
        </div>
    </div>
    @endif

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-4 mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM ==================== --}}
    <form action="{{ $actionRoute }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- CARD: DATA KEJADIAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Kejadian</h2>
                            <p class="text-xs text-slate-400">Informasi lokasi dan jenis bencana</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Jenis Bencana --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Jenis Bencana <span class="text-rose-500">*</span>
                            </label>
                            <select name="id_bencana"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                @foreach ($jenisBencana as $jb)
                                <option value="{{ $jb->id }}" @selected(old('id_bencana')==$jb->id)>
                                    {{ $jb->nama_bencana }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Lokasi <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', 'Testing Lokasi') }}"
                                placeholder="Contoh: Jl. Merdeka No. 10, Banjarmasin"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>

                        {{-- Grid 2 kolom: Latitude + Longitude --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Latitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="latitude" value="{{ old('latitude', '-3.3194') }}"
                                    placeholder="-3.3194"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Longitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="longitude" value="{{ old('longitude', '114.5908') }}"
                                    placeholder="114.5908"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-500">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD: DATA KORBAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Korban & Kerugian</h2>
                            <p class="text-xs text-slate-400">Data dampak bencana</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Grid 2 kolom: Meninggal + Luka --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Korban Meninggal
                                </label>
                                <input type="number" name="jumlah_korban_meninggal" value="{{ old('jumlah_korban_meninggal', 0) }}" min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Korban Luka
                                </label>
                                <input type="number" name="jumlah_korban_luka" value="{{ old('jumlah_korban_luka', 0) }}" min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                            </div>
                        </div>

                        {{-- Estimasi Kerugian --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Estimasi Kerugian (Rp)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 text-sm font-semibold pointer-events-none">Rp</span>
                                <input type="number" name="estimasi_kerugian" value="{{ old('estimasi_kerugian') }}" min="0"
                                    placeholder="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Deskripsi <span class="text-slate-400 normal-case tracking-normal font-normal">(opsional)</span>
                            </label>
                            <textarea name="deskripsi" rows="4"
                                placeholder="Jelaskan kronologi atau detail kejadian..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500 leading-relaxed resize-y">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- CARD: DATA PELAPOR (GUEST ONLY) --}}
                @guest
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Pelapor</h2>
                            <p class="text-xs text-slate-400">Identitas pelapor laporan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Nama Pelapor <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="pelapor_nama" value="{{ old('pelapor_nama', 'Warga Testing') }}"
                                placeholder="Nama lengkap"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                No HP Pelapor <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="pelapor_hp" value="{{ old('pelapor_hp', '08123456789') }}"
                                placeholder="08xx-xxxx-xxxx"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>
                    </div>
                </div>
                @endguest

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-6">

                    {{-- CARD: FOTO --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Foto Kejadian</h2>
                                <p class="text-xs text-slate-400">Bukti visual</p>
                            </div>
                        </div>

                        {{-- Preview --}}
                        <div id="preview-container" class="rounded-xl overflow-hidden bg-slate-100 aspect-video mb-4">
                            <div id="preview-empty" class="w-full h-full flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-400">Belum ada foto</p>
                            </div>
                            <img id="preview-image" class="w-full h-full object-cover hidden">
                        </div>

                        <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                            Pilih Foto <span class="text-slate-400 normal-case tracking-normal font-normal">(opsional)</span>
                        </label>
                        <input type="file" name="foto" accept="image/*"
                            onchange="previewImage(event)"
                            class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl bg-slate-50/50 p-1.5 transition">
                        <p class="text-[11px] text-slate-400 mt-2">Format: JPG, PNG. Maks 2MB.</p>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Informasi</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Laporan akan diperiksa oleh petugas/admin sebelum dipublikasikan.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Laporan
                        </button>
                        <a href="{{ url()->previous() }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

{{-- ==================== SCRIPT: PREVIEW FOTO ==================== --}}
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-image');
        const empty = document.getElementById('preview-empty');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                empty.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
            empty.classList.remove('hidden');
        }
    }
</script>