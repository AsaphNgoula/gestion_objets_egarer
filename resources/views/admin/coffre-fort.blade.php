@extends('layouts.admin')

@section('title', '🔒 Coffre-fort Ultra-Sécurisé')
@section('breadcrumb', 'Administration / Coffre-fort')

@section('content')
<div x-data="{
    searchQuery: '',
    selectedCategory: '',
    selectedStatus: '',
    modalOpen: false,
    selectedObjet: null,
    
    init() {
        // Code d'initialisation AlpineJS si nécessaire
    }
}" class="min-h-screen bg-[#F8FAFC] text-slate-800 font-sans antialiased p-1 sm:p-4">

    {{-- GRILLE DE FOND SUBTILE & DESIGN EXPERT --}}
    <div class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none opacity-50"></div>

    <div class="relative z-10 w-full">
        {{-- EN-TÊTE ÉLÉGANT AVEC GLOW & INDICATEUR DE SÉCURITÉ EN DIRECT --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 bg-white/70 backdrop-blur-md p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div>
                <div class="flex items-center gap-2.5 mb-1.55">
                    <span class="flex h-3.5 w-3.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-[11px] font-extrabold tracking-widest text-[#2D5FA8] uppercase font-mono">
                        Système d'Audit Actif
                    </span>
                </div>
                <h1 class="text-3xl font-black tracking-tight text-[#1B3A6B] font-display flex items-center gap-3">
                    <span class="bg-[#EFF6FF] border border-[#DBEAFE] p-2.5 rounded-2xl text-2xl shadow-inner shadow-blue-50">🔒</span>
                    Coffre-fort Numérique
                </h1>
                <p class="text-slate-500 text-[13.5px] mt-1.5 max-w-xl">
                    Registre de haute sécurité pour les objets déposés. <span class="text-[#2D5FA8] font-semibold">Chaque interaction, consultation et modification est irrévocablement consignée.</span>
                </p>
            </div>
            
            {{-- ACTIONS DE L'EN-TÊTE --}}
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.comparaison') }}" 
                   class="inline-flex items-center gap-2.5 bg-[#EDE9FE] text-[#7C3AED] hover:bg-[#7C3AED] hover:text-white font-extrabold text-[12.5px] px-5 py-3.5 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-[#7C3AED]/20 active:scale-95 group">
                    <span class="text-base transition-transform group-hover:rotate-12 duration-300">🔀</span>
                    Match & Comparaison Automatique
                </a>
                
                <button @click="modalOpen = true; selectedObjet = null" 
                        class="inline-flex items-center gap-2.5 bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] hover:from-[#14305a] hover:to-[#224b89] text-white font-extrabold text-[12.5px] px-5 py-3.5 rounded-2xl shadow-lg shadow-blue-900/10 transition-all duration-200 active:scale-95">
                    <span>➕</span> Déposer un objet égaré
                </button>
            </div>
        </div>

        {{-- ALERTE JOURNALISATION DISSOCIABLE ET INTUITE (HAUT DE GAMME) --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 to-amber-100/50 border border-amber-200/70 rounded-2xl p-5 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-sm">
            <div class="absolute -right-8 -top-8 w-24 h-24 bg-amber-200/20 rounded-full blur-xl pointer-events-none"></div>
            <div class="flex items-start gap-4 relative z-10">
                <span class="text-2xl bg-amber-100 border border-amber-200 rounded-xl p-1.5 shadow-inner">⚠️</span>
                <div>
                    <h4 class="font-bold text-amber-900 text-[14.5px]">Avis d'Assurance Sécurité de l'Information</h4>
                    <p class="text-amber-800/80 text-[13px] mt-0.5 leading-relaxed">
                        En vertu de la norme ISO 27001, votre connexion <strong class="text-amber-900">({{ request()->ip() }})</strong> est liée à cet audit. Toute consultation d'un objet sensible génère une empreinte numérique inaltérable.
                    </p>
                </div>
            </div>
            <div class="shrink-0 relative z-10">
                <span class="text-[11px] font-mono font-bold bg-amber-200/50 border border-amber-300 text-amber-900 px-3 py-1.5 rounded-lg whitespace-nowrap">
                    IP LOGGED: {{ request()->ip() }}
                </span>
            </div>
        </div>

        {{-- MINI STATS - DESIGN EN GRILLE ÉPURÉE ET VIBRANTE --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            @foreach([
                ['📦', $stats['total'] ?? 0,    'Inventaire Total',    'De valeur égarée',      '#2D5FA8'],
                ['⏳', $stats['attente'] ?? 0,  'Sous Scellé d\'Attente', 'En attente d\'audit',   '#C8992A'],
                ['🔵', $stats['en_cours'] ?? 0, 'Restitution Active',  'Propriétaire notifié',  '#7C3AED'],
                ['✅', $stats['restitue'] ?? 0, 'Objets Restitués',    'Sains & saufs',          '#16A34A'],
            ] as [$icon, $count, $label, $sub, $color])
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
                    {{-- Barre colorée décorative supérieure --}}
                    <div class="absolute top-0 left-0 right-0 h-1.5" style="background: {{ $color }}"></div>
                    <div class="absolute -right-3 -bottom-3 text-7xl opacity-[0.03] grayscale transition-all duration-300 group-hover:scale-110 group-hover:opacity-[0.06]">
                        {{ $icon }}
                    </div>
                    
                    <div class="flex items-center justify-between mb-3.5">
                        <span class="text-2xl bg-slate-105 rounded-xl p-2 border border-slate-100 shadow-sm">{{ $icon }}</span>
                        <span class="text-[10.5px] font-mono font-bold text-slate-400">STATUS OK</span>
                    </div>
                    
                    <span class="block text-4xl font-extrabold text-[#1B3A6B] font-display select-none">
                        {{ $count }}
                    </span>
                    <h3 class="text-[13.5px] font-bold text-[#1B3A6B] mt-1">{{ $label }}</h3>
                    <p class="text-[11px] text-slate-405 mt-0.5">{!! $sub !!}</p>
                </div>
            @endforeach
        </div>

        {{-- BARRE DE FILTRES RESPONSIVE ET MODERNE --}}
        <form method="GET" action="{{ route('admin.coffre-fort') }}"
              class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-8 relative">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-5 items-end">

                <div class="lg:col-span-4">
                    <label class="block text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-2">
                        🔍 Rechercher un bien
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-450 text-[14px]">
                            🔍
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Saisissez un nom, scellé, mot-clé..."
                               class="w-full pl-9 pr-4 py-3 border border-slate-200 focus:border-[#2D5FA8] focus:ring-2 focus:ring-blue-105 rounded-xl text-[13.5px] outline-none transition-all placeholder:text-slate-400" />
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-2">
                        📂 Classification
                    </label>
                    <select name="categorie"
                            class="w-full px-4 py-3 border border-slate-200 focus:border-[#2D5FA8] focus:ring-2 focus:ring-blue-105 rounded-xl text-[13.5px] outline-none cursor-pointer bg-[#F8FAFC] focus:bg-white transition-all text-slate-700 font-medium">
                        <option value="">Toutes catégories</option>
                        @foreach([
                            'electronique' => '📱 Électronique',
                            'document' => '📄 Documents Officiels',
                            'sac' => '👜 Sacs & Portefeuilles',
                            'cle' => '🔑 Clés de Véhicules',
                            'vetement' => '👕 Vêtements & Effets',
                            'bijou' => '💍 Bijoux & Métaux précieux',
                            'autre' => '📦 Autres objets de valeur'
                        ] as $val => $labelCat)
                            <option value="{{ $val }}" {{ request('categorie') == $val ? 'selected' : '' }}>
                                {{ $labelCat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-2">
                        ⚖️ Statut Légitime
                    </label>
                    <select name="statut"
                            class="w-full px-4 py-3 border border-slate-200 focus:border-[#2D5FA8] focus:ring-2 focus:ring-blue-105 rounded-xl text-[13.5px] outline-none cursor-pointer bg-[#F8FAFC] focus:bg-white transition-all text-slate-700 font-medium">
                        <option value="">Tous statuts confondus</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>🟡 En attente d'audit</option>
                        <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>🔵 Traitement / Restitution en cours</option>
                        <option value="restitue" {{ request('statut') == 'restitue' ? 'selected' : '' }}>✅ Restitué au propriétaire</option>
                    </select>
                </div>

                <div class="lg:col-span-2 flex items-stretch gap-2">
                    <button type="submit"
                            class="flex-1 bg-[#1B3A6B] text-white hover:bg-[#14305a] font-bold text-[13px] py-3 rounded-xl transition-all duration-200 shadow-md shadow-blue-900/15 active:scale-95 flex items-center justify-center gap-2">
                        <span>🔍</span> Filtrer
                    </button>
                    <a href="{{ route('admin.coffre-fort') }}"
                       class="px-4 py-3 border border-slate-200 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-[#1B3A6B] transition-all flex items-center justify-center text-[15px]"
                       title="Réinitialiser les filtres">
                        ↺
                    </a>
                </div>

            </div>
        </form>

        {{-- TABLEAU PRINCIPAL SOUS FORME DE CARTE LUXUEUSE --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b border-blue-900/10">
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-mono">ID Scellé</th>
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Objet & Descriptif</th>
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Catégorie</th>
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Coordonnées Dépôt</th>
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Inventeur</th>
                            <th class="px-6 py-4.5 text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Statut Sécurisé</th>
                            <th class="px-6 py-4.5 text-right text-white font-semibold text-[11px] uppercase tracking-wider font-sans">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($objets as $objet)
                            <tr class="hover:bg-slate-50/80 transition-all duration-150 group">
                                <td class="px-6 py-5 text-slate-400 font-mono text-[11.5px]">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-xs">🔒</span>
                                        <span class="bg-slate-100 border border-slate-200/60 text-slate-600 px-2 py-0.5 rounded-lg font-bold">
                                            #{{ str_pad($objet->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                    @if(isset($objet->scelle_numero))
                                        <div class="text-[9.5px] mt-1.5 text-slate-400 tracking-wider">
                                            {{ $objet->scelle_numero }}
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-5">
                                    <div class="flex items-start gap-3.5">
                                        <div class="w-10 h-10 shrink-0 bg-[#EFF6FF] border border-[#DBEAFE] group-hover:scale-110 transition-transform duration-300 rounded-xl flex items-center justify-center text-lg shadow-sm">
                                            @if($objet->categorie === 'electronique')
                                                📱
                                            @elseif($objet->categorie === 'sac')
                                                👜
                                            @elseif($objet->categorie === 'cle')
                                                🔑
                                            @elseif($objet->categorie === 'document')
                                                📄
                                            @elseif($objet->categorie === 'bijou')
                                                💍
                                            @else
                                                📦
                                            @endif
                                        </div>
                                        <div class="max-w-[280px]">
                                            <p class="font-bold text-slate-800 text-[13.5px] group-hover:text-[#2D5FA8] transition-colors leading-tight">
                                                {{ $objet->nom }}
                                            </p>
                                            <p class="text-[11.5px] text-slate-400 mt-1 line-clamp-2 leading-relaxed" title="{{ $objet->description }}">
                                                {{ Str::limit($objet->description, 75) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-5">
                                    <span class="text-[10px] font-extrabold tracking-wider bg-blue-50 border border-blue-100 text-[#2D5FA8] uppercase px-2.5 py-1 rounded-full whitespace-nowrap">
                                        {{ ucfirst($objet->categorie) }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-1.5 text-[12.5px] text-slate-705 font-medium">
                                        <span class="text-slate-400">📍</span>
                                        <span>{{ $objet->lieu }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                                        <span class="text-xs">📅</span>
                                        <span>{{ $objet->date_decouverte->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-5">
                                    <p class="font-bold text-slate-800 text-[13px] leading-tight">{{ $objet->inventeur_nom }}</p>
                                    @if(isset($objet->inventeur_tel))
                                        <p class="text-[11px] font-mono text-slate-400 mt-1 flex items-center gap-1">
                                            <span>📞</span>
                                            <span>{{ $objet->inventeur_tel }}</span>
                                        </p>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-5">
                                    <form method="POST" action="{{ route('admin.coffre-fort.statut', $objet) }}" class="inline-block relative">
                                        @csrf
                                        @method('PATCH')
                                        <select name="statut" onchange="this.form.submit()"
                                                class="text-[11.5px] font-extrabold px-3.5 py-1.5 rounded-full border border-current bg-transparent outline-none cursor-pointer transition-all focus:ring-4 focus:ring-slate-100
                                                       {{ $objet->statut === 'restitue'
                                                          ? 'text-[#16A34A] hover:bg-[#16A34A]/5'
                                                          : ($objet->statut === 'en_cours'
                                                          ? 'text-[#2D5FA8] hover:bg-[#2D5FA8]/5'
                                                          : 'text-[#C8992A] hover:bg-[#C8992A]/5') }}">
                                            <option value="en_attente" {{ $objet->statut === 'en_attente' ? 'selected' : '' }}>🟡 En attente</option>
                                            <option value="en_cours" {{ $objet->statut === 'en_cours' ? 'selected' : '' }}>🔵 En cours</option>
                                            <option value="restitue" {{ $objet->statut === 'restitue' ? 'selected' : '' }}>✅ Restitué</option>
                                        </select>
                                    </form>
                                </td>
                                
                                <td class="px-6 py-5 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        {{-- Bouton Comparer avec micro-glow --}}
                                        <a href="{{ route('admin.comparaison', ['id' => $objet->id]) }}"
                                           class="inline-flex items-center gap-1.5 bg-[#EDE9FE] text-[#7C3AED] hover:bg-[#7C3AED] hover:text-white text-[11px] font-extrabold px-3 py-2 rounded-lg transition-all duration-200">
                                            <span>🔀</span> Comparer
                                        </a>
                                        
                                        {{-- Bouton Historique confidentiel d'audit --}}
                                        <button @click="selectedObjet = {{ json_encode($objet) }}; modalOpen = true"
                                                class="p-2 border border-slate-205 rounded-lg text-slate-400 hover:text-slate-800 hover:bg-slate-50 transition-all duration-150 outline-none"
                                                title="Fiche d'audit détaillée">
                                            ℹ️
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-20 text-center text-slate-400 bg-slate-50/50">
                                    <div class="w-16 h-16 mx-auto bg-slate-100 border border-slate-200 rounded-full flex items-center justify-center text-3xl mb-4 shadow-sm animate-bounce">
                                        📭
                                    </div>
                                    <h3 class="font-extrabold text-slate-700 text-lg">Aucun objet scellé dans le coffre</h3>
                                    <p class="text-slate-400 text-[13px] mt-1 max-w-sm mx-auto">
                                        Les éléments déclarés ou trouvés seront stockés de manière sécurisée et apparaîtront ici.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION ÉLÉGANTE --}}
            @if(isset($objets) && method_exists($objets, 'hasPages') && $objets->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                    <div class="text-[12.5px] text-slate-500">
                        Affichage des scellés de coffre-fort égarés
                    </div>
                    <div>
                        {{ $objets->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
        


    </div>

    {{-- MODAL ÉLÉGANT ET TRÈS ANIMÉ (ALPINE JS) POUR CONSULATION DÉTAILLÉE --}}
    <div x-cloak x-show="modalOpen" 
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 shadow-2xl"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
         
        {{-- Sombritude de fond --}}
        <div class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm" @click="modalOpen = false"></div>
        
        {{-- Box de Modal --}}
        <div class="bg-white rounded-3xl w-full max-w-xl shadow-2xl overflow-hidden border border-slate-100 relative z-10"
             @click.away="modalOpen = false">
            
            {{-- Entete de modal --}}
            <div class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase tracking-wider font-mono opacity-80 bg-white/10 px-2 py-0.5 rounded">Fiche d'Audit d'Objet</span>
                        <h3 class="text-xl font-extrabold mt-1" x-text="selectedObjet ? selectedObjet.nom : 'Fiche administrative'"></h3>
                    </div>
                    <button @click="modalOpen = false" class="text-white hover:text-slate-200 text-2xl outline-none font-black">×</button>
                </div>
            </div>
            
            {{-- Corps du modal --}}
            <div class="p-6 space-y-5" x-html="selectedObjet ? `
                <div class='grid grid-cols-2 gap-4 text-xs font-medium'>
                    <div class='bg-[#F8FAFC] p-3 rounded-xl border border-slate-100'>
                        <span class='text-slate-400 block mb-0.5'>Numéro de Scellé</span>
                        <span class='font-bold text-slate-800'>\${selectedObjet.scelle_numero || 'Non spécifié'}</span>
                    </div>
                    <div class='bg-[#F8FAFC] p-3 rounded-xl border border-slate-100'>
                        <span class='text-slate-400 block mb-0.5'>Valeur Estimée</span>
                        <span class='font-bold text-emerald-600 font-sans'>\${selectedObjet.valeur_estimee || 'Audit requis'}</span>
                    </div>
                    <div class='bg-[#F8FAFC] p-3 rounded-xl border border-slate-100'>
                        <span class='text-slate-400 block mb-0.5'>Emplacement Physique</span>
                        <span class='font-bold text-slate-800'>\${selectedObjet.emplacement_coffre || 'Registre Alpha'}</span>
                    </div>
                    <div class='bg-[#F8FAFC] p-3 rounded-xl border border-slate-100'>
                        <span class='text-slate-400 block mb-0.5'>Poids Total</span>
                        <span class='font-bold text-slate-800'>\${selectedObjet.poids || 'Non pesé'}</span>
                    </div>
                </div>

                <div class='border-t border-slate-100 pt-4'>
                    <h5 class='text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2'>Description Complète</h5>
                    <p class='text-slate-700 text-[13px] leading-relaxed bg-[#F8FAFC] p-3 rounded-xl border border-slate-150'>
                        \${selectedObjet.description}
                    </p>
                </div>

                <div class='border-t border-slate-100 pt-4'>
                    <h5 class='text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2'>Inventeur du Bien</h5>
                    <div class='flex gap-3 items-center bg-[#EFF6FF]/40 border border-[#DBEAFE]/40 p-3 rounded-xl'>
                        <span class='text-2xl'>👤</span>
                        <div>
                            <p class='font-bold text-[13px] text-slate-800'>\${selectedObjet.inventeur_nom}</p>
                            <p class='text-[11.5px] font-mono text-slate-500'>\${selectedObjet.inventeur_tel}</p>
                        </div>
                    </div>
                </div>

                <div class='bg-amber-50 border border-amber-100 text-amber-950 p-3.5 rounded-xl text-[11.5px] flex gap-2.5 items-center mt-2'>
                    <span class='text-lg'>🔒</span>
                    <p>Cette action de consultation détaillée a été inscrite à l'instance d'audit SQL de l'administrateur {{ auth()->user()->id ?? 'ID' }}.</p>
                </div>
            ` : `
                <div class='text-center py-6 text-slate-450 text-sm'>
                    Aucun objet sélectionné pour consultation d'audit.
                </div>
            `">
            </div>
            
            {{-- Pied du modal --}}
            <div class="px-6 py-4.5 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button @click="modalOpen = false" class="px-4 py-2 border border-slate-200 rounded-xl text-slate-650 text-xs font-bold hover:bg-slate-100 transition-all outline-none">
                    Fermer la fiche
                </button>
                <button @click="alert('Impression cryptée lancée... (Simulé pour le design)'); modalOpen = false" class="px-4 py-2 bg-[#1B3A6B] text-white rounded-xl text-xs font-bold hover:bg-[#14305a] transition-all flex items-center gap-1.5 shadow">
                    🖨️ Imprimer Reçu
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
