<div class="bg-[#F0F4FB] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

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
                                <input type="text" name="lokasi" id="input-lokasi"
                                    value="{{ old('lokasi') }}"
                                    placeholder="Akan terisi otomatis setelah klik peta / GPS. Atau isi manual."
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                                <p class="text-[11px] text-slate-400 mt-1.5">Klik peta atau "Gunakan Lokasi Saya" untuk isi otomatis.</p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: PETA INTERAKTIF --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Titik Lokasi di Peta</h2>
                                <p class="text-xs text-slate-400">Klik peta untuk menentukan koordinat & alamat</p>
                            </div>
                        </div>

                        {{-- Petunjuk --}}
                        <div class="flex items-start gap-2 bg-blue-50 border border-blue-200 text-blue-700 p-3 mb-4 rounded-xl text-xs">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><strong>Klik pada peta</strong> untuk menandai lokasi, atau klik <strong>"Gunakan Lokasi Saya"</strong>. Kolom <strong>Lokasi, Latitude, dan Longitude</strong> akan terisi otomatis. Marker bisa di-<strong>drag</strong>.</span>
                        </div>

                        {{-- Pesan GPS status --}}
                        <div id="gps-status" class="hidden mb-4"></div>

                        {{-- Wrapper peta + tombol --}}
                        <div class="relative rounded-xl overflow-hidden border border-slate-200" style="position: relative; z-index: 1; isolation: isolate;">
                            <div id="peta-laporan" style="height: 320px; z-index: 0;"></div>

                            <button type="button"
                                id="btn-lokasi-saya"
                                onclick="gunakanLokasiSaya()"
                                class="absolute top-3 right-3 inline-flex items-center gap-2 bg-white hover:bg-blue-50 text-slate-800 border border-slate-300 hover:border-blue-400 px-3.5 py-2 rounded-lg text-xs font-bold shadow-md transition-all duration-200 hover:-translate-y-0.5"
                                style="z-index: 400;">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Gunakan Lokasi Saya
                            </button>
                        </div>

                        {{-- Field lat/long --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Latitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="latitude" id="input-latitude" value="{{ old('latitude', '-3.3194') }}"
                                    placeholder="-3.3194"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Longitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="longitude" id="input-longitude" value="{{ old('longitude', '114.5908') }}"
                                    placeholder="114.5908"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-500">
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

                        {{-- CARD: INFO — HANYA UNTUK GUEST --}}
                        @guest
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
                        @endguest

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
</div>

{{-- ==================== LEAFLET CSS & JS ==================== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

{{-- ==================== SCRIPT: PETA + GPS + REVERSE GEOCODE + HIGHLIGHT KALSEL ==================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapEl = document.getElementById('peta-laporan');
        if (!mapEl) return;

        const inputLat = document.getElementById('input-latitude');
        const inputLng = document.getElementById('input-longitude');
        const inputLokasi = document.getElementById('input-lokasi');

        let initialLat = parseFloat(inputLat.value) || -3.3194;
        let initialLng = parseFloat(inputLng.value) || 114.5908;

        const map = L.map('peta-laporan').setView([initialLat, initialLng], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // ============ HIGHLIGHT KALSEL ============
        fetch('{{ asset("geojson/indonesia-province-simple.json") }}')
            .then(res => res.json())
            .then(geojson => {
                const kalselFeature = geojson.features.find(f =>
                    f.properties && f.properties.Propinsi &&
                    f.properties.Propinsi.toUpperCase().includes('KALIMANTAN SELATAN')
                );

                if (!kalselFeature) return;

                L.geoJSON(kalselFeature, {
                    style: {
                        color: '#1e40af',
                        weight: 2,
                        fillColor: '#3b82f6',
                        fillOpacity: 0.05,
                        dashArray: '4,4',
                        interactive: false
                    }
                }).addTo(map);

                const worldRing = [
                    [-180, -90],
                    [180, -90],
                    [180, 90],
                    [-180, 90],
                    [-180, -90]
                ];

                let kalselHoles = [];
                if (kalselFeature.geometry.type === 'Polygon') {
                    kalselHoles = kalselFeature.geometry.coordinates;
                } else if (kalselFeature.geometry.type === 'MultiPolygon') {
                    kalselFeature.geometry.coordinates.forEach(poly => {
                        poly.forEach(ring => kalselHoles.push(ring));
                    });
                }

                L.geoJSON({
                    type: 'Feature',
                    geometry: {
                        type: 'Polygon',
                        coordinates: [worldRing, ...kalselHoles]
                    },
                    properties: {}
                }, {
                    style: {
                        color: 'transparent',
                        weight: 0,
                        fillColor: '#0f172a',
                        fillOpacity: 0.55,
                        interactive: false
                    }
                }).addTo(map);
            })
            .catch(err => {
                console.warn('Gagal load GeoJSON Kalsel:', err);
            });

        // ============ MARKER ============
        const customIcon = L.divIcon({
            html: '<div style="position:relative;">' +
                '<svg width="36" height="44" viewBox="0 0 24 30" fill="none">' +
                '<path d="M12 0C5.4 0 0 5.4 0 12c0 9 12 18 12 18s12-9 12-18c0-6.6-5.4-12-12-12z" fill="#ef4444" stroke="white" stroke-width="1.5"/>' +
                '<circle cx="12" cy="12" r="4.5" fill="white"/>' +
                '</svg>' +
                '</div>',
            className: 'custom-marker',
            iconSize: [36, 44],
            iconAnchor: [18, 44]
        });

        const marker = L.marker([initialLat, initialLng], {
            draggable: true,
            icon: customIcon
        }).addTo(map);

        function updateInputs(lat, lng) {
            inputLat.value = lat.toFixed(7);
            inputLng.value = lng.toFixed(7);
        }

        // ============ REVERSE GEOCODING ============
        let geocodeTimeout = null;
        let lastGeocodeKey = null;

        async function reverseGeocode(lat, lng) {
            const key = lat.toFixed(4) + ',' + lng.toFixed(4);
            if (key === lastGeocodeKey) return;
            lastGeocodeKey = key;

            inputLokasi.placeholder = 'Mencari alamat...';
            inputLokasi.classList.add('bg-slate-100');

            try {
                const res = await fetch(
                    'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&zoom=18&addressdetails=1&accept-language=id'
                );
                const data = await res.json();

                if (data && data.address) {
                    const addr = data.address;
                    const parts = [];

                    if (addr.road) parts.push(addr.road);
                    if (addr.village || addr.suburb || addr.neighbourhood) {
                        parts.push(addr.village || addr.suburb || addr.neighbourhood);
                    }
                    if (addr.city_district || addr.district) {
                        parts.push(addr.city_district || addr.district);
                    }
                    if (addr.city || addr.town || addr.county) {
                        parts.push(addr.city || addr.town || addr.county);
                    }

                    let shortName = parts.slice(0, 4).join(', ');

                    if (!shortName) {
                        shortName = data.display_name.split(',').slice(0, 3).join(',').trim();
                    }

                    inputLokasi.value = shortName;
                } else {
                    inputLokasi.value = lat.toFixed(5) + ', ' + lng.toFixed(5);
                }
            } catch (err) {
                console.warn('Reverse geocoding gagal:', err);
                inputLokasi.value = lat.toFixed(5) + ', ' + lng.toFixed(5);
            } finally {
                inputLokasi.placeholder = 'Akan terisi otomatis setelah klik peta / GPS. Atau isi manual.';
                inputLokasi.classList.remove('bg-slate-100');
            }
        }

        function debouncedReverseGeocode(lat, lng) {
            clearTimeout(geocodeTimeout);
            geocodeTimeout = setTimeout(() => {
                reverseGeocode(lat, lng);
            }, 1000);
        }

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            marker.setLatLng([lat, lng]);
            updateInputs(lat, lng);
            debouncedReverseGeocode(lat, lng);
        });

        marker.on('dragend', function() {
            const pos = marker.getLatLng();
            updateInputs(pos.lat, pos.lng);
            debouncedReverseGeocode(pos.lat, pos.lng);
        });

        function onInputChange() {
            const lat = parseFloat(inputLat.value);
            const lng = parseFloat(inputLng.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
            }
        }
        inputLat.addEventListener('change', onInputChange);
        inputLng.addEventListener('change', onInputChange);

        // ============ GPS ============
        window.gunakanLokasiSaya = function() {
            const btn = document.getElementById('btn-lokasi-saya');
            const statusEl = document.getElementById('gps-status');

            statusEl.classList.add('hidden');
            statusEl.innerHTML = '';

            if (!navigator.geolocation) {
                showGpsStatus('error', 'Browser Anda tidak mendukung GPS / geolokasi.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML =
                '<svg class="w-4 h-4 text-blue-600 animate-spin" fill="none" viewBox="0 0 24 24">' +
                '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>' +
                '<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>' +
                '</svg>' +
                'Mencari lokasi...';

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const accuracy = position.coords.accuracy;

                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 16);
                    updateInputs(lat, lng);
                    reverseGeocode(lat, lng);

                    resetGpsButton();
                    showGpsStatus('success', 'Lokasi ditemukan (akurasi ±' + Math.round(accuracy) + ' meter). Koordinat & alamat sudah terisi otomatis.');
                },
                function(error) {
                    resetGpsButton();

                    let msg = 'Gagal mengambil lokasi.';
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            msg = 'Akses lokasi ditolak. Klik peta manual untuk menentukan lokasi, atau izinkan akses lokasi di browser Anda.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            msg = 'Informasi lokasi tidak tersedia. Coba lagi atau klik peta manual.';
                            break;
                        case error.TIMEOUT:
                            msg = 'Waktu pencarian lokasi habis. Coba lagi atau klik peta manual.';
                            break;
                    }
                    showGpsStatus('error', msg);
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        };

        function resetGpsButton() {
            const btn = document.getElementById('btn-lokasi-saya');
            btn.disabled = false;
            btn.innerHTML =
                '<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />' +
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />' +
                '</svg>' +
                'Gunakan Lokasi Saya';
        }

        function showGpsStatus(type, message) {
            const statusEl = document.getElementById('gps-status');
            statusEl.classList.remove('hidden');

            const baseClass = 'flex items-start gap-2 p-3 rounded-xl text-xs border ';
            const styleMap = {
                'success': 'bg-emerald-50 border-emerald-200 text-emerald-700',
                'error': 'bg-rose-50 border-rose-200 text-rose-700',
                'info': 'bg-blue-50 border-blue-200 text-blue-700'
            };

            const iconMap = {
                'success': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                'error': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                'info': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
            };

            statusEl.className = baseClass + styleMap[type];
            statusEl.innerHTML =
                '<svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                iconMap[type] +
                '</svg>' +
                '<span>' + message + '</span>';
        }
    });
</script>