@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

    {{-- HERO CAROUSEL --}}
<section class="relative h-screen min-h-[600px] overflow-hidden" id="hero">

    {{-- ═══ SLIDES ═══ --}}

    {{-- Slide 1 --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-100" id="slide-1">
        <img src="{{ asset('images/musee_des_civilisation.jpg') }}" alt="Dschang"
             class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms]"/>
        <div class="absolute inset-0 bg-gradient-to-r from-[#1B3A6B]/85 via-[#1B3A6B]/50 to-black/30"></div>
        <div class="slide-content absolute inset-0 flex flex-col justify-center px-8 md:px-20 max-w-3xl
                    opacity-0 translate-y-6 transition-all duration-700 delay-300">
            <span class="inline-flex items-center gap-2 bg-[#C8992A]/20 border border-[#C8992A]/50
                         text-[#C8992A] text-[13px] font-semibold px-4 py-2 rounded-full w-fit mb-5">
                📍 Dschang, Cameroun
            </span>
            <h1 class="text-white font-black leading-tight mb-4"
                style="font-size:clamp(32px,5vw,58px);font-family:Georgia,serif">
                Vous avez perdu <br>
                <span class="text-[#C8992A]">quelque chose ?</span>
            </h1>
            <p class="text-white/80 text-[16px] leading-relaxed mb-8">
                Plateforme officielle de gestion des objets égarés <br> dans la ville de Dschang.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('objets.index') }}"
                   class="flex items-center gap-2 bg-white text-[#1B3A6B] font-bold text-[14px]
                          px-7 py-3 rounded-lg shadow-lg hover:bg-gray-100 hover:-translate-y-1 transition-all">
                    🔍 Voir les objets trouvés
                </a>
                <a href="{{ route('deposer') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white font-bold text-[14px]
                          px-7 py-3 rounded-lg shadow-lg hover:bg-[#b8861e] hover:-translate-y-1 transition-all">
                    📦 Déclarer un objet
                </a>
            </div>
        </div>
    </div>

    {{-- Slide 2 --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0" id="slide-2">
        <img src="{{ asset('images/Hotel_de_ville_de_Dschang.jpg') }}" alt="Dschang"
             class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms]"/>
        <div class="absolute inset-0 bg-gradient-to-r from-[#065F46]/85 via-[#065F46]/50 to-black/30"></div>
        <div class="slide-content absolute inset-0 flex flex-col justify-center px-8 md:px-20 max-w-3xl
                    opacity-0 translate-y-6 transition-all duration-700 delay-300">
            <span class="inline-flex items-center gap-2 bg-[#C8992A]/20 border border-[#C8992A]/50
                         text-[#C8992A] text-[13px] font-semibold px-4 py-2 rounded-full w-fit mb-5">
                🛡️ Sécurisé & Confidentiel
            </span>
            <h1 class="text-white font-black leading-tight mb-4"
                style="font-size:clamp(32px,5vw,58px);font-family:Georgia,serif">
                Nous pouvons vous <br>
                <span class="text-[#C8992A]">aider à le retrouver.</span>
            </h1>
            <p class="text-white/80 text-[16px] leading-relaxed mb-8">
                Vos informations sont protégées. <br> Déclarez en toute confiance.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('deposer') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white font-bold text-[14px]
                          px-7 py-3 rounded-lg shadow-lg hover:bg-[#b8861e] hover:-translate-y-1 transition-all">
                    📦 Déposer un objet trouvé
                </a>
                <a href="{{ route('comment') }}"
                   class="flex items-center gap-2 bg-white/10 text-white border border-white/30 font-bold
                          text-[14px] px-7 py-3 rounded-lg hover:bg-white/20 hover:-translate-y-1 transition-all">
                    ℹ️ Comment ça marche
                </a>
            </div>
        </div>
    </div>

    {{-- Slide 3 --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 opacity-0" id="slide-3">
        <img src="{{ asset('images/2musee.jpg') }}" alt="Dschang"
             class="w-full h-full object-cover scale-105 transition-transform duration-[8000ms]"/>
        <div class="absolute inset-0 bg-gradient-to-r from-[#2a1a4a]/88 via-[#2a1a4a]/55 to-black/35"></div>
        <div class="slide-content absolute inset-0 flex flex-col justify-center px-8 md:px-20 max-w-3xl
                    opacity-0 translate-y-6 transition-all duration-700 delay-300">
            <span class="inline-flex items-center gap-2 bg-[#C8992A]/20 border border-[#C8992A]/50
                         text-[#C8992A] text-[13px] font-semibold px-4 py-2 rounded-full w-fit mb-5">
                👥 Communauté de Dschang
            </span>
            <h1 class="text-white font-black leading-tight mb-4"
                style="font-size:clamp(32px,5vw,58px);font-family:Georgia,serif">
                Ensemble, retrouvons <br>
                <span class="text-[#C8992A]">ce qui est perdu.</span>
            </h1>
            <p class="text-white/80 text-[16px] leading-relaxed mb-8">
                Rejoignez la communauté qui aide à restituer <br> les objets à leurs propriétaires.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('register') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white font-bold text-[14px]
                          px-7 py-3 rounded-lg shadow-lg hover:bg-[#b8861e] hover:-translate-y-1 transition-all">
                    👤 Créer un compte
                </a>
                <a href="{{ route('login') }}"
                   class="flex items-center gap-2 bg-white/10 text-white border border-white/30 font-bold
                          text-[14px] px-7 py-3 rounded-lg hover:bg-white/20 hover:-translate-y-1 transition-all">
                    🔑 Se connecter
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ FLÈCHES ═══ --}}
    <button id="prev-btn"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full
                   bg-white/10 border border-white/30 text-white text-xl
                   hover:bg-[#C8992A] hover:border-[#C8992A] transition-all backdrop-blur-sm">
        ‹
    </button>
    <button id="next-btn"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full
                   bg-white/10 border border-white/30 text-white text-xl
                   hover:bg-[#C8992A] hover:border-[#C8992A] transition-all backdrop-blur-sm">
        ›
    </button>

    {{-- ═══ DOTS ═══ --}}
    <div class="absolute bottom-20 left-20 z-20 flex gap-3" id="dots">
        <button class="dot w-7 h-[10px] rounded-full bg-[#C8992A] transition-all duration-300" data-slide="0"></button>
        <button class="dot w-[10px] h-[10px] rounded-full bg-white/40 transition-all duration-300" data-slide="1"></button>
        <button class="dot w-[10px] h-[10px] rounded-full bg-white/40 transition-all duration-300" data-slide="2"></button>
    </div>

    {{-- ═══ SCROLL INDICATOR ═══ --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1
                text-white/50 text-[11px] tracking-widest uppercase z-20" id="scroll-indicator">
        <span>Défiler</span>
        <span class="animate-bounce">↓</span>
    </div>

</section>

{{-- ═══ SCRIPT CAROUSEL ═══ --}}
@push('scripts')
<script>
    const slides    = document.querySelectorAll('.carousel-slide');
    const dots      = document.querySelectorAll('.dot');
    const prevBtn   = document.getElementById('prev-btn');
    const nextBtn   = document.getElementById('next-btn');
    let   current   = 0;
    let   timer     = null;

    function goTo(index) {
        /* Désactiver ancien slide */
        slides[current].style.opacity = '0';
        slides[current].querySelector('.slide-content').style.opacity = '0';
        slides[current].querySelector('.slide-content').style.transform = 'translateY(24px)';
        dots[current].style.width = '10px';
        dots[current].style.background = 'rgba(255,255,255,0.4)';

        /* Activer nouveau slide */
        current = (index + slides.length) % slides.length;
        slides[current].style.opacity = '1';
        dots[current].style.width = '28px';
        dots[current].style.background = '#C8992A';

        /* Animer le contenu */
        setTimeout(() => {
            const content = slides[current].querySelector('.slide-content');
            content.style.opacity = '1';
            content.style.transform = 'translateY(0)';
        }, 400);
    }

    function startAuto() {
        stopAuto();
        timer = setInterval(() => goTo(current + 1), 5000);
    }

    function stopAuto() {
        if (timer) clearInterval(timer);
    }

    /* Boutons */
    nextBtn.addEventListener('click', () => { goTo(current + 1); startAuto(); });
    prevBtn.addEventListener('click', () => { goTo(current - 1); startAuto(); });

    /* Dots */
    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => { goTo(i); startAuto(); });
    });

    /* Swipe mobile */
    let touchStartX = 0;
    document.getElementById('hero').addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
    document.getElementById('hero').addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) { diff > 0 ? goTo(current + 1) : goTo(current - 1); startAuto(); }
    });

    /* Pause au survol */
    document.getElementById('hero').addEventListener('mouseenter', stopAuto);
    document.getElementById('hero').addEventListener('mouseleave', startAuto);

    /* Scroll indicator */
    window.addEventListener('scroll', () => {
        const si = document.getElementById('scroll-indicator');
        if (si) si.style.opacity = window.scrollY > 80 ? '0' : '1';
    });

    /* Init */
    goTo(0);
    startAuto();
</script>
@endpush

    {{-- SECTION COMMENT ÇA MARCHE --}}
    <section class="py-20 bg-[#F1F5F9]">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2 class="text-3xl font-black text-[#1B3A6B] mb-3" style="font-family:Georgia,serif">
                    Comment ça marche ?
                </h2>
                <p class="text-gray-500 text-[15px]">3 étapes simples pour retrouver ou déclarer un objet.</p>
            </div>

            <div class="flex flex-col md:flex-row items-start gap-0">

                {{-- Étape 1 --}}
                <div class="flex-1 bg-white rounded-2xl p-8 shadow-sm border border-gray-100
                            hover:-translate-y-2 hover:shadow-md transition-all duration-200 relative mx-2 mb-6 md:mb-0">
                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-[#1B3A6B]
                                text-white rounded-full flex items-center justify-center font-black text-lg shadow-lg">
                        1
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-[#1B3A6B] to-[#2D5FA8] rounded-2xl
                                flex items-center justify-center text-3xl mx-auto mt-4 mb-5">
                        🔍
                    </div>
                    <h3 class="text-[#1B3A6B] font-black text-lg text-center mb-3">Rechercher</h3>
                    <p class="text-gray-500 text-[13.5px] text-center leading-relaxed">
                        Parcourez la liste des objets trouvés dans la ville de Dschang.
                    </p>
                </div>

                {{-- Flèche --}}
                <div class="hidden md:flex items-center text-[#C8992A] text-3xl px-2 mt-16">→</div>

                {{-- Étape 2 --}}
                <div class="flex-1 bg-white rounded-2xl p-8 shadow-sm border border-gray-100
                            hover:-translate-y-2 hover:shadow-md transition-all duration-200 relative mx-2 mb-6 md:mb-0">
                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-[#C8992A]
                                text-white rounded-full flex items-center justify-center font-black text-lg shadow-lg">
                        2
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-[#92400E] to-[#C8992A] rounded-2xl
                                flex items-center justify-center text-3xl mx-auto mt-4 mb-5">
                        📝
                    </div>
                    <h3 class="text-[#1B3A6B] font-black text-lg text-center mb-3">Déclarer</h3>
                    <p class="text-gray-500 text-[13.5px] text-center leading-relaxed">
                        Vous avez perdu un objet ? Remplissez notre formulaire simple.
                    </p>
                </div>

                {{-- Flèche --}}
                <div class="hidden md:flex items-center text-[#C8992A] text-3xl px-2 mt-16">→</div>

                {{-- Étape 3 --}}
                <div class="flex-1 bg-white rounded-2xl p-8 shadow-sm border border-gray-100
                            hover:-translate-y-2 hover:shadow-md transition-all duration-200 relative mx-2">
                    <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-[#16A34A]
                                text-white rounded-full flex items-center justify-center font-black text-lg shadow-lg">
                        3
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-[#065F46] to-[#16A34A] rounded-2xl
                                flex items-center justify-center text-3xl mx-auto mt-4 mb-5">
                        ✅
                    </div>
                    <h3 class="text-[#1B3A6B] font-black text-lg text-center mb-3">Récupérer</h3>
                    <p class="text-gray-500 text-[13.5px] text-center leading-relaxed">
                        Si votre objet est retrouvé, nous vous contactons pour organiser la récupération.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION CONFIANCE --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2 class="text-3xl font-black text-[#1B3A6B] mb-3" style="font-family:Georgia,serif">
                    Pourquoi nous faire confiance ?
                </h2>
                <p class="text-gray-500 text-[15px]">La sécurité et la confidentialité sont nos priorités absolues.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                @foreach([
                    ['🛡️', 'Sécurité', 'Vos informations sont protégées et jamais partagées publiquement.'],
                    ['⚡', 'Rapide', 'Déclarez et retrouvez vos objets en quelques clics seulement.'],
                    ['🏅', 'Fiable', 'Plateforme officielle de la ville de Dschang, approuvée.'],
                    ['👥', 'Communautaire', 'Ensemble, aidons-nous à retrouver ce qui nous appartient.'],
                ] as [$icon, $titre, $desc])
                    <div class="bg-[#F1F5F9] rounded-2xl p-7 text-center border border-gray-100
                                hover:-translate-y-2 hover:shadow-md transition-all duration-200">
                        <div class="text-4xl mb-4">{{ $icon }}</div>
                        <h3 class="text-[#1B3A6B] font-black text-[15px] mb-2">{{ $titre }}</h3>
                        <p class="text-gray-500 text-[13px] leading-relaxed">{{ $desc }}</p>
                    </div>
                @endforeach

            </div>

            {{-- Bandeau sécurité --}}
            <div class="mt-10 bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] rounded-2xl
                        p-7 flex items-center gap-5 border-l-4 border-[#C8992A]">
                <div class="w-14 h-14 bg-white/10 rounded-xl flex items-center justify-center text-3xl flex-shrink-0">
                    🔒
                </div>
                <div>
                    <strong class="text-white text-[16px] block mb-1">La sécurité avant tout</strong>
                    <p class="text-white/70 text-[13.5px] m-0">
                        Nous vérifions chaque demande pour garantir que les objets sont remis à leurs vrais propriétaires.
                    </p>
                </div>
            </div>

        </div>
    </section>

@endsection