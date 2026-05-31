@extends('layouts.app')

@section('title', 'Objet enregistré')

@section('content')

<div class="min-h-screen bg-[#1B3A6B] flex flex-col">

    {{-- Particules décoratives --}}
    <div class="flex-1 flex items-center justify-center px-4 py-16 relative">

        <div class="w-full max-w-lg text-center">

            {{-- Icône succès --}}
            <div class="w-24 h-24 bg-[#16A34A] rounded-full flex items-center
                        justify-center text-5xl mx-auto mb-8 shadow-2xl
                        animate-bounce">
                ✅
            </div>

            {{-- Badge --}}
            <span class="inline-flex items-center gap-2 bg-green-500/20 border
                         border-green-500/40 text-green-400 text-[13px] font-bold
                         px-4 py-2 rounded-full mb-6">
                🗄️ Enregistré avec succès
            </span>

            {{-- Titre --}}
            <h1 class="text-white font-black text-3xl sm:text-4xl mb-4"
                style="font-family:Georgia,serif">
                Merci pour votre aide !
            </h1>

            <p class="text-white/70 text-[15px] leading-relaxed mb-8">
                L'objet a bien été enregistré dans notre base de données.<br>
                Un agent municipal va prendre en charge votre déclaration.
            </p>

            {{-- Référence --}}
            <div class="bg-white/10 border border-white/20 rounded-2xl px-8 py-5 mb-8">
                <span class="block text-white/50 text-[11px] uppercase tracking-widest mb-2">
                    Référence de dépôt
                </span>
                <span class="text-white font-black text-2xl tracking-widest font-mono">
                    DSC-{{ date('Y') }}-{{ rand(1000,9999) }}
                </span>
            </div>

            {{-- Points info --}}
            <div class="flex flex-col gap-3 text-left mb-10">
                @foreach([
                    ['👁️‍🗨️', 'Anonymat garanti',    'Vos coordonnées ne seront jamais publiées ni partagées'],
                    ['🔒',    'Données sécurisées',   'La photo est stockée de façon privée, jamais accessible publiquement'],
                    ['👨‍💼',   'Traitement admin',     'Un agent va comparer votre dépôt aux déclarations de perte existantes'],
                ] as [$icon, $titre, $desc])
                    <div class="flex items-center gap-4 bg-white/8 rounded-xl px-5 py-4
                                border border-white/10">
                        <span class="text-xl flex-shrink-0">{{ $icon }}</span>
                        <div>
                            <strong class="text-white text-[13.5px] block">{{ $titre }}</strong>
                            <span class="text-white/55 text-[12.5px]">{{ $desc }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bouton retour --}}
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-3 bg-[#C8992A] text-white
                      font-black text-[15px] px-10 py-4 rounded-xl shadow-lg
                      hover:bg-[#b8861e] hover:-translate-y-1 transition-all">
                🏠 Retour à l'accueil
            </a>

            <p class="text-white/30 text-[12px] mt-6">
                🔒 Cette page est la seule à laquelle vous avez accès en tant qu'inventeur anonyme.
            </p>

        </div>
    </div>
</div>

@endsection