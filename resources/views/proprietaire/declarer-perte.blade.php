@extends('layouts.app')

@section('title', 'Déclarer un objet perdu')

@section('content')
<div class="h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-5 flex flex-col">
    {{-- TITRE --}}
    <div class="text-center mb-3 animate-fade-in-up">
        <h1 class="text-3xl md:text-4xl font-black text-[#1B3A6B]" style="font-family:Georgia,serif">OBJET PERDU</h1>
        <p class="text-gray-500 text-sm">Déclarez un objet perdu</p>
        <div class="w-16 h-0.5 bg-[#C8992A] mx-auto mt-1 rounded-full"></div>
    </div>

    <form method="POST" action="{{ route('proprietaire.declarer.store') }}" enctype="multipart/form-data" class="flex-1 flex flex-col">
        @csrf

        {{-- GRILLE 2x2 avec hauteur équilibrée --}}
        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 auto-rows-fr">
            
            {{-- 1. Informations personnelles (haut gauche) --}}
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-100 overflow-hidden flex flex-col">
                <div class="bg-[#1B3A6B]/5 px-4 py-2 border-b border-gray-100">
                    <h2 class="text-sm font-black text-[#1B3A6B] uppercase tracking-wide">Informations personnelles</h2>
                </div>
                <div class="p-4 flex-1 space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Nom complet</label>
                        <input type="text" value="{{ Auth::user()->name }}" readonly
                               class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Téléphone <span class="text-red-500">*</span></label>
                        <input type="text" value="{{ Auth::user()->phone }}" readonly
                               class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm">
                        <p class="text-xs text-gray-400 mt-0.5">Ex : 07 12 34 56 78</p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="text" value="{{ Auth::user()->email }}" readonly
                               class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm">
                        <p class="text-xs text-gray-400 mt-0.5">exemple@email.com</p>
                    </div>
                </div>
            </div>

            {{-- 2. Informations sur l'objet (haut droite) --}}
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-200 overflow-hidden flex flex-col">
                <div class="bg-[#1B3A6B]/5 px-4 py-2 border-b border-gray-100">
                    <h2 class="text-sm font-black text-[#1B3A6B] uppercase tracking-wide">Informations sur l'objet</h2>
                </div>
                <div class="p-4 flex-1 space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Type d'objet</label>
                        <select name="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white">
                            <option value="" disabled selected>Sélectionnez le type d'objet</option>
                            @foreach(['electronique' => '📱 Électronique', 'document' => '📄 Document', 'sac' => '👜 Sac & portefeuille', 'cle' => '🔑 Clés', 'vetement' => '👕 Vêtement', 'bijou' => '💍 Bijou', 'autre' => '📦 Autre'] as $val => $label)
                                <option value="{{ $val }}" {{ old('categorie') == $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Marque / Modèle</label>
                            <input type="text" name="marque" value="{{ old('marque') }}" placeholder="Ex: Samsung Galaxy" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Couleur</label>
                            <input type="text" name="couleur" value="{{ old('couleur') }}" placeholder="Ex: Noir" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Description détaillée</label>
                        <textarea name="description" rows="2" placeholder="Décrivez votre objet (taille, matière, signes particuliers...)" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm resize-none">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Particularités</label>
                        <textarea name="signes_particuliers" rows="1" placeholder="Autocollant, rayures, contenu, initiales..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm resize-none">{{ old('signes_particuliers') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- 3. Informations sur la perte (bas gauche) --}}
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-300 overflow-hidden flex flex-col">
                <div class="bg-[#1B3A6B]/5 px-4 py-2 border-b border-gray-100">
                    <h2 class="text-sm font-black text-[#1B3A6B] uppercase tracking-wide">Informations sur la perte</h2>
                </div>
                <div class="p-4 flex-1 space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Date de perte</label>
                            <input type="date" name="date_perte" value="{{ old('date_perte') }}" max="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <p class="text-xs text-gray-400 mt-0.5">// mm / aaaa</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Heure approximative</label>
                            <input type="time" name="heure_perte" value="{{ old('heure_perte') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <p class="text-xs text-gray-400 mt-0.5">Ex : 14:30</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Lieu précis <span class="text-red-500">*</span></label>
                        <select name="lieu" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white">
                            <option value="" disabled selected>Ex : Salle A, cafétéria, parking...</option>
                            @foreach(['Marché A', 'Marché B', 'Centre Administratif', 'Hôtel de Ville', 'Campus UDo', 'Cité Universitaire', 'Foto', 'Route de Bafoussam', 'Carrefour Fongé', 'Gare Routière'] as $lieu)
                                <option value="{{ $lieu }}" {{ old('lieu') == $lieu ? 'selected' : '' }}>{{ $lieu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Circonstances de la perte</label>
                        <textarea name="circonstances" rows="2" placeholder="Décrivez brièvement les circonstances de la perte" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm resize-none">{{ old('circonstances') }}</textarea>
                    </div>
                    <div class="bg-blue-50/40 border border-blue-200 rounded-lg p-3">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-[#1B3A6B]">PREUVE / JUSTIFICATIF (FACULTATIF)</span>
                        </div>
                        <input type="file" name="photo_justificatif" accept="image/*" class="w-full text-sm text-gray-600 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#1B3A6B] file:text-white">
                        <p class="text-xs text-gray-500 mt-1">Photo de l'objet ou tout justificatif utile</p>
                    </div>
                </div>
            </div>

            {{-- 4. Informations complémentaires (bas droite) --}}
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 animate-fade-in-up delay-400 overflow-hidden flex flex-col">
                <div class="bg-[#1B3A6B]/5 px-4 py-2 border-b border-gray-100">
                    <h2 class="text-sm font-black text-[#1B3A6B] uppercase tracking-wide">Informations complémentaires</h2>
                </div>
                <div class="p-4 flex-1 space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Moyen de contact préféré</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach(['telephone' => '📞 Téléphone', 'email' => '✉️ Email', 'indifferent' => '🔄 Indifférent'] as $val => $label)
                                <label class="flex items-center gap-2 text-sm cursor-pointer">
                                    <input type="radio" name="moyen_contact" value="{{ $val }}" {{ old('moyen_contact', 'telephone') == $val ? 'checked' : '' }} class="w-4 h-4 accent-[#1B3A6B]"> {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Commentaires supplémentaires</label>
                        <textarea name="commentaires" rows="3" placeholder="Toute information supplémentaire..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm resize-none">{{ old('commentaires') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOUTON CENTRÉ --}}
        <div class="text-center mt-3 animate-fade-in-up delay-500">
            <button type="submit" class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] text-white font-bold text-base px-10 py-2.5 rounded-xl shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5">
                ✈️ ENVOYER MA DÉCLARATION
            </button>
        </div>
    </form>

    @if($errors->any())
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg text-sm">
            @foreach($errors->all() as $error)
                <p>⚠️ {{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>

@push('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.4s ease-out forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }

    input, select, textarea {
        transition: all 0.2s;
    }
    input:hover, select:hover, textarea:hover {
        border-color: #1B3A6B;
        background-color: #fafcff;
    }
    .bg-white.rounded-xl {
        transition: all 0.25s cubic-bezier(0.2,0.9,0.4,1.1);
    }
    .bg-white.rounded-xl:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -8px rgba(0,0,0,0.12);
    }
</style>
@endpush
@endsection