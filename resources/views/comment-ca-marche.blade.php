@extends('layouts.app')

@section('title', 'Comment ça marche')

@push('styles')
<style>
/* Hero Background Image */
.hero-bg {
    background-image: url('/images/image6.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

/* Gradient Text */
.gradient-text {
    background: linear-gradient(135deg, #1B3A6B 0%, #C8992A 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Float Animation */
.float-animation {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* Pulse Glow */
.pulse-glow {
    animation: pulseGlow 2s ease-in-out infinite;
}

@keyframes pulseGlow {
    0%, 100% { box-shadow: 0 0 20px rgba(200, 153, 42, 0.3); }
    50% { box-shadow: 0 0 40px rgba(200, 153, 42, 0.6); }
}

/* Scroll Indicator */
.scroll-indicator {
    animation: scrollDown 2s ease-in-out infinite;
}

@keyframes scrollDown {
    0%, 100% { opacity: 1; transform: translateY(0); }
    50% { opacity: 0.5; transform: translateY(15px); }
}

/* Step Card Hover */
.step-card {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.step-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.step-card:hover .step-number {
    transform: scale(1.2) rotate(5deg);
}

.step-number {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Profile Card Hover with Shine Effect */
.profile-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.6s ease;
}

.profile-card:hover::before {
    left: 100%;
}

.profile-card:hover {
    transform: translateY(-8px) rotateY(2deg);
    box-shadow: 0 20px 40px rgba(27, 58, 107, 0.2);
}

/* Animated Button with Ripple */
.btn-animated {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-animated::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-animated:hover::before {
    width: 300px;
    height: 300px;
}

.btn-animated:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* Sparkle Effect on Hover */
.sparkle {
    position: relative;
}

.sparkle::after {
    content: '✨';
    position: absolute;
    top: -8px;
    right: -8px;
    opacity: 0;
    transition: all 0.3s ease;
    font-size: 16px;
}

.sparkle:hover::after {
    opacity: 1;
    transform: scale(1.2) rotate(15deg);
}

/* FAQ Item Hover */
.faq-item {
    transition: all 0.3s ease;
}

.faq-item:hover {
    transform: translateX(5px);
    box-shadow: -5px 0 0 #C8992A;
}

/* Collapsible FAQ */
[x-collapse] {
    transition: height 0.5s ease, opacity 0.3s ease;
    overflow: hidden;
}

/* Ripple Animation */
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Bounce Animation for Arrow */
.arrow-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}
</style>
@endpush

@section('content')

    {{-- HERO FULL SCREEN WITH BACKGROUND IMAGE --}}
    <div class="hero-bg min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
        <!-- Animated particles overlay -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-2 h-2 bg-white/30 rounded-full top-1/4 left-1/4 float-animation" style="animation-delay: 0s;"></div>
            <div class="absolute w-3 h-3 bg-[#C8992A]/40 rounded-full top-1/3 right-1/4 float-animation" style="animation-delay: 1s;"></div>
            <div class="absolute w-2 h-2 bg-white/20 rounded-full bottom-1/4 left-1/3 float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute w-4 h-4 bg-[#C8992A]/30 rounded-full top-1/2 right-1/3 float-animation" style="animation-delay: 3s;"></div>
        </div>

        <!-- Main Hero Content -->
        <div class="relative z-10 text-center px-6 max-w-5xl mx-auto" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">

            <!-- Badge with animation -->
            <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-100"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm border-2 border-[#C8992A]/50
                        text-white text-sm font-bold px-6 py-3 rounded-full mb-8 pulse-glow">
                <span class="text-xl">ℹ️</span>
                <span>Guide d'utilisation</span>
            </div>

            <!-- Main title -->
            <h1 x-show="show" x-transition:enter="transition ease-out duration-700 delay-200"
                x-transition:enter-start="opacity-0 transform -translate-y-10"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="text-white font-black text-5xl sm:text-6xl md:text-7xl mb-6 tracking-tight">
                Comment ça marche ?
            </h1>

            <!-- Subtitle -->
            <p x-show="show" x-transition:enter="transition ease-out duration-700 delay-300"
               x-transition:enter-start="opacity-0 transform translate-y-10"
               x-transition:enter-end="opacity-100 transform translate-y-0"
               class="text-white/90 text-xl md:text-2xl max-w-3xl mx-auto mb-10 leading-relaxed">
                <span class="text-[#C8992A] font-bold">3 étapes simples</span> pour retrouver ou signaler un objet égaré
                dans la ville de <span class="font-semibold underline decoration-[#C8992A] decoration-2">Dschang</span>.
            </p>

            <!-- Animated buttons -->
            <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-400"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform transform scale-100"
                 class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="{{ route('objets.index') ?? '#objets' }}"
                   class="btn-animated inline-flex items-center justify-center gap-3 bg-[#C8992A] text-white
                          font-bold text-lg px-10 py-4 rounded-2xl shadow-2xl">
                    <span class="text-2xl">🔍</span>
                    <span>Voir les objets trouvés</span>
                </a>
                <a href="{{ route('deposer') ?? '#deposer' }}"
                   class="btn-animated inline-flex items-center justify-center gap-3 bg-white/10 backdrop-blur-sm
                          text-white border-2 border-white/40 font-bold text-lg px-10 py-4 rounded-2xl
                          hover:bg-white/20">
                    <span class="text-2xl">📦</span>
                    <span>Déposer un objet</span>
                </a>
            </div>

            <!-- Decorative dots -->
            <div class="flex justify-center gap-4 mb-8">
                <div class="w-3 h-3 bg-[#C8992A] rounded-full animate-ping"></div>
                <div class="w-3 h-3 bg-white/50 rounded-full animate-ping" style="animation-delay: 0.2s;"></div>
                <div class="w-3 h-3 bg-[#C8992A]/70 rounded-full animate-ping" style="animation-delay: 0.4s;"></div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 scroll-indicator">
            <div class="flex flex-col items-center text-white/70">
                <span class="text-sm mb-2 font-medium">Défiler vers le bas</span>
                <svg class="w-6 h-6 arrow-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-6xl mx-auto px-6 py-20">

        {{-- PROCESS IN 3 STEPS --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-black text-[#1B3A6B] mb-4 tracking-tight">
                Le processus en <span class="gradient-text">3 étapes</span>
            </h2>
            <p class="text-gray-500 text-lg">Simple, rapide et sécurisé.</p>
        </div>

        <div class="flex flex-col gap-16 mb-24">

            {{-- Step 1 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center" data-aos="fade-right">
                <div class="step-card bg-gradient-to-br from-[#1B3A6B] to-[#2D5FA8] rounded-3xl p-12 text-center
                            relative overflow-hidden shadow-2xl">
                    <div class="step-number absolute top-6 left-6 w-14 h-14 bg-white/30 backdrop-blur-sm
                                rounded-full flex items-center justify-center text-white font-black text-2xl">
                        1
                    </div>
                    <div class="relative z-10">
                        <span class="text-8xl block mb-6 animate__animated animate__pulse animate__infinite">🔍</span>
                        <h3 class="text-white font-black text-3xl tracking-tight">
                            Rechercher
                        </h3>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                    <div class="absolute -top-10 -left-10 w-24 h-24 bg-[#C8992A]/20 rounded-full"></div>
                </div>
                <div class="space-y-6">
                    <div data-aos="fade-left" data-aos-delay="100">
                        <span class="inline-block bg-blue-50 text-[#2D5FA8] text-xs font-bold px-4 py-2
                                     rounded-full mb-4 uppercase tracking-wide">
                            Pour les propriétaires
                        </span>
                        <h3 class="text-[#1B3A6B] font-black text-3xl mb-4 tracking-tight">
                            Recherchez votre objet
                        </h3>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Parcourez la liste des objets trouvés dans la ville de Dschang.
                            Filtrez par <span class="font-semibold text-[#1B3A6B]">catégorie</span>,
                            <span class="font-semibold text-[#1B3A6B]">lieu</span> ou
                            <span class="font-semibold text-[#1B3A6B]">date</span> pour trouver votre objet plus facilement.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 mb-8" data-aos="fade-up" data-aos-delay="200">
                        @foreach([
                            'Filtres par catégorie et lieu',
                            'Recherche par mots-clés',
                            'Mise à jour en temps réel',
                        ] as $item)
                            <div class="flex items-center gap-4 p-3 bg-green-50 rounded-xl
                                        hover:bg-green-100 transition-colors sparkle">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center
                                            justify-center text-white text-sm flex-shrink-0 shadow-md">
                                    ✓
                                </div>
                                <span class="text-gray-700 font-medium">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('objets.index') ?? '#objets' }}"
                       class="btn-animated inline-flex items-center gap-3 bg-[#1B3A6B] text-white
                              font-bold text-base px-8 py-4 rounded-2xl shadow-lg"
                       data-aos="zoom-in" data-aos-delay="300">
                        <span class="text-xl">🔍</span>
                        <span>Voir les objets trouvés</span>
                    </a>
                </div>
            </div>

            {{-- Separator --}}
            <div class="flex items-center justify-center" data-aos="zoom-in">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <div class="w-3 h-3 bg-[#C8992A] rounded-full animate-pulse"></div>
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div class="order-2 lg:order-1 space-y-6">
                    <div data-aos="fade-right" data-aos-delay="100">
                        <span class="inline-block bg-amber-50 text-amber-700 text-xs font-bold px-4 py-2
                                     rounded-full mb-4 uppercase tracking-wide">
                            Pour les inventeurs
                        </span>
                        <h3 class="text-[#1B3A6B] font-black text-3xl mb-4 tracking-tight">
                            Déposez anonymement
                        </h3>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Vous avez trouvé un objet à Dschang ? Remplissez un formulaire simple.
                            <span class="font-semibold text-[#1B3A6B]">Aucun compte requis</span>,
                            votre identité reste confidentielle.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 mb-8" data-aos="fade-up" data-aos-delay="200">
                        @foreach([
                            'Aucun compte nécessaire',
                            'Photo optionnelle et stockage privé',
                            'Accusé de réception immédiat',
                            'Coordonnées visibles uniquement par l\'admin',
                        ] as $item)
                            <div class="flex items-center gap-4 p-3 bg-green-50 rounded-xl
                                        hover:bg-green-100 transition-colors sparkle">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center
                                            justify-center text-white text-sm flex-shrink-0 shadow-md">
                                    ✓
                                </div>
                                <span class="text-gray-700 font-medium">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('deposer') ?? '#deposer' }}"
                       class="btn-animated inline-flex items-center gap-3 bg-[#C8992A] text-white
                              font-bold text-base px-8 py-4 rounded-2xl shadow-lg"
                       data-aos="zoom-in" data-aos-delay="300">
                        <span class="text-xl">📦</span>
                        <span>Déposer un objet trouvé</span>
                    </a>
                </div>
                <div class="order-1 lg:order-2 step-card bg-gradient-to-br from-amber-600 to-[#C8992A]
                            rounded-3xl p-12 text-center relative overflow-hidden shadow-2xl"
                     data-aos="fade-left">
                    <div class="step-number absolute top-6 left-6 w-14 h-14 bg-white/30 backdrop-blur-sm
                                rounded-full flex items-center justify-center text-white font-black text-2xl">
                        2
                    </div>
                    <div class="relative z-10">
                        <span class="text-8xl block mb-6 animate__animated animate__pulse animate__infinite animate__delay-1s">📦</span>
                        <h3 class="text-white font-black text-3xl tracking-tight">
                            Déposer
                        </h3>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                    <div class="absolute -top-10 -left-10 w-24 h-24 bg-amber-300/20 rounded-full"></div>
                </div>
            </div>

            {{-- Separator --}}
            <div class="flex items-center justify-center" data-aos="zoom-in">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center" data-aos="fade-right">
                <div class="step-card bg-gradient-to-br from-green-700 to-green-500
                            rounded-3xl p-12 text-center relative overflow-hidden shadow-2xl">
                    <div class="step-number absolute top-6 left-6 w-14 h-14 bg-white/30 backdrop-blur-sm
                                rounded-full flex items-center justify-center text-white font-black text-2xl">
                        3
                    </div>
                    <div class="relative z-10">
                        <span class="text-8xl block mb-6 animate__animated animate__pulse animate__infinite animate__delay-2s">✅</span>
                        <h3 class="text-white font-black text-3xl tracking-tight">
                            Récupérer
                        </h3>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                    <div class="absolute -top-10 -left-10 w-24 h-24 bg-green-300/20 rounded-full"></div>
                </div>
                <div class="space-y-6">
                    <div data-aos="fade-left" data-aos-delay="100">
                        <span class="inline-block bg-green-50 text-green-700 text-xs font-bold px-4 py-2
                                     rounded-full mb-4 uppercase tracking-wide">
                            Résultat final
                        </span>
                        <h3 class="text-[#1B3A6B] font-black text-3xl mb-4 tracking-tight">
                            Récupérez votre objet
                        </h3>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Lorsqu'une correspondance est trouvée, l'administrateur vous contacte
                            par email. Présentez-vous à la <span class="font-semibold text-[#1B3A6B]">mairie de Dschang</span>
                            avec une pièce d'identité pour récupérer votre objet.
                        </p>
                    </div>
                    <div class="flex flex-col gap-3 mb-6" data-aos="fade-up" data-aos-delay="200">
                        @foreach([
                            'Notification par email automatique',
                            'Rendez-vous à la mairie de Dschang',
                            'Pièce d\'identité obligatoire',
                            'Mise en relation sécurisée par l\'admin',
                        ] as $item)
                            <div class="flex items-center gap-4 p-3 bg-green-50 rounded-xl
                                        hover:bg-green-100 transition-colors sparkle">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center
                                            justify-center text-white text-sm flex-shrink-0 shadow-md">
                                    ✓
                                </div>
                                <span class="text-gray-700 font-medium">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- WHO CAN USE SECTION --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-black text-[#1B3A6B] mb-4 tracking-tight">
                Qui peut utiliser <span class="gradient-text">DschangLost</span> ?
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">

            {{-- Anonymous Finder Profile --}}
            <div class="profile-card bg-white rounded-3xl p-10 border-2 border-blue-100 shadow-xl"
                 data-aos="fade-right" data-aos-delay="100">
                <div class="flex items-start gap-6 mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#1B3A6B] to-[#2D5FA8]
                                rounded-2xl flex items-center justify-center text-5xl flex-shrink-0 shadow-lg">
                        🕵️
                    </div>
                    <div>
                        <h3 class="text-[#1B3A6B] font-black text-2xl mb-2">
                            L'Inventeur Anonyme
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Vous avez trouvé un objet
                        </p>
                    </div>
                </div>
                <ul class="flex flex-col gap-3 mb-8">
                    @foreach([
                        ['icon' => '✅', 'text' => 'Aucun compte nécessaire'],
                        ['icon' => '✅', 'text' => 'Formulaire simple en 3 étapes'],
                        ['icon' => '✅', 'text' => 'Photo optionnelle'],
                        ['icon' => '✅', 'text' => 'Anonymat garanti'],
                        ['icon' => '❌', 'text' => 'Aucun accès au site après dépôt'],
                    ] as $item)
                        <li class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-100 transition-colors">
                            <span class="text-lg">{{ $item['icon'] }}</span>
                            <span class="text-gray-700 font-medium">{{ $item['text'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('deposer') ?? '#deposer' }}"
                   class="btn-animated w-full flex items-center justify-center gap-3 bg-[#1B3A6B]
                          text-white font-bold text-base py-4 rounded-2xl shadow-lg">
                    <span class="text-xl">📦</span>
                    <span>Déposer un objet trouvé</span>
                </a>
            </div>

            {{-- Registered Owner Profile --}}
            <div class="profile-card bg-white rounded-3xl p-10 border-2 border-amber-100 shadow-xl"
                 data-aos="fade-left" data-aos-delay="200">
                <div class="flex items-start gap-6 mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-600 to-[#C8992A]
                                rounded-2xl flex items-center justify-center text-5xl flex-shrink-0 shadow-lg">
                        👤
                    </div>
                    <div>
                        <h3 class="text-[#1B3A6B] font-black text-2xl mb-2">
                            Le Propriétaire Inscrit
                        </h3>
                        <p class="text-gray-500 text-sm font-medium">
                            Vous avez perdu un objet
                        </p>
                    </div>
                </div>
                <ul class="flex flex-col gap-3 mb-8">
                    @foreach([
                        ['icon' => '✅', 'text' => 'Créer un compte gratuit'],
                        ['icon' => '✅', 'text' => 'Déclarer votre perte en détail'],
                        ['icon' => '✅', 'text' => 'Suivre le statut de vos déclarations'],
                        ['icon' => '✅', 'text' => 'Recevoir des alertes par email'],
                        ['icon' => '✅', 'text' => 'Contacter l\'administrateur'],
                    ] as $item)
                        <li class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-100 transition-colors">
                            <span class="text-lg">{{ $item['icon'] }}</span>
                            <span class="text-gray-700 font-medium">{{ $item['text'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') ?? '#register' }}"
                   class="btn-animated w-full flex items-center justify-center gap-3 bg-[#C8992A]
                          text-white font-bold text-base py-4 rounded-2xl shadow-lg">
                    <span class="text-xl">👤</span>
                    <span>Créer mon compte</span>
                </a>
            </div>

        </div>

        {{-- FAQ SECTION --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-black text-[#1B3A6B] mb-4 tracking-tight">
                Questions <span class="gradient-text">fréquentes</span>
            </h2>
        </div>

        <div class="max-w-4xl mx-auto mb-20" x-data="{ activeIndex: 0 }">
            @foreach([
                [
                    'Est-ce que le service est gratuit ?',
                    'Oui, DschangLost est entièrement gratuit pour tous les utilisateurs. Le service est offert par la ville de Dschang pour faciliter la restitution des objets égarés.'
                ],
                [
                    'Mes informations personnelles sont-elles sécurisées ?',
                    'Absolument. Les coordonnées des inventeurs ne sont jamais rendues publiques. Les photos sont stockées dans un espace privé, jamais dans un dossier public. Nous prenons la protection des données très au sérieux.'
                ],
                [
                    'Combien de temps faut-il pour retrouver un objet ?',
                    'Cela dépend des dépôts disponibles. L\'administrateur compare régulièrement les objets déposés aux déclarations. En moyenne, une correspondance est traitée sous 24 à 48 heures.'
                ],
                [
                    'Dois-je avoir un Gmail pour utiliser la plateforme ?',
                    'Non, ce n\'est pas obligatoire. Cependant, si vous avez un Gmail, vous recevrez automatiquement un email de notification lorsqu\'un objet correspondant est trouvé.'
                ],
            ] as $i => [$question, $reponse])
                <div class="faq-item bg-white rounded-2xl border border-gray-100 shadow-md mb-4 overflow-hidden"
                     data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <button class="w-full flex items-center justify-between px-8 py-6 text-left font-bold text-gray-800
                                   hover:text-[#1B3A6B] transition-all duration-300"
                            @click="activeIndex = activeIndex === {{ $i }} ? -1 : {{ $i }}">
                        <span class="text-lg pr-4">{{ $question }}</span>
                        <span class="text-2xl text-[#C8992A] transition-transform duration-300"
                              :class="{ 'rotate-180': activeIndex === {{ $i }} }">
                            ▼
                        </span>
                    </button>
                    <div class="overflow-hidden transition-all duration-500"
                         x-show="activeIndex === {{ $i }}"
                         x-collapse>
                        <div class="px-8 pb-6 text-gray-600 text-base leading-relaxed border-t border-gray-100 pt-4">
                            {{ $reponse }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA FINAL --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-[#1B3A6B] via-[#2D5FA8] to-[#1B3A6B]
                    rounded-3xl p-12 md:p-16 text-center shadow-2xl"
             data-aos="zoom-in">
            <!-- Animated background elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute w-96 h-96 bg-[#C8992A]/10 rounded-full -top-48 -right-48 animate-pulse"></div>
                <div class="absolute w-64 h-64 bg-white/5 rounded-full -bottom-32 -left-32 animate-pulse"
                     style="animation-delay: 1s;"></div>
            </div>

            <div class="relative z-10">
                <span class="text-7xl block mb-6 float-animation">🛡️</span>
                <h2 class="text-white font-black text-4xl md:text-5xl mb-6 tracking-tight">
                    Prêt à commencer ?
                </h2>
                <p class="text-white/80 text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                    Rejoignez la communauté DschangLost et aidez à restituer
                    les objets égarés à leurs propriétaires.
                </p>
                <div class="flex flex-col sm:flex-row gap-5 justify-center">
                    <a href="{{ route('deposer') ?? '#deposer' }}"
                       class="btn-animated inline-flex items-center justify-center gap-3 bg-[#C8992A]
                              text-white font-bold text-lg px-10 py-5 rounded-2xl shadow-xl">
                        <span class="text-2xl">📦</span>
                        <span>J'ai trouvé un objet</span>
                    </a>
                    <a href="{{ route('register') ?? '#register' }}"
                       class="btn-animated inline-flex items-center justify-center gap-3 bg-white/10
                              backdrop-blur-sm text-white border-2 border-white/40 font-bold text-lg
                              px-10 py-5 rounded-2xl">
                        <span class="text-2xl">👤</span>
                        <span>J'ai perdu un objet</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
// Alpine.js collapse directive
document.addEventListener(') {
    Alpine.directive('collapse', (el, { expression }, { effect, evaluateLater }) => {
        let expressionResult = evaluateLater(expression || 'true');

        effect(() => {
            expressionResult(value => {
                if (value) {
                    el.style.height = el.scrollHeight + 'px';
                    el.style.opacity = '1';
                } else {
                    el.style.height = '0px';
                    el.style.opacity = '0';
                }
            });
        });
    });
});

// Add ripple effect to buttons
document.querySelectorAll('.btn-animated').forEach(button => {
    button.addEventListener('click', function(e) {
        const x = e.clientX - e.target.getBoundingClientRect().left;
        const y = e.clientY - e.target.getBoundingClientRect().top;

        const ripple = document.createElement('span');
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });
});

// Parallax effect for hero
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.hero-bg');
    if (parallax) {
        parallax.style.backgroundPositionY = scrolled * 0.5 + 'px';
    }
});
</script>
@endpush
