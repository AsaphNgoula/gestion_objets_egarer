@extends('layouts.app')

@section('title', 'Déposer un objet trouvé')

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4">
<div class="max-w-4xl mx-auto">

    {{-- EN-TÊTE --}}
    <div class="bg-[#1B3A6B] rounded-2xl p-6 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center">
                <span class="text-3xl">📦</span>
            </div>
            <div>
                <h1 class="text-white font-black text-2xl sm:text-3xl tracking-wide">
                    OBJET TROUVÉ
                </h1>
                <p class="text-white/70 text-[14px] mt-0.5">
                    Déposez un objet trouvé anonymement
                </p>
            </div>
        </div>
        <div class="hidden sm:block">
            <span class="bg-[#C8992A]/20 border border-[#C8992A]/40 text-[#C8992A]
                         text-[12px] font-bold px-4 py-2 rounded-full">
                🔒 Dépôt anonyme
            </span>
        </div>
    </div>

    {{-- ERREURS --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 mb-6">
            @foreach($errors->all() as $error)
                <p class="text-red-600 text-[13px] flex items-center gap-2">
                    ⚠️ {{ $error }}
                </p>
            @endforeach
        </div>
    @endif

    {{-- FORMULAIRE --}}
    <form method="POST"
          action="{{ route('deposer.store') }}"
          enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        @csrf

        {{-- ══ SECTION 1 : L'OBJET ══ --}}
        <div class="px-8 py-6 border-b border-gray-100">

            <div class="flex items-center gap-3 mb-5">
                <span class="text-[#1B3A6B] text-xl">📦</span>
                <h2 class="text-[#1B3A6B] font-black text-[14px] uppercase tracking-widest">
                    Description de l'objet
                </h2>
                <div class="flex-1 h-px bg-[#1B3A6B]/20"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Catégorie <span class="text-red-500">*</span>
                    </label>
                    <select name="categorie" required
                            class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                   bg-white text-gray-700 outline-none transition
                                   focus:border-[#1B3A6B]
                                   @error('categorie') border-red-400 @else border-gray-200 @enderror">
                        <option value="" disabled selected>Sélectionner...</option>
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
                                    {{ old('categorie') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Nom de l'objet
                    </label>
                    <input type="text" name="nom"
                           value="{{ old('nom') }}"
                           placeholder="Ex: Téléphone Samsung, Sac noir..."
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg
                                  text-[13.5px] bg-white text-gray-700 outline-none
                                  transition focus:border-[#1B3A6B]"/>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Photo <span class="text-gray-400 font-normal">(optionnel)</span>
                    </label>
                    <div class="bg-[#EFF6FF] border border-[#BFDBFE] rounded-lg p-3">
                        <input type="file" name="photo" accept="image/*"
                               class="w-full text-[12.5px] text-gray-600
                                      file:mr-2 file:py-1 file:px-3 file:rounded-lg
                                      file:border-0 file:text-[12px] file:font-bold
                                      file:bg-[#1B3A6B] file:text-white
                                      hover:file:bg-[#14305a] cursor-pointer"/>
                        <p class="text-[11px] text-[#2D5FA8] mt-1">
                            🔒 Stockée de façon privée — jamais publique
                        </p>
                    </div>
                </div>

            </div>

            <div>
                <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                    Description détaillée <span class="text-red-500">*</span>
                </label>
                <textarea name="description" required rows="3"
                          placeholder="Couleur, état, marque, signes particuliers..."
                          class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                 bg-white text-gray-700 outline-none transition resize-none
                                 focus:border-[#1B3A6B]
                                 @error('description') border-red-400 @else border-gray-200 @enderror">{{ old('description') }}</textarea>
            </div>

        </div>

        {{-- ══ SECTION 2 : LIEU & DATE ══ --}}
        <div class="px-8 py-6 border-b border-gray-100">

            <div class="flex items-center gap-3 mb-5">
                <span class="text-[#1B3A6B] text-xl">📍</span>
                <h2 class="text-[#1B3A6B] font-black text-[14px] uppercase tracking-widest">
                    Lieu et date de découverte
                </h2>
                <div class="flex-1 h-px bg-[#1B3A6B]/20"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Quartier <span class="text-red-500">*</span>
                    </label>
                    <select name="lieu" required
                            class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                   bg-white text-gray-700 outline-none transition
                                   focus:border-[#1B3A6B]
                                   @error('lieu') border-red-400 @else border-gray-200 @enderror">
                        <option value="" disabled selected>Sélectionner...</option>
                        @foreach([
                            'Marché A', 'Marché B', 'Centre Administratif',
                            'Hôtel de Ville', 'Campus UDo', 'Cité Universitaire',
                            'Foto', 'Route de Bafoussam', 'Carrefour Fongé',
                            'Gare Routière', 'Autre quartier'
                        ] as $lieu)
                            <option value="{{ $lieu }}"
                                    {{ old('lieu') === $lieu ? 'selected' : '' }}>
                                {{ $lieu }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Précision du lieu
                    </label>
                    <input type="text" name="lieu_detail"
                           value="{{ old('lieu_detail') }}"
                           placeholder="Ex: Devant la pharmacie..."
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg
                                  text-[13.5px] bg-white text-gray-700 outline-none
                                  transition focus:border-[#1B3A6B]"/>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_decouverte"
                           value="{{ old('date_decouverte') }}"
                           max="{{ date('Y-m-d') }}" required
                           class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                  bg-white text-gray-700 outline-none transition
                                  focus:border-[#1B3A6B]
                                  @error('date_decouverte') border-red-400 @else border-gray-200 @enderror"/>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Heure approximative
                    </label>
                    <input type="time" name="heure_decouverte"
                           value="{{ old('heure_decouverte') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-lg
                                  text-[13.5px] bg-white text-gray-700 outline-none
                                  transition focus:border-[#1B3A6B]"/>
                </div>

            </div>

        </div>

        {{-- ══ SECTION 3 : VOS COORDONNÉES ══ --}}
        <div class="px-8 py-6">

            <div class="flex items-center gap-3 mb-2">
                <span class="text-[#1B3A6B] text-xl">🔒</span>
                <h2 class="text-[#1B3A6B] font-black text-[14px] uppercase tracking-widest">
                    Vos coordonnées
                </h2>
                <div class="flex-1 h-px bg-[#1B3A6B]/20"></div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-xl px-5 py-3
                        mb-5 flex items-center gap-3">
                <span class="text-green-500 text-lg">👁️‍🗨️</span>
                <p class="text-green-700 text-[13px]">
                    <strong>Dépôt 100% anonyme</strong> — Vos coordonnées sont
                    visibles uniquement par l'administrateur. Jamais publiées.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Votre nom <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="inventeur_nom"
                           value="{{ old('inventeur_nom') }}" required
                           placeholder="Votre nom complet"
                           class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                  bg-white text-gray-700 outline-none transition
                                  focus:border-[#1B3A6B]
                                  @error('inventeur_nom') border-red-400 @else border-gray-200 @enderror"/>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-600 mb-1.5">
                        Téléphone <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="inventeur_tel"
                           value="{{ old('inventeur_tel') }}" required
                           placeholder="Ex : 6XX XX XX XX"
                           class="w-full px-4 py-2.5 border rounded-lg text-[13.5px]
                                  bg-white text-gray-700 outline-none transition
                                  focus:border-[#1B3A6B]
                                  @error('inventeur_tel') border-red-400 @else border-gray-200 @enderror"/>
                </div>

            </div>
        </div>

        {{-- BOUTON --}}
        <div class="px-8 pb-8">
            <button type="submit"
                    class="w-full bg-[#C8992A] text-white font-black text-[15px]
                           py-4 rounded-xl shadow-lg hover:bg-[#b8861e]
                           hover:-translate-y-0.5 transition-all duration-200
                           flex items-center justify-center gap-3 uppercase tracking-wider">
                ✈️ Envoyer le dépôt
            </button>
            <p class="text-center text-gray-400 text-[12px] mt-3 flex items-center
                       justify-center gap-1">
                🔒 Vos informations sont sécurisées et ne seront jamais publiées
            </p>
        </div>

    </form>

</div>
</div>

@endsection