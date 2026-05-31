@extends('layouts.app')

@section('title', 'Demande d\'assistance')

@section('content')

    {{-- PAGE HERO --}}
    <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b-4 border-[#C8992A]">
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('proprietaire.dashboard') }}"
                   class="text-white/60 hover:text-white text-[13px] transition">
                    ← Mon espace
                </a>
                <span class="text-white/30">›</span>
                <span class="text-white/80 text-[13px]">Demande d'assistance</span>
            </div>
            <h1 class="text-white font-black text-2xl sm:text-3xl"
                style="font-family:Georgia,serif">
                💬 Demande d'assistance
            </h1>
            <p class="text-white/65 text-[14px] mt-1">
                Envoyez un message à l'administrateur concernant un objet
            </p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-6 py-10">

        {{-- MESSAGES --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl px-5 py-4 mb-6
                        flex items-center gap-3 text-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($declarations->isEmpty())
            {{-- Pas de déclarations --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm
                        py-14 text-center">
                <p class="text-5xl mb-4">📭</p>
                <h3 class="text-[#1B3A6B] font-black text-xl mb-2">
                    Aucune déclaration
                </h3>
                <p class="text-gray-400 text-[14px] mb-6">
                    Vous devez d'abord déclarer un objet perdu avant de demander de l'aide.
                </p>
                <a href="{{ route('proprietaire.declarer') }}"
                   class="inline-flex items-center gap-2 bg-[#1B3A6B] text-white
                          font-bold text-[14px] px-8 py-3 rounded-xl
                          hover:bg-[#14305a] transition">
                    ➕ Déclarer un objet perdu
                </a>
            </div>
        @else
            {{-- FORMULAIRE --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="h-1.5 bg-gradient-to-r from-[#1B3A6B] via-[#2D5FA8] to-[#C8992A]"></div>

                <div class="px-8 py-8">

                    {{-- Info --}}
                    <div class="bg-[#EFF6FF] border border-[#BFDBFE] rounded-xl px-5 py-4
                                flex items-start gap-3 mb-6">
                        <span class="text-xl flex-shrink-0">ℹ️</span>
                        <p class="text-[#1B3A6B] text-[13px] leading-relaxed">
                            L'administrateur consultera votre message et cherchera manuellement
                            dans le coffre-fort si un objet correspond à votre description.
                            Vous recevrez une réponse par email.
                        </p>
                    </div>

                    {{-- Erreurs --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-5">
                            @foreach($errors->all() as $error)
                                <p class="text-red-600 text-[13px]">⚠️ {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('proprietaire.assistance.store') }}"
                          class="flex flex-col gap-5">
                        @csrf

                        {{-- Sélection déclaration --}}
                        <div>
                            <label class="block text-[12px] font-bold text-gray-600
                                          uppercase tracking-wide mb-2">
                                Concernant quel objet ? <span class="text-red-500">*</span>
                            </label>
                            <select name="declaration_perte_id" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                           text-[13.5px] bg-white text-gray-700 outline-none
                                           transition focus:border-[#2D5FA8]">
                                <option value="" disabled selected>
                                    Sélectionner une de vos déclarations...
                                </option>
                                @foreach($declarations as $dec)
                                    <option value="{{ $dec->id }}"
                                            {{ old('declaration_perte_id') == $dec->id ? 'selected' : '' }}>
                                        {{ $dec->nom ?? $dec->categorie }}
                                        — {{ $dec->lieu }}
                                        — {{ $dec->date_perte->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="block text-[12px] font-bold text-gray-600
                                          uppercase tracking-wide mb-2">
                                Votre message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" required rows="5"
                                      placeholder="Expliquez votre situation à l'administrateur..."
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl
                                             text-[13.5px] bg-white text-gray-700 outline-none
                                             transition resize-none focus:border-[#2D5FA8]
                                             @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                        </div>

                        {{-- Boutons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <button type="submit"
                                    class="flex-1 bg-[#1B3A6B] text-white font-black
                                           text-[15px] py-3.5 rounded-xl shadow-lg
                                           hover:bg-[#14305a] hover:-translate-y-0.5
                                           transition-all flex items-center justify-center gap-2">
                                ✈️ Envoyer le message
                            </button>
                            <a href="{{ route('proprietaire.dashboard') }}"
                               class="flex-1 sm:flex-none bg-gray-100 text-gray-600
                                      font-bold text-[14px] py-3.5 px-6 rounded-xl
                                      hover:bg-gray-200 transition
                                      flex items-center justify-center gap-2">
                                ← Annuler
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        @endif

    </div>

@endsection