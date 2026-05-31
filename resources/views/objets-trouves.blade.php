@extends('layouts.app')

@section('title', 'Objets trouvés')

@section('content')

    {{-- PAGE HERO --}}
    <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b-4 border-[#C8992A]">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <h1 class="text-white font-black text-2xl sm:text-3xl mb-2"
                style="font-family:Georgia,serif">
                🔍 Objets trouvés à Dschang
            </h1>
            <p class="text-white/65 text-[14px]">
                Parcourez la liste des objets trouvés dans la ville de Dschang
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- FILTRES --}}
        <form method="GET" action="{{ route('objets.index') }}"
              class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Recherche --}}
                <div class="lg:col-span-2">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2
                                     text-gray-400">🔍</span>
                        <input type="text" name="search"
                               value="{{ request('search') }}"
                               placeholder="Rechercher un objet (téléphone, sac, clés...)"
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200
                                      rounded-xl text-[13.5px] outline-none
                                      focus:border-[#2D5FA8] transition"/>
                    </div>
                </div>

                {{-- Catégorie --}}
                <div>
                    <select name="categorie"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                                   text-[13.5px] outline-none focus:border-[#2D5FA8]
                                   bg-white text-gray-700">
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
                            <option value="{{ $val }}"
                                    {{ request('categorie') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Lieu --}}
                <div>
                    <select name="lieu"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl
                                   text-[13.5px] outline-none focus:border-[#2D5FA8]
                                   bg-white text-gray-700">
                        <option value="">📍 Tous les lieux</option>
                        @foreach([
                            'Marché A', 'Marché B', 'Centre Administratif',
                            'Hôtel de Ville', 'Campus UDo', 'Cité Universitaire',
                            'Foto', 'Route de Bafoussam', 'Carrefour Fongé',
                            'Gare Routière'
                        ] as $lieu)
                            <option value="{{ $lieu }}"
                                    {{ request('lieu') == $lieu ? 'selected' : '' }}>
                                {{ $lieu }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Boutons filtre --}}
            <div class="flex gap-3 mt-4">
                <button type="submit"
                        class="bg-[#1B3A6B] text-white font-bold text-[13.5px]
                               px-6 py-2.5 rounded-xl hover:bg-[#14305a] transition
                               flex items-center gap-2">
                    🔍 Rechercher
                </button>
                @if(request('search') || request('categorie') || request('lieu'))
                    <a href="{{ route('objets.index') }}"
                       class="border border-gray-200 text-gray-500 font-bold
                              text-[13.5px] px-6 py-2.5 rounded-xl
                              hover:bg-gray-50 transition">
                        ↺ Réinitialiser
                    </a>
                @endif
            </div>

        </form>

        {{-- RÉSULTATS --}}
        <div class="flex items-center justify-between mb-5">
            <p class="text-gray-500 text-[14px]">
                <strong class="text-[#1B3A6B]">{{ $objets->total() }}</strong>
                objet(s) trouvé(s)
            </p>
            <a href="{{ route('deposer') }}"
               class="flex items-center gap-2 bg-[#C8992A] text-white font-bold
                      text-[13px] px-4 py-2 rounded-xl hover:bg-[#b8861e] transition">
                📦 J'ai trouvé un objet
            </a>
        </div>

        {{-- GRILLE D'OBJETS --}}
        @if($objets->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        py-16 text-center">
                <p class="text-5xl mb-4">📭</p>
                <h3 class="text-[#1B3A6B] font-black text-xl mb-2">
                    Aucun objet trouvé
                </h3>
                <p class="text-gray-400 text-[14px] mb-6">
                    Aucun objet ne correspond à votre recherche.
                </p>
                <a href="{{ route('deposer') }}"
                   class="inline-flex items-center gap-2 bg-[#C8992A] text-white
                          font-bold text-[14px] px-8 py-3 rounded-xl
                          hover:bg-[#b8861e] transition">
                    📦 Déposer un objet trouvé
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                @foreach($objets as $objet)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                                overflow-hidden hover:-translate-y-1 hover:shadow-md
                                transition-all duration-200 group">

                        {{-- Image / Placeholder --}}
                        <div class="h-44 bg-gradient-to-br from-[#EFF6FF] to-[#DBEAFE]
                                    flex items-center justify-center relative overflow-hidden">
                            <span class="text-7xl opacity-60 group-hover:scale-110
                                         transition-transform duration-300">
                                {{ $objet->categorie === 'electronique' ? '📱' :
                                   ($objet->categorie === 'sac'         ? '👜' :
                                   ($objet->categorie === 'cle'         ? '🔑' :
                                   ($objet->categorie === 'document'    ? '📄' :
                                   ($objet->categorie === 'vetement'    ? '👕' :
                                   ($objet->categorie === 'bijou'       ? '💍' : '📦'))))) }}
                            </span>

                            {{-- Badge catégorie --}}
                            <span class="absolute top-3 left-3 bg-white/90 text-[#2D5FA8]
                                         text-[11px] font-bold px-2.5 py-1 rounded-full
                                         shadow-sm">
                                {{ ucfirst($objet->categorie) }}
                            </span>

                            {{-- Badge statut --}}
                            <span class="absolute top-3 right-3 text-[11px] font-bold
                                         px-2.5 py-1 rounded-full shadow-sm
                                         {{ $objet->statut === 'en_cours'
                                            ? 'bg-[#DBEAFE] text-[#2D5FA8]'
                                            : 'bg-[#FEF3C7] text-[#92400E]' }}">
                                {{ $objet->statut === 'en_cours' ? '🔵 En cours' : '🟡 Disponible' }}
                            </span>
                        </div>

                        {{-- Contenu --}}
                        <div class="p-5">
                            <h3 class="font-black text-[#1B3A6B] text-[15px] mb-2 truncate">
                                {{ $objet->nom }}
                            </h3>
                            <p class="text-gray-500 text-[13px] leading-relaxed mb-3
                                       line-clamp-2">
                                {{ $objet->description }}
                            </p>
                            <div class="flex flex-col gap-1 mb-4">
                                <span class="text-[12px] text-gray-400 flex items-center gap-1">
                                    📍 {{ $objet->lieu }}
                                </span>
                                <span class="text-[12px] text-gray-400 flex items-center gap-1">
                                    📅 {{ $objet->date_decouverte->format('d/m/Y') }}
                                </span>
                            </div>

                            {{-- Bouton --}}
                            @auth
                                <a href="{{ route('proprietaire.assistance') }}"
                                   class="w-full flex items-center justify-center gap-2
                                          bg-[#1B3A6B] text-white font-bold text-[13px]
                                          py-2.5 rounded-xl hover:bg-[#14305a] transition">
                                    🤝 C'est le mien !
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full flex items-center justify-center gap-2
                                          border-2 border-[#1B3A6B] text-[#1B3A6B]
                                          font-bold text-[13px] py-2.5 rounded-xl
                                          hover:bg-[#1B3A6B] hover:text-white transition">
                                    🔑 Se connecter pour réclamer
                                </a>
                            @endauth
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if($objets->hasPages())
                <div class="flex justify-center">
                    {{ $objets->appends(request()->query())->links() }}
                </div>
            @endif

        @endif

    </div>

@endsection