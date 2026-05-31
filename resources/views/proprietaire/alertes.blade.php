@extends('layouts.app')

@section('title', 'Mes alertes')

@section('content')

    {{-- PAGE HERO --}}
    <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b-4 border-[#C8992A]">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <a href="{{ route('proprietaire.dashboard') }}"
                           class="text-white/60 hover:text-white text-[13px] transition">
                            ← Mon espace
                        </a>
                        <span class="text-white/30">›</span>
                        <span class="text-white/80 text-[13px]">Mes alertes</span>
                    </div>
                    <h1 class="text-white font-black text-2xl sm:text-3xl"
                        style="font-family:Georgia,serif">
                        🔔 Mes alertes
                    </h1>
                    <p class="text-white/65 text-[14px] mt-1">
                        Suivez le statut de toutes vos déclarations
                    </p>
                </div>
                <a href="{{ route('proprietaire.declarer') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white font-bold
                          text-[14px] px-6 py-3 rounded-xl shadow-lg
                          hover:bg-[#b8861e] hover:-translate-y-0.5 transition-all">
                    ➕ Nouvelle déclaration
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- MESSAGES --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl px-5 py-3 mb-6
                        flex items-center gap-3 text-green-700 text-[13.5px]">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- MINI STATS --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            @foreach([
                ['📋', $declarations->count(),                              'Total',       '#2D5FA8'],
                ['🟡', $declarations->where('statut','en_attente')->count(),'En attente',  '#C8992A'],
                ['🔵', $declarations->where('statut','en_cours')->count(),  'En cours',    '#2D5FA8'],
                ['✅', $declarations->where('statut','retrouve')->count(),  'Retrouvés',   '#16A34A'],
            ] as [$icon, $count, $label, $color])
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm
                            relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1"
                         style="background:{{ $color }}"></div>
                    <span class="text-2xl block mb-2">{{ $icon }}</span>
                    <span class="block text-3xl font-black text-[#1B3A6B]"
                          style="font-family:Georgia,serif">
                        {{ $count }}
                    </span>
                    <span class="text-[12px] text-gray-500">{{ $label }}</span>
                </div>
            @endforeach
        </div>

        {{-- LISTE DES DÉCLARATIONS --}}
        @if($declarations->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        py-16 text-center">
                <p class="text-5xl mb-4">📭</p>
                <h3 class="text-[#1B3A6B] font-black text-xl mb-2">
                    Aucune déclaration
                </h3>
                <p class="text-gray-400 text-[14px] mb-6">
                    Vous n'avez pas encore déclaré d'objet perdu.
                </p>
                <a href="{{ route('proprietaire.declarer') }}"
                   class="inline-flex items-center gap-2 bg-[#1B3A6B] text-white
                          font-bold text-[14px] px-8 py-3 rounded-xl
                          hover:bg-[#14305a] transition">
                    ➕ Faire ma première déclaration
                </a>
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach($declarations as $dec)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                                overflow-hidden hover:shadow-md transition-all duration-200
                                {{ $dec->statut === 'retrouve' ? 'border-l-4 border-l-[#16A34A]' :
                                   ($dec->statut === 'en_cours' ? 'border-l-4 border-l-[#2D5FA8]' :
                                   'border-l-4 border-l-[#C8992A]') }}">

                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-start
                                        justify-between gap-4">

                                {{-- Infos principales --}}
                                <div class="flex items-start gap-4 flex-1">
                                    <div class="w-12 h-12 rounded-xl flex items-center
                                                justify-center text-2xl flex-shrink-0
                                                {{ $dec->statut === 'retrouve' ? 'bg-[#DCFCE7]' :
                                                   ($dec->statut === 'en_cours' ? 'bg-[#DBEAFE]' :
                                                   'bg-[#FEF3C7]') }}">
                                        {{ $dec->categorie === 'electronique' ? '📱' :
                                           ($dec->categorie === 'sac'         ? '👜' :
                                           ($dec->categorie === 'cle'         ? '🔑' :
                                           ($dec->categorie === 'document'    ? '📄' :
                                           ($dec->categorie === 'vetement'    ? '👕' :
                                           ($dec->categorie === 'bijou'       ? '💍' : '📦'))))) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <h3 class="text-[#1B3A6B] font-black text-[16px]">
                                                {{ $dec->nom ?? $dec->categorie }}
                                            </h3>
                                            @if($dec->marque)
                                                <span class="text-[11px] bg-[#EFF6FF] text-[#2D5FA8]
                                                             font-bold px-2 py-0.5 rounded-full">
                                                    {{ $dec->marque }}
                                                </span>
                                            @endif
                                            @if($dec->couleur)
                                                <span class="text-[11px] bg-gray-100 text-gray-600
                                                             font-bold px-2 py-0.5 rounded-full">
                                                    {{ $dec->couleur }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-gray-500 text-[13px] mb-3 line-clamp-2">
                                            {{ $dec->description }}
                                        </p>
                                        <div class="flex flex-wrap gap-4 text-[12px] text-gray-400">
                                            <span class="flex items-center gap-1">
                                                📍 {{ $dec->lieu }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                📅 {{ $dec->date_perte->format('d/m/Y') }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                🕐 Déclaré {{ $dec->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Statut + Actions --}}
                                <div class="flex flex-row sm:flex-col items-center
                                            sm:items-end gap-3">
                                    <span class="text-[12px] font-bold px-4 py-2 rounded-full
                                                 {{ $dec->statut === 'retrouve'
                                                    ? 'bg-[#DCFCE7] text-[#16A34A]'
                                                    : ($dec->statut === 'en_cours'
                                                    ? 'bg-[#DBEAFE] text-[#2D5FA8]'
                                                    : 'bg-[#FEF3C7] text-[#92400E]') }}">
                                        {{ $dec->statut === 'retrouve' ? '✅ Retrouvé' :
                                           ($dec->statut === 'en_cours' ? '🔵 En cours' :
                                           '🟡 En attente') }}
                                    </span>
                                    <a href="{{ route('proprietaire.assistance') }}"
                                       class="text-[12px] text-[#2D5FA8] font-semibold
                                              hover:underline flex items-center gap-1">
                                        💬 Demander de l'aide
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection