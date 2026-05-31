@extends('layouts.admin')

@section('title', 'Coffre-fort')
@section('breadcrumb', 'Coffre-fort')

@section('content')

    {{-- EN-TÊTE --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                🔒 Coffre-fort
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Liste complète des objets déposés — chaque consultation est journalisée
            </p>
        </div>
    </div>

    {{-- ALERTE JOURNALISATION --}}
    <div class="bg-[#FEF3C7] border border-[#F59E0B] border-l-4 border-l-[#C8992A]
                rounded-xl px-5 py-3 mb-6 flex items-center gap-3 text-[#92400E] text-[13.5px]">
        ℹ️ <p>Chaque consultation est <strong>tracée automatiquement</strong> dans le journal.</p>
    </div>

    {{-- MINI STATS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['📦', $stats['total'],    'Total',       '#2D5FA8'],
            ['⏳', $stats['attente'],  'En attente',  '#C8992A'],
            ['🔵', $stats['en_cours'], 'En cours',    '#7C3AED'],
            ['✅', $stats['restitue'], 'Restitués',   '#16A34A'],
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

    {{-- FILTRES --}}
    <form method="GET" action="{{ route('admin.coffre-fort') }}"
          class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                    Rechercher
                </label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nom, description..."
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                              text-[13.5px] outline-none focus:border-[#2D5FA8] transition"/>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                    Catégorie
                </label>
                <select name="categorie"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                               text-[13.5px] outline-none focus:border-[#2D5FA8]">
                    <option value="">Toutes</option>
                    @foreach(['electronique','document','sac','cle','vetement','bijou','autre'] as $cat)
                        <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                    Statut
                </label>
                <select name="statut"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                               text-[13.5px] outline-none focus:border-[#2D5FA8]">
                    <option value="">Tous</option>
                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>
                        En attente
                    </option>
                    <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>
                        En cours
                    </option>
                    <option value="restitue" {{ request('statut') == 'restitue' ? 'selected' : '' }}>
                        Restitué
                    </option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 bg-[#1B3A6B] text-white font-bold text-[13.5px]
                               py-2.5 rounded-xl hover:bg-[#14305a] transition">
                    🔍 Filtrer
                </button>
                <a href="{{ route('admin.coffre-fort') }}"
                   class="px-4 py-2.5 border border-gray-200 rounded-xl text-gray-500
                          hover:bg-gray-50 transition text-[13px]">
                    ↺
                </a>
            </div>

        </div>
    </form>

    {{-- TABLEAU --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-[13.5px]">
                <thead>
                    <tr class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8]">
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">#</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Objet</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Catégorie</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Lieu</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Date</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Inventeur</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Statut</th>
                        <th class="px-5 py-4 text-left text-white font-bold text-[11px]
                                   uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($objets as $objet)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-4 text-gray-400 font-mono text-[11px]">
                                #{{ str_pad($objet->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-[#EFF6FF] border border-[#DBEAFE]
                                                rounded-lg flex items-center justify-center text-lg">
                                        {{ $objet->categorie === 'electronique' ? '📱' :
                                           ($objet->categorie === 'sac'         ? '👜' :
                                           ($objet->categorie === 'cle'         ? '🔑' :
                                           ($objet->categorie === 'document'    ? '📄' : '📦'))) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $objet->nom }}</p>
                                        <p class="text-[11.5px] text-gray-400 truncate max-w-[200px]">
                                            {{ Str::limit($objet->description, 40) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-[11px] font-bold bg-[#DBEAFE] text-[#2D5FA8]
                                             px-2.5 py-1 rounded-full">
                                    {{ ucfirst($objet->categorie) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-gray-600">
                                📍 {{ $objet->lieu }}
                            </td>
                            <td class="px-5 py-4 text-gray-600 whitespace-nowrap">
                                📅 {{ $objet->date_decouverte->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-gray-800">{{ $objet->inventeur_nom }}</p>
                                <p class="text-[11.5px] text-gray-400">{{ $objet->inventeur_tel }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <form method="POST"
                                      action="{{ route('admin.coffre-fort.statut', $objet) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="statut" onchange="this.form.submit()"
                                            class="text-[11.5px] font-bold px-3 py-1.5 rounded-full
                                                   border-0 outline-none cursor-pointer
                                                   {{ $objet->statut === 'restitue'
                                                      ? 'bg-[#DCFCE7] text-[#16A34A]'
                                                      : ($objet->statut === 'en_cours'
                                                      ? 'bg-[#DBEAFE] text-[#2D5FA8]'
                                                      : 'bg-[#FEF3C7] text-[#92400E]') }}">
                                        <option value="en_attente"
                                                {{ $objet->statut === 'en_attente' ? 'selected' : '' }}>
                                            🟡 En attente
                                        </option>
                                        <option value="en_cours"
                                                {{ $objet->statut === 'en_cours' ? 'selected' : '' }}>
                                            🔵 En cours
                                        </option>
                                        <option value="restitue"
                                                {{ $objet->statut === 'restitue' ? 'selected' : '' }}>
                                            ✅ Restitué
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-5 py-4">
                                <a href="{{ route('admin.comparaison') }}"
                                   class="inline-flex items-center gap-1 bg-[#EDE9FE]
                                          text-[#7C3AED] text-[11.5px] font-bold
                                          px-3 py-1.5 rounded-lg hover:bg-[#7C3AED]
                                          hover:text-white transition">
                                    🔀 Comparer
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-14 text-center text-gray-400">
                                <p class="text-4xl mb-3">📭</p>
                                <p class="text-[14px]">Aucun objet dans le coffre-fort</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($objets->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $objets->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

@endsection