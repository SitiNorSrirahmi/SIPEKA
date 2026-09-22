<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - SIPEKA</title>

    {{-- Font: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif !important;
        }

        input,
        label,
        button,
        select,
        textarea,
        ::placeholder {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif !important;
        }

        /* ==================== SLIDESHOW (DESKTOP) ==================== */
        .slideshow-wrapper {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 1.5s ease-in-out, transform 5s ease-in-out;
            transform: scale(1);
            will-change: opacity, transform;
        }

        .slide.active {
            opacity: 1;
            transform: scale(1.08);
        }

        .slideshow-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(10, 26, 58, 0.65) 0%, rgba(10, 26, 58, 0.35) 60%, rgba(10, 26, 58, 0.10) 100%);
            z-index: 1;
        }

        .slideshow-fade {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 72%,
                    rgba(255, 255, 255, 0.5) 88%,
                    rgba(255, 255, 255, 1) 100%);
            z-index: 2;
            pointer-events: none;
        }

        /* ==================== FOTO BACKGROUND (MOBILE) ==================== */
        .mobile-bg {
            position: fixed;
            inset: 0;
            background-image: url("{{ asset('images/slideshow/slide1.png') }}");
            background-size: cover;
            background-position: center;
            z-index: -2;
        }

        .mobile-bg-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(180deg,
                    rgba(10, 26, 58, 0.75) 0%,
                    rgba(10, 26, 58, 0.85) 50%,
                    rgba(10, 26, 58, 0.95) 100%);
            z-index: -1;
        }

        /* ==================== BACKGROUND FOTO ==================== */
        .slide-1 { background-image: url("{{ asset('images/slideshow/slide1.png') }}"); }
        .slide-2 { background-image: url("{{ asset('images/slideshow/slide2.png') }}"); }
        .slide-3 { background-image: url("{{ asset('images/slideshow/slide3.png') }}"); }
        .slide-4 { background-image: url("{{ asset('images/slideshow/slide4.png') }}"); }

        /* ==================== CARD ==================== */
        .lux-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow:
                0 10px 40px rgba(15, 23, 42, 0.10),
                0 4px 12px rgba(15, 23, 42, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .lux-card:hover {
            box-shadow:
                0 16px 50px rgba(15, 23, 42, 0.14),
                0 6px 16px rgba(15, 23, 42, 0.08);
        }

        /* ==================== INPUT FOCUS ==================== */
        .input-lux {
            transition: all 0.25s ease;
        }

        .input-lux:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        /* ==================== TOMBOL ==================== */
        .btn-lux {
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.28);
            transition: all 0.3s ease;
        }

        .btn-lux:hover {
            box-shadow: 0 10px 28px rgba(30, 58, 138, 0.40);
            transform: translateY(-1px);
        }

        /* ==================== MOBILE ONLY ==================== */
        @media (max-width: 1023px) {
            body {
                background-color: #0a1a3a;
            }
        }

        /* Sembunyikan mobile background di desktop */
        @media (min-width: 1024px) {
            .mobile-bg,
            .mobile-bg-overlay {
                display: none;
            }
        }
    </style>
</head>

<body class="antialiased">

    {{-- ==================== MOBILE BACKGROUND (HANYA MOBILE) ==================== --}}
    <div class="mobile-bg"></div>
    <div class="mobile-bg-overlay"></div>

    <div class="min-h-screen flex">

        {{-- ==================== KIRI: BRANDING (HANYA DESKTOP) ==================== --}}
        <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-12 text-white"
            style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">

            <div class="slideshow-wrapper" id="slideshow">
                <div class="slide slide-1 active"></div>
                <div class="slide slide-2"></div>
                <div class="slide slide-3"></div>
                <div class="slide slide-4"></div>

                <div class="slideshow-overlay"></div>
                <div class="slideshow-fade"></div>
            </div>

            <div class="relative z-10"></div>

            <div class="relative z-10">
                <h1 class="text-4xl font-bold leading-tight mb-2">
                    Selamat Datang
                </h1>
                <h1 class="text-4xl font-bold leading-tight mb-4">
                    di <span style="color: #fbbf24;">SIPEKA</span>
                </h1>
                <p class="text-blue-100 text-sm">
                    Sistem Informasi Pemetaan Bencana Kalimantan Selatan
                </p>
            </div>
        </div>

        {{-- ==================== KANAN: FORM LOGIN ==================== --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-6 lg:bg-white">
            <div class="lux-card w-full max-w-md p-6 sm:p-8 lg:p-10">

                {{-- Link Kembali ke Beranda --}}
                <a href="{{ url('/') }}"
                    class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-blue-700 hover:text-blue-900 mb-5 sm:mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>

                {{-- Logo SIPEKA --}}
                <div class="flex justify-center mb-6 sm:mb-8">
                    <img src="{{ asset('images/SIPEKA.png') }}" alt="SIPEKA" class="h-14 sm:h-16 lg:h-20 object-contain">
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1.5 sm:mb-2 tracking-wide">
                            EMAIL
                        </label>
                        <input id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="username"
                            placeholder="Masukkan alamat email"
                            class="input-lux w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:border-blue-500 outline-none text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1.5 sm:mb-2 tracking-wide">
                            KATA SANDI
                        </label>
                        <div class="relative">
                            <input id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="Masukkan kata sandi"
                                class="input-lux w-full px-3 sm:px-4 py-2.5 sm:py-3 pr-11 sm:pr-12 rounded-lg border border-gray-300 focus:border-blue-500 outline-none text-sm">

                            <button type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 sm:pr-4 text-gray-500 hover:text-gray-800 focus:outline-none transition"
                                aria-label="Tampilkan kata sandi">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center text-xs sm:text-sm">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ms-2 text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    {{-- Tombol Masuk --}}
                    <button type="submit"
                        class="btn-lux w-full py-2.5 sm:py-3 rounded-lg font-bold text-white text-sm sm:text-base"
                        style="background-color: #1e3a8a;">
                        Masuk
                    </button>
                </form>

            </div>
        </div>

    </div>

    {{-- ==================== SCRIPT ==================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SLIDESHOW (desktop)
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;
            let currentIndex = 0;
            const intervalMs = 5000;

            function nextSlide() {
                slides[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % totalSlides;
                slides[currentIndex].classList.add('active');
            }

            if (totalSlides > 1) {
                setInterval(nextSlide, intervalMs);
            }

            // TOGGLE PASSWORD
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';

                    if (isPassword) {
                        eyeIcon.classList.add('hidden');
                        eyeOffIcon.classList.remove('hidden');
                    } else {
                        eyeIcon.classList.remove('hidden');
                        eyeOffIcon.classList.add('hidden');
                    }
                });
            }
        });
    </script>

</body>

</html>