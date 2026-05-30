@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="dashboard" x-data="dashboardModule()" x-init="init()">
    {{-- EN-TÊTE AVEC ILLUSTRATION --}}
    <div class="relative bg-gradient-to-br from-[#0a1a2e] via-[#1B3A6B] to-[#2D5FA8] overflow-hidden">
        <!-- Formes décoratives -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#C8992A] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-10"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="text-white space-y-4 animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm">
                        <i class="fas fa-crown text-[#C8992A]"></i>
                        <span>Espace personnel</span>
                    </div>
                    <h1 class="text-3xl lg:text-5xl font-black leading-tight">
                        Bonjour, {{ Auth::user()->name }}
                    </h1>
                    <p class="text-white/70 text-lg max-w-md">
                        Gérez vos objets perdus, suivez l’avancement de vos déclarations et recevez des alertes en temps réel.
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="{{ route('proprietaire.declarer') }}"
                           class="inline-flex items-center gap-2 bg-[#C8992A] hover:bg-[#b8861e] text-white font-bold px-6 py-3 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <i class="fas fa-plus-circle"></i> Nouvelle déclaration
                        </a>
                        <a href="{{ route('proprietaire.alertes') }}"
                           class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300">
                            <i class="fas fa-bell"></i> Voir mes alertes
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block animate-float">
                    <div class="relative w-64 h-64 bg-white/5 rounded-full backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-box-open text-7xl text-[#C8992A] opacity-80"></i>
                        <div class="absolute -top-2 -right-2 w-12 h-12 bg-[#C8992A] rounded-full flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-plus text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vague décorative -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-8 lg:h-12">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white" class="fill-white"></path>
            </svg>
        </div>
    </div>

    {{-- MESSAGES FLASH --}}
    @if(session('success'))
        <div class="fixed top-24 right-6 z-50 animate-slide-in-right" x-init="setTimeout(() => $el.remove(), 5000)">
            <div class="bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-6 py-12">
        {{-- SECTION STATISTIQUES AVEC COMPTEURS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @php
                $total = $declarations->count();
                $enAttente = $declarations->where('statut', 'en_attente')->count();
                $enCours = $declarations->where('statut', 'en_cours')->count();
                $retrouves = $declarations->where('statut', 'retrouve')->count();
            @endphp

            <div class="stat-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wider">Total</p>
                            <p class="text-4xl font-black text-gray-800 mt-2" x-ref="totalCount">0</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
                        <i class="fas fa-archive"></i>
                        <span>Déclarations enregistrées</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wider">En attente</p>
                            <p class="text-4xl font-black text-yellow-600 mt-2" x-ref="pendingCount">0</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
                        <i class="fas fa-hourglass-half"></i>
                        <span>En cours de traitement</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wider">En cours</p>
                            <p class="text-4xl font-black text-blue-600 mt-2" x-ref="progressCount">0</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <i class="fas fa-spinner fa-pulse text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
                        <i class="fas fa-search"></i>
                        <span>Investigation en cours</span>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-400 text-sm uppercase tracking-wider">Retrouvés</p>
                            <p class="text-4xl font-black text-green-600 mt-2" x-ref="foundCount">0</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform">
                            <i class="fas fa-check-double text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
                        <i class="fas fa-trophy"></i>
                        <span>Objets restitués</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION PRINCIPALE : LISTE + GRAPHIQUE --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Liste des déclarations récentes -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/40 flex justify-between items-center">
                    <div>
                        <h3 class="font-black text-gray-800 flex items-center gap-2">
                            <i class="fas fa-history text-[#C8992A]"></i> Dernières activités
                        </h3>
                        <p class="text-xs text-gray-400">Vos 5 dernières déclarations</p>
                    </div>
                    <a href="{{ route('proprietaire.alertes') }}" class="text-sm text-[#2D5FA8] hover:underline flex items-center gap-1">
                        Toutes <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                @if($declarations->isEmpty())
                    <div class="py-20 text-center">
                        <div class="text-6xl mb-4 opacity-30">📦</div>
                        <p class="text-gray-500 font-medium">Aucune déclaration pour le moment</p>
                        <a href="{{ route('proprietaire.declarer') }}" class="inline-block mt-4 bg-[#1B3A6B] text-white px-5 py-2 rounded-xl text-sm hover:bg-[#14305a] transition">
                            + Créer ma première déclaration
                        </a>
                    </div>
                else
                    <div class="divide-y divide-gray-100">
                        @foreach($declarations->take(5) as $dec)
                            <div class="p-5 hover:bg-gray-50 transition-all duration-200 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                                {{ $dec->statut === 'retrouve' ? 'bg-green-100' : ($dec->statut === 'en_cours' ? 'bg-blue-100' : 'bg-yellow-100') }}">
                                        <i class="fas {{ $dec->categorie === 'electronique' ? 'fa-laptop' : ($dec->categorie === 'sac' ? 'fa-bag-shopping' : ($dec->categorie === 'cle' ? 'fa-key' : ($dec->categorie === 'document' ? 'fa-file-alt' : 'fa-box'))) }}
                                           {{ $dec->statut === 'retrouve' ? 'text-green-600' : ($dec->statut === 'en_cours' ? 'text-blue-600' : 'text-yellow-600') }}"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-wrap justify-between items-start gap-2">
                                            <h4 class="font-bold text-gray-800 group-hover:text-[#1B3A6B] transition">{{ $dec->nom }}</h4>
                                            <span class="text-xs px-2 py-0.5 rounded-full {{ $dec->statut === 'retrouve' ? 'bg-green-100 text-green-700' : ($dec->statut === 'en_cours' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                                                {{ $dec->statut === 'retrouve' ? 'Retrouvé' : ($dec->statut === 'en_cours' ? 'En cours' : 'En attente') }}
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500 mt-1">
                                            <span><i class="fas fa-map-marker-alt mr-1"></i> {{ $dec->lieu }}</span>
                                            <span><i class="far fa-calendar-alt mr-1"></i> {{ $dec->date_perte->format('d/m/Y') }}</span>
                                            <span><i class="far fa-clock mr-1"></i> {{ $dec->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Carte de synthèse graphique -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-black text-gray-800 flex items-center gap-2 mb-5">
                    <i class="fas fa-chart-pie text-[#C8992A]"></i> Répartition des statuts
                </h3>
                <div class="space-y-5">
                    @php
                        $total = max($total, 1); // éviter division par zéro
                        $percentPending = round(($enAttente / $total) * 100);
                        $percentProgress = round(($enCours / $total) * 100);
                        $percentFound = round(($retrouves / $total) * 100);
                    @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span><i class="fas fa-clock text-yellow-500"></i> En attente</span>
                            <span class="font-mono font-bold">{{ $enAttente }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-500 rounded-full transition-all duration-1000" style="width: 0%" x-ref="barPending"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span><i class="fas fa-spinner fa-pulse text-blue-500"></i> En cours</span>
                            <span class="font-mono font-bold">{{ $enCours }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full transition-all duration-1000" style="width: 0%" x-ref="barProgress"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span><i class="fas fa-check-circle text-green-500"></i> Retrouvés</span>
                            <span class="font-mono font-bold">{{ $retrouves }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 rounded-full transition-all duration-1000" style="width: 0%" x-ref="barFound"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 text-center">
                    <div class="inline-flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-full">
                        <i class="fas fa-chart-line text-[#C8992A]"></i>
                        <span class="text-sm text-gray-600">Taux de résolution</span>
                        <span class="font-bold text-green-600">{{ $percentFound }}%</span>
                    </div>
                </div>
                <!-- Widget de progression supplémentaire -->
                <div class="mt-5 text-center">
                    <p class="text-xs text-gray-400">Mise à jour automatique en temps réel</p>
                </div>
            </div>
        </div>

        {{-- SECTION ACTIONS RAPIDES AVEC EFFETS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('proprietaire.declarer') }}" class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-amber-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <i class="fas fa-pen-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-800 group-hover:text-amber-600 transition">Déclarer une perte</h4>
                        <p class="text-sm text-gray-500">Signalez un objet perdu en quelques clics</p>
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                    <i class="fas fa-arrow-right text-amber-600"></i>
                </div>
            </a>

            <a href="{{ route('proprietaire.alertes') }}" class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bell text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-800 group-hover:text-blue-600 transition">Suivi des alertes</h4>
                        <p class="text-sm text-gray-500">Consultez l’évolution de vos dossiers</p>
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                    <i class="fas fa-arrow-right text-blue-600"></i>
                </div>
            </a>

            <a href="{{ route('proprietaire.assistance') }}" class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-emerald-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="p-6 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-800 group-hover:text-emerald-600 transition">Support & aide</h4>
                        <p class="text-sm text-gray-500">Contactez l’équipe administrateur</p>
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                    <i class="fas fa-arrow-right text-emerald-600"></i>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- Styles spécifiques --}}
@push('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.7s ease-out forwards;
    }
    .animate-slide-in-right {
        animation: slideInRight 0.4s ease-out forwards;
    }
    .animate-float {
        animation: float 4s ease-in-out infinite;
    }
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function dashboardModule() {
        return {
            init() {
                // Définition des valeurs depuis PHP (injectées)
                const total = {{ $total }};
                const pending = {{ $enAttente }};
                const progress = {{ $enCours }};
                const found = {{ $retrouves }};
                const percentPending = {{ $percentPending }};
                const percentProgress = {{ $percentProgress }};
                const percentFound = {{ $percentFound }};

                // Animation des compteurs
                this.animateNumber(this.$refs.totalCount, total, 1000);
                this.animateNumber(this.$refs.pendingCount, pending, 800);
                this.animateNumber(this.$refs.progressCount, progress, 800);
                this.animateNumber(this.$refs.foundCount, found, 800);

                // Animation des barres de progression
                setTimeout(() => {
                    if (this.$refs.barPending) this.$refs.barPending.style.width = percentPending + '%';
                    if (this.$refs.barProgress) this.$refs.barProgress.style.width = percentProgress + '%';
                    if (this.$refs.barFound) this.$refs.barFound.style.width = percentFound + '%';
                }, 200);
            },
            animateNumber(element, target, duration) {
                if (!element) return;
                let start = 0;
                const step = (timestamp) => {
                    if (!start) start = timestamp;
                    const elapsed = timestamp - start;
                    const progress = Math.min(elapsed / duration, 1);
                    const current = Math.floor(progress * target);
                    element.innerText = current.toLocaleString();
                    if (progress < 1) requestAnimationFrame(step);
                    else element.innerText = target.toLocaleString();
                };
                requestAnimationFrame(step);
            }
        }
    }
</script>
@endpush
@endsection