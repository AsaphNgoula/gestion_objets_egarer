@extends('layouts.admin')

@section('title', 'Mise en relation')
@section('breadcrumb', 'Mise en relation')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                🤝 Mise en relation
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Gérez les correspondances entre inventeurs et propriétaires
            </p>
        </div>
    </div>

    {{-- ALERTE SÉCURITÉ --}}
    <div class="bg-[#ECFDF5] border border-[#6EE7B7] border-l-4 border-l-[#16A34A]
                rounded-xl px-5 py-4 mb-6 flex items-start gap-3">
        <span class="text-xl flex-shrink-0">🛡️</span>
        <div>
            <strong class="text-[#065F46] text-[14px] block">Mise en relation sécurisée</strong>
            <p class="text-[#047857] text-[13px]">
                Les coordonnées des inventeurs et des propriétaires ne sont jamais
                exposées l'une à l'autre. Seul l'administrateur fait le lien.
            </p>
        </div>
    </div>

    {{-- MINI STATS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['⏳', $stats['attente'],  'En attente', '#C8992A'],
            ['🔵', $stats['cours'],    'En cours',   '#2D5FA8'],
            ['✅', $stats['confirme'], 'Confirmées', '#7C3AED'],
            ['🤝', $stats['restitue'], 'Restituées', '#16A34A'],
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

    {{-- LISTE DES MISES EN RELATION --}}
    <div class="flex flex-col gap-4">
        @forelse($relations as $rel)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden
                        {{ $rel->statut === 'restitue'
                           ? 'border-l-4 border-l-[#16A34A]'
                           : ($rel->statut === 'confirme'
                           ? 'border-l-4 border-l-[#7C3AED]'
                           : ($rel->statut === 'en_cours'
                           ? 'border-l-4 border-l-[#2D5FA8]'
                           : 'border-l-4 border-l-[#C8992A]')) }}">

                {{-- En-tête carte --}}
                <div class="flex items-center justify-between px-6 py-3
                            bg-gray-50 border-b border-gray-100">
                    <span class="text-[12px] font-bold text-gray-500 font-mono">
                        MER-{{ str_pad($rel->id, 3, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="flex items-center gap-3">
                        <span class="text-[11px] text-gray-400">
                            {{ $rel->created_at->format('d/m/Y') }}
                        </span>
                        <span class="text-[11.5px] font-bold px-3 py-1 rounded-full
                                     {{ $rel->statut === 'restitue'
                                        ? 'bg-[#DCFCE7] text-[#16A34A]'
                                        : ($rel->statut === 'confirme'
                                        ? 'bg-[#EDE9FE] text-[#7C3AED]'
                                        : ($rel->statut === 'en_cours'
                                        ? 'bg-[#DBEAFE] text-[#2D5FA8]'
                                        : 'bg-[#FEF3C7] text-[#92400E]')) }}">
                            {{ $rel->statut === 'restitue' ? '🤝 Restitué' :
                               ($rel->statut === 'confirme' ? '✅ Confirmé' :
                               ($rel->statut === 'en_cours' ? '🔵 En cours' :
                               '⏳ En attente')) }}
                        </span>
                    </div>
                </div>

                {{-- Corps --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0
                            sm:divide-x divide-gray-100">

                    {{-- Objet trouvé --}}
                    <div class="p-5">
                        <span class="text-[10px] font-bold text-[#2D5FA8] uppercase
                                     tracking-wider block mb-3">
                            📦 Objet trouvé
                        </span>
                        @if($rel->objetTrouve)
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-[#EFF6FF] rounded-lg flex items-center
                                            justify-center text-lg flex-shrink-0">
                                    {{ $rel->objetTrouve->categorie === 'electronique' ? '📱' :
                                       ($rel->objetTrouve->categorie === 'sac'         ? '👜' :
                                       ($rel->objetTrouve->categorie === 'cle'         ? '🔑' : '📦')) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-[13.5px]">
                                        {{ $rel->objetTrouve->nom }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-400">
                                        📍 {{ $rel->objetTrouve->lieu }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-400">
                                        👤 {{ $rel->objetTrouve->inventeur_nom }}
                                        · {{ $rel->objetTrouve->inventeur_tel }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Flèche centrale --}}
                    <div class="flex items-center justify-center p-5">
                        <div class="flex flex-col items-center gap-2">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#1B3A6B]
                                        to-[#2D5FA8] rounded-full flex items-center
                                        justify-center text-white text-xl shadow-lg">
                                ↔️
                            </div>
                            <span class="text-[11px] font-bold text-[#16A34A]
                                         bg-[#DCFCE7] px-3 py-1 rounded-full">
                                Correspondance
                            </span>
                        </div>
                    </div>

                    {{-- Propriétaire --}}
                    <div class="p-5">
                        <span class="text-[10px] font-bold text-[#92400E] uppercase
                                     tracking-wider block mb-3">
                            👤 Propriétaire
                        </span>
                        @if($rel->declaration && $rel->declaration->user)
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-[#1B3A6B] rounded-full flex items-center
                                            justify-center text-white font-black text-[14px]
                                            flex-shrink-0">
                                    {{ substr($rel->declaration->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-[13.5px]">
                                        {{ $rel->declaration->user->name }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-400">
                                        ✉️ {{ $rel->declaration->user->email }}
                                    </p>
                                    <p class="text-[11.5px] text-gray-400">
                                        📞 {{ $rel->declaration->user->phone ?? '—' }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Actions --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50
                            flex flex-wrap gap-3">

                    {{-- Changer statut --}}
                    @if($rel->statut !== 'restitue')
                        <form method="POST"
                              action="{{ route('admin.mise-en-relation.statut', $rel) }}">
                            @csrf @method('PATCH')
                            <div class="flex items-center gap-2">
                                <select name="statut"
                                        class="text-[12.5px] border border-gray-200 rounded-lg
                                               px-3 py-2 outline-none focus:border-[#2D5FA8]">
                                    <option value="en_cours"
                                            {{ $rel->statut === 'en_cours' ? 'selected' : '' }}>
                                        🔵 En cours
                                    </option>
                                    <option value="confirme"
                                            {{ $rel->statut === 'confirme' ? 'selected' : '' }}>
                                        ✅ Confirmer
                                    </option>
                                    <option value="restitue">
                                        🤝 Marquer restitué
                                    </option>
                                </select>
                                <button type="submit"
                                        class="bg-[#1B3A6B] text-white font-bold text-[12.5px]
                                               px-4 py-2 rounded-lg hover:bg-[#14305a] transition">
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    @else
                        <span class="text-[13px] text-[#16A34A] font-bold flex items-center gap-2">
                            🎉 Objet restitué avec succès !
                        </span>
                    @endif

                </div>

            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        py-16 text-center text-gray-400">
                <p class="text-5xl mb-4">🤝</p>
                <h3 class="text-[#1B3A6B] font-black text-xl mb-2">
                    Aucune mise en relation
                </h3>
                <p class="text-[14px] mb-6">
                    Utilisez la page Comparaison pour créer des mises en relation.
                </p>
                <a href="{{ route('admin.comparaison') }}"
                   class="inline-flex items-center gap-2 bg-[#1B3A6B] text-white
                          font-bold text-[14px] px-8 py-3 rounded-xl
                          hover:bg-[#14305a] transition">
                    🔀 Aller à la Comparaison
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($relations->hasPages())
        <div class="mt-6">{{ $relations->links() }}</div>
    @endif

@endsection