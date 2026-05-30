@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')

    {{-- EN-TÊTE PAGE --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                Tableau de bord
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Vue d'ensemble de la plateforme DschangLost
            </p>
        </div>
        <div class="text-[13px] text-gray-400 bg-white px-4 py-2 rounded-lg border border-gray-200">
            📅 {{ now()->format('d/m/Y à H:i') }}
        </div>
    </div>

    {{-- CARTES STATISTIQUES --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        {{-- Carte 1 --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                    hover:-translate-y-1 hover:shadow-md transition-all duration-200
                    relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-[#2D5FA8]"></div>
            <div class="w-12 h-12 bg-[#DBEAFE] rounded-xl flex items-center
                        justify-center text-2xl mb-3">📦</div>
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide">
                Objets trouvés
            </span>
            <span class="block text-3xl font-black text-[#1B3A6B] mt-1"
                  style="font-family:Georgia,serif">
                {{ $stats['objets_trouves'] }}
            </span>
            <span class="text-[11px] text-green-500 font-semibold">↑ Ce mois</span>
        </div>

        {{-- Carte 2 --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                    hover:-translate-y-1 hover:shadow-md transition-all duration-200
                    relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-[#C8992A]"></div>
            <div class="w-12 h-12 bg-[#FEF3C7] rounded-xl flex items-center
                        justify-center text-2xl mb-3">⚠️</div>
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide">
                Objets perdus
            </span>
            <span class="block text-3xl font-black text-[#1B3A6B] mt-1"
                  style="font-family:Georgia,serif">
                {{ $stats['objets_perdus'] }}
            </span>
            <span class="text-[11px] text-green-500 font-semibold">↑ Ce mois</span>
        </div>

        {{-- Carte 3 --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                    hover:-translate-y-1 hover:shadow-md transition-all duration-200
                    relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-[#16A34A]"></div>
            <div class="w-12 h-12 bg-[#DCFCE7] rounded-xl flex items-center
                        justify-center text-2xl mb-3">🤝</div>
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide">
                Restitués
            </span>
            <span class="block text-3xl font-black text-[#1B3A6B] mt-1"
                  style="font-family:Georgia,serif">
                {{ $stats['objets_restitues'] }}
            </span>
            <span class="text-[11px] text-green-500 font-semibold">↑ Ce mois</span>
        </div>

        {{-- Carte 4 --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                    hover:-translate-y-1 hover:shadow-md transition-all duration-200
                    relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-[#7C3AED]"></div>
            <div class="w-12 h-12 bg-[#EDE9FE] rounded-xl flex items-center
                        justify-center text-2xl mb-3">👥</div>
            <span class="block text-[11px] font-bold text-gray-500 uppercase tracking-wide">
                Utilisateurs
            </span>
            <span class="block text-3xl font-black text-[#1B3A6B] mt-1"
                  style="font-family:Georgia,serif">
                {{ $stats['utilisateurs'] }}
            </span>
            <span class="text-[11px] text-green-500 font-semibold">↑ Ce mois</span>
        </div>

    </div>

    {{-- GRILLE PRINCIPALE --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Activités récentes --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-[15px] font-black text-[#1B3A6B]">Activités récentes</h3>
                    <p class="text-[12px] text-gray-400">Derniers événements enregistrés</p>
                </div>
                <a href="{{ route('admin.journal') }}"
                   class="text-[#2D5FA8] text-[12.5px] font-semibold hover:underline">
                    Voir tout →
                </a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($journaux as $log)
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center
                                    flex-shrink-0 text-lg
                                    {{ $log->action === 'consultation' ? 'bg-[#DBEAFE]' :
                                       ($log->action === 'relation' ? 'bg-[#DCFCE7]' :
                                       ($log->action === 'notification' ? 'bg-[#FEF3C7]' : 'bg-[#EDE9FE]')) }}">
                            {{ $log->action === 'consultation' ? '👁️' :
                               ($log->action === 'relation' ? '🤝' :
                               ($log->action === 'notification' ? '🔔' : '✅')) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13.5px] text-gray-800 font-medium truncate">
                                {{ $log->detail }}
                            </p>
                            <span class="text-[11.5px] text-gray-400">
                                {{ $log->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <span class="text-[11px] font-bold px-3 py-1 rounded-full flex-shrink-0
                                     {{ $log->action === 'consultation' ? 'bg-[#DBEAFE] text-[#2D5FA8]' :
                                        ($log->action === 'relation' ? 'bg-[#DCFCE7] text-[#16A34A]' :
                                        ($log->action === 'notification' ? 'bg-[#FEF3C7] text-[#92400E]' :
                                        'bg-[#EDE9FE] text-[#7C3AED]')) }}">
                            {{ ucfirst($log->action) }}
                        </span>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-gray-400">
                        <p class="text-4xl mb-2">📋</p>
                        <p class="text-[13px]">Aucune activité pour le moment</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Objets en attente --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-[15px] font-black text-[#1B3A6B]">En attente</h3>
                    <p class="text-[12px] text-gray-400">À traiter en priorité</p>
                </div>
                <a href="{{ route('admin.coffre-fort') }}"
                   class="text-[#2D5FA8] text-[12.5px] font-semibold hover:underline">
                    Voir tout →
                </a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($objetsEnAttente as $objet)
                    <div class="flex items-center gap-3 px-5 py-4 hover:bg-gray-50 transition">
                        <div class="w-10 h-10 bg-[#EFF6FF] border border-[#DBEAFE] rounded-lg
                                    flex items-center justify-center text-xl flex-shrink-0">
                            {{ $objet->categorie === 'electronique' ? '📱' :
                               ($objet->categorie === 'sac' ? '👜' :
                               ($objet->categorie === 'cle' ? '🔑' :
                               ($objet->categorie === 'document' ? '📄' : '📦'))) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-bold text-gray-800 truncate">
                                {{ $objet->nom }}
                            </p>
                            <span class="text-[11.5px] text-gray-400">
                                📍 {{ $objet->lieu }}
                            </span>
                        </div>
                        <span class="text-[10.5px] font-bold bg-[#FEF3C7] text-[#92400E]
                                     px-2 py-1 rounded-full flex-shrink-0">
                            En attente
                        </span>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-gray-400">
                        <p class="text-4xl mb-2">✅</p>
                        <p class="text-[13px]">Aucun objet en attente</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- LIENS RAPIDES --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach([
            ['🔒', 'Coffre-fort', 'admin.coffre-fort'],
            ['🔀', 'Comparaison', 'admin.comparaison'],
            ['✉️', 'Demandes', 'admin.demandes'],
            ['🤝', 'Mise en relation', 'admin.mise-en-relation'],
            ['📜', 'Journal', 'admin.journal'],
            ['🌐', 'Voir le site', 'home'],
        ] as [$icon, $label, $route])
            <a href="{{ route($route) }}"
               class="bg-white rounded-xl p-4 text-center border border-gray-100 shadow-sm
                      hover:-translate-y-1 hover:shadow-md hover:border-[#2D5FA8] transition-all">
                <span class="text-2xl block mb-2">{{ $icon }}</span>
                <span class="text-[12px] font-bold text-[#1B3A6B]">{{ $label }}</span>
            </a>
        @endforeach
    </div>

@endsection