@extends('layouts.admin')

@section('title', 'Comparaison')
@section('breadcrumb', 'Comparaison')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">
                🔀 Comparaison
            </h1>
            <p class="text-gray-500 text-[14px] mt-1">
                Comparez les objets trouvés avec les déclarations de perte
            </p>
        </div>
    </div>

    {{-- FILTRES --}}
    <form method="GET" action="{{ route('admin.comparaison') }}"
          class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                    Catégorie
                </label>
                <select name="categorie"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                               text-[13.5px] outline-none focus:border-[#2D5FA8]">
                    <option value="">Toutes les catégories</option>
                    @foreach([
                        'electronique' => 'Électronique',
                        'document'     => 'Document',
                        'sac'          => 'Sac & Portefeuille',
                        'cle'          => 'Clés',
                        'vetement'     => 'Vêtement',
                        'bijou'        => 'Bijou',
                        'autre'        => 'Autre',
                    ] as $val => $label)
                        <option value="{{ $val }}"
                                {{ request('categorie') == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                    Lieu
                </label>
                <select name="lieu"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                               text-[13.5px] outline-none focus:border-[#2D5FA8]">
                    <option value="">Tous les lieux</option>
                    @foreach([
                        'Marché A', 'Marché B', 'Campus UDo',
                        'Carrefour Fongé', 'Gare Routière', 'Hôtel de Ville'
                    ] as $lieu)
                        <option value="{{ $lieu }}"
                                {{ request('lieu') == $lieu ? 'selected' : '' }}>
                            {{ $lieu }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 bg-[#1B3A6B] text-white font-bold text-[13.5px]
                               py-2.5 rounded-xl hover:bg-[#14305a] transition">
                    🔍 Comparer
                </button>
                <a href="{{ route('admin.comparaison') }}"
                   class="px-4 py-2.5 border border-gray-200 rounded-xl
                          text-gray-500 hover:bg-gray-50 transition text-[13px]">
                    ↺
                </a>
            </div>

        </div>
    </form>

    {{-- RÉSUMÉ --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <span class="text-3xl font-black text-[#16A34A] block"
                  style="font-family:Georgia,serif">
                {{ $correspondances }}
            </span>
            <span class="text-[12px] text-gray-500">✅ Correspondances</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <span class="text-3xl font-black text-[#2D5FA8] block"
                  style="font-family:Georgia,serif">
                {{ $objets->count() }}
            </span>
            <span class="text-[12px] text-gray-500">📦 Objets trouvés</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <span class="text-3xl font-black text-[#C8992A] block"
                  style="font-family:Georgia,serif">
                {{ $pertes->count() }}
            </span>
            <span class="text-[12px] text-gray-500">⚠️ Déclarations de perte</span>
        </div>
    </div>

    {{-- VUE CÔTE À CÔTE --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- COLONNE GAUCHE : Objets trouvés --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] px-5 py-4
                        flex items-center justify-between">
                <h3 class="text-white font-black text-[14px]">📦 Objets trouvés</h3>
                <span class="bg-white/20 text-white text-[11px] font-bold
                             px-3 py-1 rounded-full">
                    {{ $objets->count() }}
                </span>
            </div>
            <div class="divide-y divide-gray-50 max-h-[600px] overflow-y-auto">
                @forelse($objets as $objet)
                    <div class="p-4 hover:bg-[#EFF6FF] transition cursor-pointer
                                {{ $pertes->where('categorie', $objet->categorie)
                                          ->where('lieu', $objet->lieu)->count()
                                   ? 'border-l-4 border-l-[#16A34A]' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-[#EFF6FF] border border-[#DBEAFE]
                                        rounded-lg flex items-center justify-center
                                        text-lg flex-shrink-0">
                                {{ $objet->categorie === 'electronique' ? '📱' :
                                   ($objet->categorie === 'sac'         ? '👜' :
                                   ($objet->categorie === 'cle'         ? '🔑' :
                                   ($objet->categorie === 'document'    ? '📄' : '📦'))) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-800 text-[13.5px]">
                                    {{ $objet->nom }}
                                </p>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    <span class="text-[11px] bg-[#DBEAFE] text-[#2D5FA8]
                                                 font-bold px-2 py-0.5 rounded-full">
                                        {{ ucfirst($objet->categorie) }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">
                                        📍 {{ $objet->lieu }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">
                                        📅 {{ $objet->date_decouverte->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                            @if($pertes->where('categorie', $objet->categorie)
                                       ->where('lieu', $objet->lieu)->count())
                                <span class="text-[10px] font-bold bg-[#DCFCE7]
                                             text-[#16A34A] px-2 py-1 rounded-full
                                             flex-shrink-0">
                                    ✅ Match
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-3xl mb-2">📭</p>
                        <p class="text-[13px]">Aucun objet trouvé</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- COLONNE DROITE : Déclarations de perte --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-[#92400E] to-[#C8992A] px-5 py-4
                        flex items-center justify-between">
                <h3 class="text-white font-black text-[14px]">⚠️ Déclarations de perte</h3>
                <span class="bg-white/20 text-white text-[11px] font-bold
                             px-3 py-1 rounded-full">
                    {{ $pertes->count() }}
                </span>
            </div>
            <div class="divide-y divide-gray-50 max-h-[600px] overflow-y-auto">
                @forelse($pertes as $perte)
                    <div class="p-4 hover:bg-[#FFF7ED] transition cursor-pointer
                                {{ $objets->where('categorie', $perte->categorie)
                                          ->where('lieu', $perte->lieu)->count()
                                   ? 'border-l-4 border-l-[#16A34A]' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-[#FFF7ED] border border-[#FED7AA]
                                        rounded-lg flex items-center justify-center
                                        text-lg flex-shrink-0">
                                {{ $perte->categorie === 'electronique' ? '📱' :
                                   ($perte->categorie === 'sac'         ? '👜' :
                                   ($perte->categorie === 'cle'         ? '🔑' :
                                   ($perte->categorie === 'document'    ? '📄' : '📦'))) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-800 text-[13.5px]">
                                    {{ $perte->nom }}
                                </p>
                                <p class="text-[11.5px] text-gray-500 font-medium">
                                    👤 {{ $perte->user->name }}
                                </p>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    <span class="text-[11px] bg-[#FEF3C7] text-[#92400E]
                                                 font-bold px-2 py-0.5 rounded-full">
                                        {{ ucfirst($perte->categorie) }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">
                                        📍 {{ $perte->lieu }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">
                                        📅 {{ $perte->date_perte->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                            @if($objets->where('categorie', $perte->categorie)
                                       ->where('lieu', $perte->lieu)->count())
                                <span class="text-[10px] font-bold bg-[#DCFCE7]
                                             text-[#16A34A] px-2 py-1 rounded-full
                                             flex-shrink-0">
                                    ✅ Match
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-gray-400">
                        <p class="text-3xl mb-2">📭</p>
                        <p class="text-[13px]">Aucune déclaration de perte</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- BOUTON CRÉER MISE EN RELATION --}}
    @if($correspondances > 0)
        <div class="mt-6 bg-[#DCFCE7] border border-[#86EFAC] rounded-2xl p-5
                    flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <span class="text-2xl">🎯</span>
                <div>
                    <p class="font-black text-[#15803D] text-[15px]">
                        {{ $correspondances }} correspondance(s) détectée(s) !
                    </p>
                    <p class="text-[#16A34A] text-[13px]">
                        Allez dans Mise en relation pour les confirmer.
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.mise-en-relation') }}"
               class="bg-[#16A34A] text-white font-bold text-[14px]
                      px-6 py-3 rounded-xl hover:bg-[#15803D] transition
                      flex items-center gap-2">
                🤝 Gérer les mises en relation
            </a>
        </div>
    @endif

@endsection