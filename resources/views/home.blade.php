@extends('layouts.app')

@section('title', 'Objets Égarés Dschang - La référence au Cameroun')

@section('content')

{{-- HERO CARROUSEL PLEIN ÉCRAN --}}
<section class="relative h-screen w-full overflow-hidden" id="hero">
    <div class="relative w-full h-full">
        @php
            $slides = [
                [
                    'image' => 'musee_des_civilisation.jpg',
                    'badge' => '📍 DSCHANG, CAMEROUN',
                    'title' => 'Vous avez perdu <span class="text-[#C8992A]">quelque chose ?</span>',
                    'desc' => 'Plateforme officielle n°1 de gestion des objets égarés dans la ville de Dschang. Des milliers d’objets déjà restitués.',
                    'btn1' => ['route' => 'objets.index', 'text' => '🔍 PARCOURIR LES OBJETS TROUVÉS', 'color' => 'bg-white text-[#1B3A6B] hover:bg-gray-100'],
                    'btn2' => ['route' => 'deposer', 'text' => '📦 DÉCLARER UN OBJET PERDU', 'color' => 'bg-[#C8992A] text-white hover:bg-[#b8861e]'],
                    'gradient' => 'from-[#1B3A6B]/90 via-[#1B3A6B]/60 to-black/40'
                ],
                [
                    'image' => 'Hotel_de_ville_de_Dschang.jpg',
                    'badge' => '🛡️ SÉCURISÉ & CONFIDENTIEL',
                    'title' => 'Nous pouvons vous <span class="text-[#C8992A]">aider à le retrouver.</span>',
                    'desc' => 'Vos données sont protégées. Déclarez en toute confiance et recevez des alertes instantanées.',
                    'btn1' => ['route' => 'deposer', 'text' => '📦 DÉPOSER UN OBJET TROUVÉ', 'color' => 'bg-[#C8992A] text-white hover:bg-[#b8861e]'],
                    'btn2' => ['route' => 'comment', 'text' => 'ℹ️ EN SAVOIR PLUS', 'color' => 'bg-white/10 text-white border border-white/30 hover:bg-white/20'],
                    'gradient' => 'from-[#065F46]/85 via-[#065F46]/50 to-black/30'
                ],
                [
                    'image' => 'image4.jpg',
                    'badge' => '👥 COMMUNAUTÉ ACTIVE',
                    'title' => 'Ensemble, retrouvons <span class="text-[#C8992A]">ce qui est perdu.</span>',
                    'desc' => 'Rejoignez les 1 200+ membres qui participent à la restitution d’objets chaque mois.',
                    'btn1' => ['route' => 'register', 'text' => '👤 CRÉER UN COMPTE GRATUIT', 'color' => 'bg-[#C8992A] text-white hover:bg-[#b8861e]'],
                    'btn2' => ['route' => 'login', 'text' => '🔑 SE CONNECTER', 'color' => 'bg-white/10 text-white border border-white/30 hover:bg-white/20'],
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
                        <span class="inline-block bg-[#C8992A]/30 backdrop-blur-md border border-[#C8992A] text-[#C8992A] text-sm md:text-base font-black tracking-wider px-6 py-2.5 rounded-full mb-8 hover:scale-105 transition-transform">
                            {{ $slide['badge'] }}
                        </span>
                        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black leading-tight mb-6 drop-shadow-2xl" style="font-family:Georgia,serif">
                            {!! $slide['title'] !!}
                        </h1>
                        <p class="text-xl md:text-2xl text-white/95 max-w-3xl mx-auto mb-10 leading-relaxed">
                            {{ $slide['desc'] }}
                        </p>
                        <div class="flex flex-wrap justify-center gap-5">
                            <a href="{{ route($slide['btn1']['route']) }}" class="inline-flex items-center gap-3 {{ $slide['btn1']['color'] }} font-extrabold text-sm md:text-base px-8 md:px-10 py-4 md:py-5 rounded-xl shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-3xl hover:scale-105">
                                {{ $slide['btn1']['text'] }}
                            </a>
                            <a href="{{ route($slide['btn2']['route']) }}" class="inline-flex items-center gap-3 {{ $slide['btn2']['color'] }} font-extrabold text-sm md:text-base px-8 md:px-10 py-4 md:py-5 rounded-xl shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-3xl hover:scale-105">
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

    <div id="scroll-indicator" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center text-white/50 text-xs gap-1 animate-bounce">
        <span>SCROLL</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m7-7v14"></path></svg>
    </div>
</section>

{{-- SECTION STATISTIQUES AVEC COMPTEURS ET SURVOL --}}
<section class="py-20 bg-gradient-to-r from-[#0a1a2e] to-[#1B3A6B] text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">CHIFFRES CLÉS</span>
            <h2 class="text-4xl md:text-5xl font-black mt-3" style="font-family:Georgia,serif">Ils nous font confiance</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:shadow-2xl cursor-default">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="1250">0</div>
                <p class="text-white/80 text-lg font-semibold">Utilisateurs actifs</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:shadow-2xl cursor-default">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="342">0</div>
                <p class="text-white/80 text-lg font-semibold">Objets retrouvés</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:shadow-2xl cursor-default">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="98">0</div>
                <p class="text-white/80 text-lg font-semibold">% de satisfaction</p>
            </div>
            <div class="stat-card bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:shadow-2xl cursor-default">
                <div class="text-5xl font-black text-[#C8992A] mb-2 counter" data-target="24">0</div>
                <p class="text-white/80 text-lg font-semibold">Heures de réponse</p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION COMMENT ÇA MARCHE --}}
<section class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
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
            @foreach($steps as $step)
                <div class="group relative bg-gray-50 rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-4 overflow-hidden cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $step['color'] }} opacity-0 group-hover:opacity-10 transition-opacity"></div>
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

{{-- SECTION POURQUOI NOUS CHOISIR --}}
<section class="py-28 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
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
            @foreach($reasons as $reason)
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 text-center group hover:-translate-y-2 cursor-pointer">
                    <div class="text-6xl mb-5 group-hover:scale-110 transition-transform inline-block">{{ $reason['icon'] }}</div>
                    <h3 class="text-xl font-black text-[#1B3A6B] mb-3 group-hover:text-[#C8992A] transition-colors">{{ $reason['title'] }}</h3>
                    <p class="text-gray-500 text-sm group-hover:text-gray-700">{{ $reason['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SECTION TÉMOIGNAGES --}}
<section class="py-28 bg-[#1B3A6B] text-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Témoignages</span>
        <h2 class="text-4xl md:text-5xl font-black mt-3 mb-12" style="font-family:Georgia,serif">Ils ont retrouvé leurs objets</h2>
        <div class="relative" id="testimonials-slider">
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

{{-- SECTION CTA FINALE --}}
<section class="py-28 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] rounded-3xl p-12 shadow-2xl transition-all duration-500 hover:shadow-3xl hover:scale-[1.02]">
            <h2 class="text-3xl md:text-5xl font-black text-white mb-4">Prêt à retrouver vos objets ?</h2>
            <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">Rejoignez des milliers d’utilisateurs dès aujourd’hui et ne perdez plus jamais vos biens.</p>
            <div class="flex flex-wrap justify-center gap-5">
                <a href="{{ route('register') }}" class="bg-[#C8992A] text-white font-extrabold px-8 py-4 rounded-xl hover:bg-[#b8861e] hover:-translate-y-1 transition-all duration-300 hover:shadow-xl hover:scale-105">CRÉER UN COMPTE GRATUIT</a>
                <a href="{{ route('objets.index') }}" class="bg-white text-[#1B3A6B] font-extrabold px-8 py-4 rounded-xl hover:bg-gray-100 hover:-translate-y-1 transition-all duration-300 hover:shadow-xl hover:scale-105">PARCOURIR LES OBJETS</a>
            </div>
        </div>
    </div>
</section>

{{-- SECTION FAQ ACCORDÉON --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-[#C8992A] font-black text-sm uppercase tracking-[0.2em]">Questions fréquentes</span>
            <h2 class="text-3xl md:text-4xl font-black text-[#1B3A6B] mt-3">Vous avez des questions ?</h2>
        </div>
        <div class="space-y-4" id="faq-accordion">
            @php
                $faqs = [
                    ['q' => 'Combien de temps faut-il pour retrouver un objet ?', 'a' => 'Le délai varie selon l’objet et la zone. En moyenne, 70% des objets sont retrouvés sous 7 jours.'],
                    ['q' => 'Est-ce que la déclaration est payante ?', 'a' => 'Non, notre service est entièrement gratuit pour les habitants de Dschang.'],
                    ['q' => 'Comment être sûr que mon objet me sera rendu ?', 'a' => 'Nous vérifions l’identité des déclarants et des trouveurs. Une pièce d’identité est exigée lors de la restitution.'],
                    ['q' => 'Puis-je déclarer un objet trouvé sans compte ?', 'a' => 'Oui, mais la création d’un compte vous permet de suivre votre déclaration et d’être alerté en cas de correspondance.'],
                ];
            @endphp
            @foreach($faqs as $faq)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <button class="faq-question w-full text-left px-6 py-4 font-bold text-[#1B3A6B] flex justify-between items-center hover:bg-gray-50 transition-colors group">
                        {{ $faq['q'] }}
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer px-6 pb-4 text-gray-600 text-sm hidden">{{ $faq['a'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SCRIPT UNIFIÉ (carrousel, compteurs, témoignages, FAQ) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ========== HERO CARROUSEL (identique à votre carousel.js) ==========
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

            function startAuto() {
                if (timer) clearInterval(timer);
                timer = setInterval(() => goTo(current + 1), 5000);
            }

            function stopAuto() {
                if (timer) clearInterval(timer);
            }

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

        // ========== COUNTERS (statistiques) ==========
        const counters = document.querySelectorAll('.counter');
        const animateCounters = () => {
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
        };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.5 });
        const statsSection = document.querySelector('.counter')?.closest('section');
        if (statsSection) observer.observe(statsSection);

        // ========== TÉMOIGNAGES SLIDER ==========
        const track = document.getElementById('testimonials-track');
        const prevTest = document.getElementById('testimonial-prev');
        const nextTest = document.getElementById('testimonial-next');
        if (track && prevTest && nextTest) {
            let testIndex = 0;
            const totalTest = track.children.length;
            const updateTest = () => {
                track.style.transform = `translateX(-${testIndex * 100}%)`;
            };
            prevTest.addEventListener('click', () => {
                testIndex = (testIndex - 1 + totalTest) % totalTest;
                updateTest();
            });
            nextTest.addEventListener('click', () => {
                testIndex = (testIndex + 1) % totalTest;
                updateTest();
            });
            updateTest();
        }

        // ========== FAQ ACCORDÉON ==========
        document.querySelectorAll('.faq-question').forEach(btn => {
            btn.addEventListener('click', () => {
                const answer = btn.nextElementSibling;
                const icon = btn.querySelector('svg');
                answer.classList.toggle('hidden');
                icon.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        });
    });
</script>
@endpush

@endsection