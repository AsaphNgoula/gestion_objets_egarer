<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title') — Admin DschangLost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')

</head>
<body class="bg-[#F0F4F8] min-h-screen">

<div class="flex min-h-screen">

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="w-[240px] bg-[#1B3A6B] min-h-screen fixed top-0 left-0
                  flex flex-col z-50 border-r-4 border-[#C8992A]
                  transition-transform duration-300"
           id="sidebar">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b border-white/10">
            <div class="w-10 h-10 bg-[#C8992A] rounded-xl flex items-center
                        justify-content text-white text-lg flex-shrink-0 justify-center">
                🛡
            </div>
            <div>
                <span class="text-white font-black text-[15px] block">Admin</span>
                <span class="text-[#93B8E8] text-[10px] uppercase tracking-widest">Dschang</span>
            </div>
            <button id="sidebar-close"
                    class="ml-auto text-white/50 hover:text-white md:hidden text-lg">
                ✕
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 overflow-y-auto">

            <p class="text-white/30 text-[10px] font-bold uppercase tracking-[2px] px-2 mb-2">
                Principal
            </p>
            <ul class="flex flex-col gap-1 mb-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.dashboard')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        📊 <span>Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.coffre-fort') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.coffre-fort')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        🔒 <span>Coffre-fort</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.comparaison') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.comparaison')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        🔀 <span>Comparaison</span>
                    </a>
                </li>
            </ul>

            <p class="text-white/30 text-[10px] font-bold uppercase tracking-[2px] px-2 mb-2">
                Gestion
            </p>
            <ul class="flex flex-col gap-1 mb-4">
                <li>
                    <a href="{{ route('admin.demandes') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.demandes')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        ✉️ <span>Demandes</span>
                        @php
                            $nonLus = \App\Models\DemandeAssistance::where('statut','non_lu')->count();
                        @endphp
                        @if($nonLus > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px]
                                         font-bold px-2 py-0.5 rounded-full">
                                {{ $nonLus }}
                            </span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mise-en-relation') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.mise-en-relation')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        🤝 <span>Mise en relation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.journal') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium transition
                              {{ request()->routeIs('admin.journal')
                                 ? 'bg-[#C8992A]/20 text-white border-l-[3px] border-[#C8992A] pl-[9px]'
                                 : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        📜 <span>Journal</span>
                    </a>
                </li>
            </ul>

            <p class="text-white/30 text-[10px] font-bold uppercase tracking-[2px] px-2 mb-2">
                Compte
            </p>
            <ul class="flex flex-col gap-1">
                <li>
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13.5px]
                              font-medium text-white/70 hover:bg-white/10 hover:text-white transition">
                        🌐 <span>Voir le site</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg
                                       text-[13.5px] font-medium text-red-400
                                       hover:bg-red-500/10 hover:text-red-300 transition">
                            🚪 <span>Déconnexion</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

    </aside>

    {{-- ═══ MAIN ═══ --}}
    <div class="flex-1 ml-[240px] flex flex-col min-h-screen" id="admin-main">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-7 h-16
                        flex items-center justify-between sticky top-0 z-40
                        shadow-sm">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle"
                        class="hidden md:hidden text-gray-500 hover:text-[#1B3A6B]
                               text-xl p-1 rounded-lg hover:bg-gray-100 transition">
                    ☰
                </button>
                <div class="flex items-center gap-2 text-[13px] text-gray-500">
                    <span>Admin</span>
                    <span class="text-gray-300">›</span>
                    <span class="text-[#1B3A6B] font-bold">@yield('breadcrumb')</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-[13px] text-gray-500 hidden sm:block">
                    {{ now()->format('d/m/Y') }}
                </span>
                <div class="flex items-center gap-2 bg-[#F1F5F9] px-3 py-2 rounded-lg">
                    <div class="w-7 h-7 bg-[#1B3A6B] rounded-full flex items-center
                                justify-center text-white text-[12px] font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-[13px] font-semibold text-[#1B3A6B]">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </header>

        {{-- Contenu --}}
        <main class="flex-1 p-7">

            {{-- Message succès --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl px-5 py-3 mb-6
                            flex items-center gap-3 text-green-700 text-[13.5px]">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Message erreur --}}
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-3 mb-6
                            flex items-center gap-3 text-red-700 text-[13.5px]">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

{{-- Overlay mobile --}}
<div id="sidebar-overlay"
     class="hidden fixed inset-0 bg-black/50 z-40 md:hidden backdrop-blur-sm"></div>

</body>
</html>