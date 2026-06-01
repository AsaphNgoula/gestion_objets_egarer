@extends('layouts.app')

@section('title', 'Objets trouvés')

@push('styles')
<style>
/* ===== ARRIÈRE-PLAN CHIC APPAISANT (SANS CLUTTER VISUEL) ===== */
.viewport-bg {
    background: #F8FAFC;
    background-image: radial-gradient(rgba(45, 95, 168, 0.05) 1px, transparent 1px);
    background-size: 24px 24px;
}

/* ===== ANIMATIONS AU SCROLL ===== */
.reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }

/* ===== CARTE OBJET ===== */
.object-card {
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(8px);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.object-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 30px 50px -15px rgba(27, 58, 107, 0.18);
}
.object-card:hover .object-icon {
    transform: scale(1.2) rotate(4deg);
    opacity: 0.9;
}
.object-icon {
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.object-card:hover .btn-claim {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px -6px rgba(27, 58, 107, 0.3);
}

/* ===== BOUTONS FILTRES ===== */
.filter-input {
    transition: all 0.2s ease;
}
.filter-input:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(45, 95, 168, 0.1);
}
.filter-select:hover, .filter-input:hover {
    border-color: #2D5FA8;
}

/* ===== PAGINATION STYLES ===== */
.pagination {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: center;
}
.pagination .page-item .page-link {
    background: white;
    border: 1px solid #e2e8f0;
    color: #1B3A6B;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 0.75rem;
    transition: all 0.2s;
}
.pagination .page-item.active .page-link {
    background: #1B3A6B;
    border-color: #1B3A6B;
    color: white;
}
.pagination .page-item .page-link:hover {
    background: #2D5FA8;
    border-color: #2D5FA8;
    color: white;
    transform: translateY(-2px);
}
</style>
@endpush

@section('content')
<div class="viewport-bg min-h-screen pb-12">

    {{-- HERO SECTION AVEC ANIMATION ET CAROUSEL INTERACTIF --}}
    <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b-4 border-[#C8992A] relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-64 h-64 bg-white/5 rounded-full -top-32 -right-32 animate-pulse"></div>
            <div class="absolute w-48 h-48 bg-[#C8992A]/10 rounded-full -bottom-24 -left-24 animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <div class="max-w-6xl mx-auto px-6 py-12 relative z-10 reveal visible">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center" 
                 x-data="{ 
                    activeSlide: 0, 
                    slides: [
                        {
                            url: '/images/image7.jpg',
                            title: 'Université de Dschang',
                            desc: 'Campus & Facultés au cœur de la ville'
                        },
                        {
                            url: '/images/Hotel_de_ville_de_Dschang.jpg',
                            title: 'Hôtel de Ville de Dschang',
                            desc: 'Secrétariat et services d\'audit d\'objets'
                        },
                        {
                            url: '/images/image8.jpg',
                            title: 'Régions de l\'Ouest / Marché',
                            desc: 'Points relais de rapprochement citoyen'
                        }
                    ],
                    next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
                    prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length },
                    init() { setInterval(() => { this.next() }, 5000) }
                 }">
                
                {{-- Côté Gauche : Titre & CTA --}}
                <div class="md:col-span-7 space-y-4">
                    <div class="flex items-center gap-2.5">
                        <span class="text-3xl animate-bounce" style="animation-duration: 3s">🔍</span>
                        <h1 class="text-white font-black text-3xl sm:text-4xl lg:text-5xl leading-tight" style="font-family:Georgia,serif">
                            Objets trouvés à Dschang
                        </h1>
                    </div>
                    <p class="text-white/80 text-sm sm:text-base max-w-xl leading-relaxed">
                        Parcourez en temps réel la liste des objets trouvés et enregistrés au sein du Coffre-fort d'audit de la ville de Dschang.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="{{ route('deposer') }}"
                           class="btn-animated inline-flex items-center gap-2 bg-[#C8992A] text-white font-extrabold text-xs uppercase tracking-wider px-6 py-3 rounded-xl shadow-lg transition-all hover:bg-[#b8861e] hover:-translate-y-0.5">
                            📦 J'ai trouvé un objet
                        </a>
                        <a href="#catalogue"
                           class="inline-flex items-center gap-2 border border-white/20 hover:border-white/50 bg-white/5 hover:bg-white/10 text-white font-extrabold text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition-all">
                            👁️ Parcourir l'inventaire
                        </a>
                    </div>
                </div>

                {{-- Côté Droit : Widget de Carrousel d'Images --}}
                <div class="md:col-span-5">
                    <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden border-4 border-white/10 shadow-2xl bg-slate-900/60 backdrop-blur-md group">
                        
                        {{-- Slides --}}
                        <template x-for="(slide, index) in slides" :key="index">
                            <div class="absolute inset-0 transition-all duration-700 ease-in-out"
                                 x-show="activeSlide === index"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-700"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-105">
                                
                                <img :src="slide.url" :alt="slide.title" class="w-full h-full object-cover select-none pointer-events-none opacity-80" />
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                                
                                <div class="absolute bottom-4 left-4 right-4 text-white z-10">
                                    <span class="inline-block bg-[#C8992A] text-white text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded mb-1">Dschang Focus</span>
                                    <h3 class="font-bold text-sm tracking-tight text-white mb-0.5" x-text="slide.title"></h3>
                                    <p class="text-[10.5px] text-white/75 line-clamp-1 leading-snug" x-text="slide.desc"></p>
                                </div>
                            </div>
                        </template>

                        {{-- Contrôles Flèches --}}
                        <button @click="prev()" class="absolute left-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-slate-900/50 hover:bg-slate-900/80 border border-white/10 text-white flex items-center justify-center text-sm transition opacity-0 group-hover:opacity-100 cursor-pointer z-20">
                            ‹
                        </button>
                        <button @click="next()" class="absolute right-2.5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-slate-900/50 hover:bg-slate-900/80 border border-white/10 text-white flex items-center justify-center text-sm transition opacity-0 group-hover:opacity-100 cursor-pointer z-20">
                            ›
                        </button>

                        {{-- Indicateurs de Pagination --}}
                        <div class="absolute bottom-3 right-4 flex gap-1.5 z-20">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button @click="activeSlide = index"
                                        class="w-2.5 h-1.5 rounded-full transition-all cursor-pointer"
                                        :class="activeSlide === index ? 'bg-[#C8992A] w-5' : 'bg-white/40 hover:bg-white/60'"></button>
                            </template>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-12">

        {{-- FILTRES AVEC ANIMATION --}}
        <form method="GET" action="{{ route('objets.index') }}"
              class="bg-white/95 backdrop-blur-md rounded-2xl border border-gray-100 shadow-md p-6 mb-10 reveal visible">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <div class="lg:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Recherche</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Rechercher un objet (téléphone, sac, clés...)"
                               class="filter-input w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:border-[#2D5FA8] transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Catégorie</label>
                    <select name="categorie"
                            class="filter-select w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:border-[#2D5FA8] bg-white text-gray-700">
                        <option value="">📦 Toutes catégories</option>
                        @foreach([
                            'electronique' => '📱 Électronique',
                            'document'     => '📄 Document',
                            'sac'          => '👜 Sac & Portefeuille',
                            'cle'          => '🔑 Clés',
                            'vetement'     => '👕 Vêtement',
                            'bijou'        => '💍 Bijou',
                            'autre'        => '📦 Autre',
                        ] as $val => $label)
                            <option value="{{ $val }}" {{ request('categorie') == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Lieu</label>
                    <select name="lieu"
                            class="filter-select w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm outline-none focus:border-[#2D5FA8] bg-white text-gray-700">
                        <option value="">📍 Tous les lieux</option>
                        @foreach([
                            'Marché A', 'Marché B', 'Centre Administratif',
                            'Hôtel de Ville', 'Campus UDo', 'Cité Universitaire',
                            'Foto', 'Route de Bafoussam', 'Carrefour Fongé',
                            'Gare Routière'
                        ] as $lieu)
                            <option value="{{ $lieu }}" {{ request('lieu') == $lieu ? 'selected' : '' }}>{{ $lieu }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mt-6">
                <button type="submit"
                        class="bg-[#1B3A6B] text-white font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-[#14305a] transition-all hover:-translate-y-0.5 flex items-center gap-2 shadow-md">
                    🔍 Rechercher
                </button>
                @if(request('search') || request('categorie') || request('lieu'))
                    <a href="{{ route('objets.index') }}"
                       class="border border-gray-300 text-gray-600 font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-gray-50 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                        ↺ Réinitialiser
                    </a>
                @endif
            </div>
        </form>

        {{-- EN-TÊTE RÉSULTATS --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6 reveal visible">
            <p class="text-slate-600 text-sm">
                <strong class="text-[#1B3A6B] text-lg">{{ $objets->total() }}</strong>
                objet(s) trouvé(s)
            </p>
            <a href="{{ route('deposer') }}"
               class="inline-flex items-center gap-2 bg-[#C8992A] text-white font-bold text-sm px-5 py-2 rounded-xl hover:bg-[#b8861e] transition-all hover:-translate-y-0.5 shadow-md">
                📦 J'ai trouvé un objet
            </a>
        </div>

        {{-- GRILLE DES OBJETS --}}
        @if($objets->isEmpty())
            <div class="bg-white/90 backdrop-blur-md rounded-2xl border border-gray-100 shadow-sm py-16 text-center reveal visible">
                <div class="text-6xl mb-4 opacity-50">📭</div>
                <h3 class="text-[#1B3A6B] font-black text-2xl mb-2">Aucun objet trouvé</h3>
                <p class="text-gray-400 text-sm mb-6">Aucun objet ne correspond à votre recherche.</p>
                <a href="{{ route('deposer') }}"
                   class="inline-flex items-center gap-2 bg-[#C8992A] text-white font-bold text-sm px-6 py-3 rounded-xl hover:bg-[#b8861e] transition-all hover:-translate-y-0.5">
                    📦 Déposer un objet trouvé
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($objets as $index => $objet)
                    <div class="object-card rounded-2xl border border-gray-100/50 shadow-sm overflow-hidden reveal visible">
                        {{-- Image / Icône --}}
                        <div class="relative h-44 bg-gradient-to-br from-[#EFF6FF] to-[#DBEAFE] flex items-center justify-center overflow-hidden">
                            <span class="object-icon text-7xl opacity-70">
                                @php
                                    $iconMap = [
                                        'electronique' => '📱', 'sac' => '👜', 'cle' => '🔑',
                                        'document' => '📄', 'vetement' => '👕', 'bijou' => '💍', 'autre' => '📦'
                                    ];
                                    echo $iconMap[$objet->categorie] ?? '📦';
                                @endphp
                            </span>

                            {{-- Badge catégorie --}}
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[#2D5FA8] text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ ucfirst($objet->categorie) }}
                            </span>

                            {{-- Badge statut --}}
                            <span class="absolute top-3 right-3 text-xs font-bold px-3 py-1 rounded-full shadow-sm
                                         {{ $objet->statut === 'en_cours' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $objet->statut === 'en_cours' ? '🔵 En cours' : '🟡 Disponible' }}
                            </span>
                        </div>

                        {{-- Détails --}}
                        <div class="p-5">
                            <h3 class="font-black text-[#1B3A6B] text-base mb-2 line-clamp-1">{{ $objet->nom }}</h3>
                            <p class="text-gray-500 text-xs mb-3 line-clamp-2 leading-relaxed">{{ $objet->description }}</p>
                            <div class="flex flex-col gap-1 mb-4">
                                <span class="text-xs text-gray-400 flex items-center gap-1">📍 {{ $objet->lieu }}</span>
                                <span class="text-xs text-gray-400 flex items-center gap-1">📅 {{ $objet->date_decouverte->format('d/m/Y') }}</span>
                            </div>

                            @auth
                                <a href="{{ route('proprietaire.assistance') }}"
                                   class="btn-claim w-full flex items-center justify-center gap-2 bg-[#1B3A6B] text-white font-bold text-xs py-2.5 rounded-xl transition-all hover:bg-[#14305a]">
                                    🤝 C'est le mien !
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="btn-claim w-full flex items-center justify-center gap-2 border-2 border-[#1B3A6B] text-[#1B3A6B] font-bold text-xs py-2.5 rounded-xl transition-all hover:bg-[#1B3A6B] hover:text-white">
                                    🔑 Se connecter pour réclamer
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION AVEC STYLE --}}
            @if($objets->hasPages())
                <div class="flex justify-center mt-8 reveal visible">
                    {{ $objets->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ========== REVEAL ON SCROLL ==========
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -20px 0px' });

        revealElements.forEach(el => observer.observe(el));

        // ========== RIPPLE EFFECT ON BUTTONS (optionnel) ==========
        const buttons = document.querySelectorAll('.btn-animated, .btn-claim, .bg-\\[\\#1B3A6B\\], .bg-\\[\\#C8992A\\]');
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
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
<style>
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        transform: scale(0);
        animation: ripple-anim 0.6s linear;
        pointer-events: none;
    }
    @keyframes ripple-anim {
        to { transform: scale(4); opacity: 0; }
    }
    .btn-animated, .btn-claim, .bg-\[\\#1B3A6B\], .bg-\[\\#C8992A\] {
        position: relative;
        overflow: hidden;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
