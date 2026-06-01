@extends('layouts.app')

@section('title', 'Objets Égarés Dschang - La référence au Cameroun')

@push('styles')
<style>
/* ===== HERO BACKGROUND ===== */
.hero-bg {
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

/* ===== GRADIENT TEXT ===== */
.gradient-text {
    background: linear-gradient(135deg, #1B3A6B 0%, #C8992A 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ===== FLOATING ANIMATION ===== */
.float-animation {
    animation: float 6s ease-in-out infinite;
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* ===== PULSE GLOW ===== */
.pulse-glow {
    animation: pulseGlow 2s ease-in-out infinite;
}
@keyframes pulseGlow {
    0%, 100% { box-shadow: 0 0 20px rgba(200, 153, 42, 0.3); }
    50% { box-shadow: 0 0 40px rgba(200, 153, 42, 0.6); }
}

/* ===== STEP CARD HOVER ===== */
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

/* ===== STAT CARD HOVER ===== */
.stat-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.stat-card:hover {
    transform: translateY(-8px) scale(1.02);
    background: rgba(255,255,255,0.12);
    box-shadow: 0 20px 40px -12px rgba(0,0,0,0.3);
}

/* ===== PROFILE CARD WITH SHINE ===== */
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

/* ===== ANIMATED BUTTON RIPPLE ===== */
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

/* ===== SPARKLE EFFECT ===== */
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

/* ===== FAQ ITEM HOVER ===== */
.faq-item {
    transition: all 0.3s ease;
}
.faq-item:hover {
    transform: translateX(5px);
    box-shadow: -5px 0 0 #C8992A;
}

/* ===== RIPPLE ANIMATION ===== */
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

/* ===== BOUNCE ARROW ===== */
.arrow-bounce {
    animation: bounce 2s infinite;
}
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

/* ===== ANIMATIONS AU SCROLL (reveal) ===== */
.reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1);
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
.reveal-delay-4 { transition-delay: 0.4s; }
.reveal-delay-5 { transition-delay: 0.5s; }
</style>
@endpush

@section('content')

{{-- HERO CARROUSEL WITH PARTICLES --}}
<section class="relative h-screen w-full overflow-hidden" id="hero">
    <!-- Floating particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-2 h-2 bg-white/30 rounded-full top-1/4 left-1/4 float-animation" style="animation-delay: 0s;"></div>
        <div class="absolute w-3 h-3 bg-[#C8992A]/40 rounded-full top-1/3 right-1/4 float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute w-2 h-2 bg-white/20 rounded-full bottom-1/4 left-1/3 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute w-4 h-4 bg-[#C8992A]/30 rounded-full top-1/2 right-1/3 float-animation" style="animation-delay: 3s;"></div>
        <div class="absolute w-1.5 h-1.5 bg-white/40 rounded-full bottom-1/3 right-1/2 float-animation" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="relative w-full h-full">
        @php
            $slides = [
                [
                    'image' => 'musee_des_civilisation.jpg',
                    'badge' => '📍 DSCHANG, CAMEROUN',
                    'title' => 'Vous avez perdu <span class="text-[#C8992A]">quelque chose ?</span>',
                    'desc' => 'Plateforme officielle n°1 de gestion des objets égarés dans la ville de Dschang. Des milliers d’objets déjà restitués.',
                    'btn1' => ['route' => 'objets.index', 'text' => '🔍 PARCOURIR LES OBJETS TROUVÉS', 'color' => 'bg-white text-[#1B3A6B]'],
                    'btn2' => ['route' => 'deposer', 'text' => '📦 DÉCLARER UN OBJET PERDU', 'color' => 'bg-[#C8992A] text-white'],
                    'gradient' => 'from-[#1B3A6B]/90 via-[#1B3A6B]/60 to-black/40'
                ],
                [
                    'image' => 'Hotel_de_ville_de_Dschang.jpg',
                    'badge' => '🛡️ SÉCURISÉ & CONFIDENTIEL',
                    'title' => 'Nous pouvons vous <span class="text-[#C8992A]">aider à le retrouver.</span>',
                    'desc' => 'Vos données sont protégées. Déclarez en toute confiance et recevez des alertes instantanées.',
                    'btn1' => ['route' => 'deposer', 'text' => '📦 DÉPOSER UN OBJET TROUVÉ', 'color' => 'bg-[#C8992A] text-white'],
                    'btn2' => ['route' => 'comment', 'text' => 'ℹ️ EN SAVOIR PLUS', 'color' => 'bg-white/10 text-white border border-white/30'],
                    'gradient' => 'from-[#065F46]/85 via-[#065F46]/50 to-black/30'
                ],
                [
                    'image' => 'image5.jpg',
                    'badge' => '👥 COMMUNAUTÉ ACTIVE',
                    'title' => 'Ensemble, retrouvons <span class="text-[#C8992A]">ce qui est perdu.</span>',
                    'desc' => 'Rejoignez les 1 200+ membres qui participent à la restitution d’objets chaque mois.',
                    'btn1' => ['route' => 'register', 'text' => '👤 CRÉER UN COMPTE GRATUIT', 'color' => 'bg-[#C8992A] text-white'],
                    'btn2' => ['route' => 'login', 'text' => '🔑 SE CONNECTER', 'color' => 'bg-white/10 text-white border border-white/30'],
                    'gradient' => 'from-[#2a1a4a]/88 via-[#2a1a4a]/55 to-black/35'
                ]
            ];
        @endphp

        @foreach($slides as $index => $slide)
            @php
                $imagePath = public_path('images/'.$slide['image']);
                $imageUrl = file_exists($imagePath) ? asset('images/'.$slide['image']) : 'https://picsum.photos/id/'.(104+$index).'/1920/1080';
            @endphp
            <div class="carousel-slide absolute inset-0 transition-all duration-1000 ease-out {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide="{{ $index }}">
                <img src="{{ $imageUrl }}" alt="Dschang" class="absolute inset-0 w-full h-full object-cover scale-105 transition-transform duration-[12000ms]">
                <div class="absolute inset-0 bg-gradient-to-r {{ $slide['gradient'] }}"></div>
                <div class="slide-content absolute inset-0 z-10 flex items-center justify-center opacity-0 translate-y-6 transition-all duration-700 delay-300">
                    <div class="text-center text-white px-6 max-w-5xl mx-auto">
                        <span class="inline-block bg-[#C8992A]/30 backdrop-blur-md border border-[#C8992A] text-[#C8992A] text-sm md:text-base font-black tracking-wider px-6 py-2.5 rounded-full mb-8 hover:scale-105 transition-transform pulse-glow">
                            {{ $slide['badge'] }}
                        </span>
                        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black leading-tight mb-6 drop-shadow-2xl" style="font-family:Georgia,serif">
                            {!! $slide['title'] !!}
                        </h1>
                        <p class="text-xl md:text-2xl text-white/95 max-w-3xl mx-auto mb-10 leading-relaxed">
                            {{ $slide['desc'] }}
                        </p>
                        <div class="flex flex-wrap justify-center gap-5">
                            <a href="{{ route($slide['btn1']['route']) }}" class="btn-animated inline-flex items-center gap-3 {{ $slide['btn1']['color'] }} font-extrabold text-sm md:text-base px-8 md:px-10 py-4 md:py-5 rounded-xl shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-3xl hover:scale-105">
                                {{ $slide['btn1']['text'] }}
                            </a>
                            <a href="{{ route($slide['btn2']['route']) }}" class="btn-animated inline-flex items-center gap-3 {{ $slide['btn2']['color'] }} font-extrabold text-sm md:text-base px-8 md:px-10 py-4 md:py-5 rounded-xl shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-3xl hover:scale-105">
                                {{ $slide['btn2']['text'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button id="prev-btn" class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2 z-20 w-12 h-12 md:w-14 md:h-14 rounded-full bg-black/30 backdrop-blur-md text-white text-3xl flex items-center justify-center hover:bg-[#C8992A] transition-all duration-300 hover:scale-110">‹</button>
    <button id="next-btn" class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2 z-20 w-12 h-12 md:w-14 md:h-14 rounded-full bg-black/30 backdrop-blur-md text-white text-3xl flex items-center justify-center hover:bg-[#C8992A] transition-all duration-300 hover:scale-110">›</button>

    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-4">
        @foreach($slides as $index => $slide)
            <button class="dot transition-all duration-300 {{ $index === 0 ? 'bg-[#C8992A] w-10 h-2.5' : 'bg-white/50 w-2.5 h-2.5 rounded-full' }}" data-index="{{ $index }}"></button>
        @endforeach
    </div>

    <div id="scroll-indicator" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center text-white/50 text-xs gap-1">
        <span>SCROLL</span>
        <svg class="w-5 h-5 arrow-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m7-7v14"></path></svg>
    </div>
</section>

{{-- STATISTIQUES AVEC COMPTEURS --}}
<section class="py-20 bg-gradient-to-r from-[#0a1a2e] to-[#1B3A6B] text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14 reveal">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">CHIFFRES CLÉS</span>
            <h2 class="text-4xl md:text-5xl font-black mt-3" style="font-family:Georgia,serif">Ils nous font confiance</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 cursor-default reveal reveal-delay-1">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="1250">0</div>
                <p class="text-white/80 text-lg font-semibold">Utilisateurs actifs</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 cursor-default reveal reveal-delay-2">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="342">0</div>
                <p class="text-white/80 text-lg font-semibold">Objets retrouvés</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 cursor-default reveal reveal-delay-3">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="98">0</div>
                <p class="text-white/80 text-lg font-semibold">% de satisfaction</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 cursor-default reveal reveal-delay-4">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="24">0</div>
                <p class="text-white/80 text-lg font-semibold">Heures de réponse</p>
            </div>
        </div>
    </div>
</section>

{{-- COMMENT ÇA MARCHE (CARTES XXL) --}}
<section class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Processus</span>
            <h2 class="text-4xl md:text-5xl font-black text-[#1B3A6B] mt-3" style="font-family:Georgia,serif">Comment ça marche ?</h2>
            <div class="w-24 h-1 bg-[#C8992A] mx-auto mt-5"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $steps = [
                    ['icon' => '🔍', 'title' => '1. Rechercher', 'desc' => 'Consultez la liste des objets trouvés à Dschang. Utilisez nos filtres par catégorie, lieu et date.', 'color' => 'from-blue-500 to-blue-700'],
                    ['icon' => '📝', 'title' => '2. Déclarer', 'desc' => 'Remplissez notre formulaire en moins de 2 minutes. Ajoutez une photo et une description précise.', 'color' => 'from-amber-500 to-amber-700'],
                    ['icon' => '✅', 'title' => '3. Récupérer', 'desc' => 'Nous vous alertons par email et SMS dès qu’une correspondance est trouvée. Récupérez votre objet en mairie.', 'color' => 'from-green-500 to-green-700'],
                ];
            @endphp
            @foreach($steps as $index => $step)
                <div class="step-card group relative bg-gray-50 rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-4 overflow-hidden cursor-pointer reveal reveal-delay-{{ ($index+1)*100 }}">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $step['color'] }} opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <div class="step-number absolute top-6 left-6 w-14 h-14 bg-white/80 rounded-full flex items-center justify-center text-[#1B3A6B] font-black text-2xl shadow-md">{{ $loop->iteration }}</div>
                    <div class="text-7xl mb-6 group-hover:scale-110 transition-transform inline-block">{{ $step['icon'] }}</div>
                    <h3 class="text-2xl font-black text-[#1B3A6B] mb-4 group-hover:text-[#C8992A] transition-colors">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 text-base leading-relaxed group-hover:text-gray-800">{{ $step['desc'] }}</p>
                    <div class="mt-6 flex items-center text-[#C8992A] font-bold group-hover:translate-x-2 transition-transform">
                        En savoir plus <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- POURQUOI NOUS CHOISIR --}}
<section class="py-28 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Nos atouts</span>
            <h2 class="text-4xl md:text-5xl font-black text-[#1B3A6B] mt-3" style="font-family:Georgia,serif">Pourquoi nous choisir ?</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $reasons = [
                    ['icon' => '🛡️', 'title' => 'Sécurité maximale', 'desc' => 'Données chiffrées, accès restreint, validation manuelle des déclarations.'],
                    ['icon' => '⚡', 'title' => 'Ultra rapide', 'desc' => 'Déclarez en moins de 2 minutes. Alertes en temps réel par email et SMS.'],
                    ['icon' => '🏅', 'title' => 'Officiel', 'desc' => 'Plateforme agréée par la ville de Dschang et la préfecture.'],
                    ['icon' => '👥', 'title' => 'Communautaire', 'desc' => 'Plus de 1200 membres actifs qui participent à la restitution.'],
                ];
            @endphp
            @foreach($reasons as $index => $reason)
                <div class="profile-card bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 text-center group hover:-translate-y-2 cursor-pointer reveal reveal-delay-{{ ($index+1)*100 }}">
                    <div class="text-6xl mb-5 group-hover:scale-110 transition-transform inline-block">{{ $reason['icon'] }}</div>
                    <h3 class="text-xl font-black text-[#1B3A6B] mb-3 group-hover:text-[#C8992A] transition-colors">{{ $reason['title'] }}</h3>
                    <p class="text-gray-500 text-sm group-hover:text-gray-700">{{ $reason['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- TÉMOIGNAGES SLIDER --}}
<section class="py-28 bg-[#1B3A6B] text-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div class="reveal">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Témoignages</span>
            <h2 class="text-4xl md:text-5xl font-black mt-3 mb-12" style="font-family:Georgia,serif">Ils ont retrouvé leurs objets</h2>
        </div>
        <div class="relative reveal reveal-delay-1" id="testimonials-slider">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out" id="testimonials-track">
                    @php
                        $testimonials = [
                            ['name' => 'Marie-Claire N.', 'city' => 'Dschang', 'text' => 'J’avais perdu mon téléphone au marché. En 48h, on m’a contactée pour me le rendre. Incroyable !', 'rating' => 5],
                            ['name' => 'Jean-Paul K.', 'city' => 'Fongo-Tongo', 'text' => 'Service fiable et rapide. J’ai déclaré mes clés perdues et retrouvées en moins d’une semaine. Merci.', 'rating' => 5],
                            ['name' => 'Sandrine M.', 'city' => 'Dschang', 'text' => 'Plateforme très utile. L’équipe est réactive et professionnelle. Je recommande vivement.', 'rating' => 5],
                        ];
                    @endphp
                    @foreach($testimonials as $t)
                        <div class="w-full flex-shrink-0 px-4">
                            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-10 border border-white/20 transition-all duration-300 hover:scale-105 hover:bg-white/20 cursor-default">
                                <div class="flex justify-center gap-1 mb-5">
                                    @for($i=0;$i<$t['rating'];$i++) <span class="text-[#C8992A] text-2xl">★</span> @endfor
                                </div>
                                <p class="text-xl italic mb-6">“{{ $t['text'] }}”</p>
                                <div class="font-bold text-lg">{{ $t['name'] }}</div>
                                <div class="text-white/60 text-sm">{{ $t['city'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button id="testimonial-prev" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-[#C8992A] text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">‹</button>
            <button id="testimonial-next" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-[#C8992A] text-white w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">›</button>
        </div>
    </div>
</section>

{{-- CTA FINALE --}}
<section class="py-28 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <div class="relative overflow-hidden bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] rounded-3xl p-12 shadow-2xl transition-all duration-500 hover:shadow-3xl hover:scale-[1.02] reveal">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute w-96 h-96 bg-[#C8992A]/10 rounded-full -top-48 -right-48 animate-pulse"></div>
                <div class="absolute w-64 h-64 bg-white/5 rounded-full -bottom-32 -left-32 animate-pulse" style="animation-delay: 1s;"></div>
            </div>
            <div class="relative z-10">
                <span class="text-7xl block mb-6 float-animation">🛡️</span>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-4">Prêt à retrouver vos objets ?</h2>
                <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">Rejoignez des milliers d’utilisateurs dès aujourd’hui et ne perdez plus jamais vos biens.</p>
                <div class="flex flex-wrap justify-center gap-5">
                    <a href="{{ route('register') }}" class="btn-animated bg-[#C8992A] text-white font-extrabold px-8 py-4 rounded-xl hover:bg-[#b8861e] hover:-translate-y-1 transition-all duration-300 hover:shadow-xl hover:scale-105">CRÉER UN COMPTE GRATUIT</a>
                    <a href="{{ route('objets.index') }}" class="btn-animated bg-white text-[#1B3A6B] font-extrabold px-8 py-4 rounded-xl hover:bg-gray-100 hover:-translate-y-1 transition-all duration-300 hover:shadow-xl hover:scale-105">PARCOURIR LES OBJETS</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ ACCORDÉON (avec Alpine.js) --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12 reveal">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Questions fréquentes</span>
            <h2 class="text-3xl md:text-4xl font-black text-[#1B3A6B] mt-3">Vous avez des questions ?</h2>
        </div>
        <div class="space-y-4 reveal reveal-delay-1" x-data="{ activeIndex: null }">
            @php
                $faqs = [
                    ['q' => 'Combien de temps faut-il pour retrouver un objet ?', 'a' => 'Le délai varie selon l’objet et la zone. En moyenne, 70% des objets sont retrouvés sous 7 jours.'],
                    ['q' => 'Est-ce que la déclaration est payante ?', 'a' => 'Non, notre service est entièrement gratuit pour les habitants de Dschang.'],
                    ['q' => 'Comment être sûr que mon objet me sera rendu ?', 'a' => 'Nous vérifions l’identité des déclarants et des trouveurs. Une pièce d’identité est exigée lors de la restitution.'],
                    ['q' => 'Puis-je déclarer un objet trouvé sans compte ?', 'a' => 'Oui, mais la création d’un compte vous permet de suivre votre déclaration et d’être alerté en cas de correspondance.'],
                ];
            @endphp
            @foreach($faqs as $i => $faq)
                <div class="faq-item bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <button class="w-full text-left px-6 py-4 font-bold text-[#1B3A6B] flex justify-between items-center hover:bg-gray-50 transition-colors group"
                            @click="activeIndex = activeIndex === {{ $i }} ? null : {{ $i }}">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': activeIndex === {{ $i }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="overflow-hidden transition-all duration-500" x-show="activeIndex === {{ $i }}" x-collapse>
                        <div class="px-6 pb-4 text-gray-600 text-sm border-t border-gray-100 pt-4">{{ $faq['a'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== HERO CARROUSEL ==========
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const hero = document.getElementById('hero');
    let current = 0;
    let timer = null;

    if (slides.length) {
        function goTo(index) {
            slides[current].style.opacity = '0';
            const oldContent = slides[current].querySelector('.slide-content');
            if (oldContent) {
                oldContent.style.opacity = '0';
                oldContent.style.transform = 'translateY(24px)';
            }
            dots[current].style.width = '10px';
            dots[current].style.background = 'rgba(255,255,255,0.4)';

            current = (index + slides.length) % slides.length;

            slides[current].style.opacity = '1';
            dots[current].style.width = '28px';
            dots[current].style.background = '#C8992A';

            setTimeout(() => {
                const newContent = slides[current].querySelector('.slide-content');
                if (newContent) {
                    newContent.style.opacity = '1';
                    newContent.style.transform = 'translateY(0)';
                }
            }, 400);
        }

        function startAuto() { if (timer) clearInterval(timer); timer = setInterval(() => goTo(current + 1), 5000); }
        function stopAuto() { if (timer) clearInterval(timer); }

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => { goTo(current - 1); startAuto(); });
            nextBtn.addEventListener('click', () => { goTo(current + 1); startAuto(); });
        }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { goTo(i); startAuto(); });
        });

        if (hero) {
            let touchStartX = 0;
            hero.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; });
            hero.addEventListener('touchend', (e) => {
                const diff = touchStartX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 50) {
                    diff > 0 ? goTo(current + 1) : goTo(current - 1);
                    startAuto();
                }
            });
            hero.addEventListener('mouseenter', stopAuto);
            hero.addEventListener('mouseleave', startAuto);
        }

        goTo(0);
        startAuto();
    }

    // ========== SCROLL INDICATOR ==========
    const scrollIndicator = document.getElementById('scroll-indicator');
    if (scrollIndicator) {
        window.addEventListener('scroll', () => {
            scrollIndicator.style.opacity = window.scrollY > 80 ? '0' : '1';
        });
    }

    // ========== REVEAL ON SCROLL (Intersection Observer) ==========
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Optionnel : déconnecter l'observation après l'animation
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' }); // léger décalage pour déclencher avant l'entrée complète

    revealElements.forEach(el => observer.observe(el));

    // ========== COUNTERS (déclenchés uniquement quand la section statistiques devient visible) ==========
    const statsSection = document.querySelector('.counter')?.closest('section');
    if (statsSection) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = document.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.dataset.target);
                        let currentVal = 0;
                        const step = target / 50;
                        const update = () => {
                            currentVal += step;
                            if (currentVal < target) {
                                counter.innerText = Math.floor(currentVal);
                                requestAnimationFrame(update);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        update();
                    });
                    statsObserver.disconnect();
                }
            });
        }, { threshold: 0.5 });
        statsObserver.observe(statsSection);
    }

    // ========== TÉMOIGNAGES SLIDER ==========
    const track = document.getElementById('testimonials-track');
    const prevTest = document.getElementById('testimonial-prev');
    const nextTest = document.getElementById('testimonial-next');
    if (track && prevTest && nextTest) {
        let testIndex = 0;
        const totalTest = track.children.length;
        const updateTest = () => { track.style.transform = `translateX(-${testIndex * 100}%)`; };
        prevTest.addEventListener('click', () => { testIndex = (testIndex - 1 + totalTest) % totalTest; updateTest(); });
        nextTest.addEventListener('click', () => { testIndex = (testIndex + 1) % totalTest; updateTest(); });
        updateTest();
    }

    // ========== RIPPLE EFFECT ON BUTTONS ==========
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
});
</script>
@endpush