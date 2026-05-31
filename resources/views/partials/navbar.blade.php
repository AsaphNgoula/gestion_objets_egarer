<nav class="bg-[#1B3A6B] border-b-4 border-[#C8992A] sticky top-0 z-50 shadow-lg">
    <div class="max-w-6xl mx-auto px-6 h-[68px] flex items-center justify-between">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-[42px] h-[42px] bg-[#C8992A] rounded-xl flex items-center justify-center text-white text-lg shadow-md">
                🛡
            </div>
            <div class="flex flex-col">
                <span class="text-white font-black text-[15px]">Objets Égarés</span>
                <span class="text-[#93B8E8] text-[10px] uppercase tracking-widest">Dschang</span>
            </div>
        </a>

        {{-- LIENS (desktop) --}}
        <ul class="hidden md:flex items-center gap-1 list-none">
            <li>
                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-lg text-[13.5px] font-medium text-white/80 hover:text-white hover:bg-white/10 transition
                          {{ request()->routeIs('home') ? 'bg-white/10 text-white border-b-2 border-[#C8992A]' : '' }}">
                    Accueil
                </a>
            </li>
            <li>
                <a href="{{ route('objets.index') }}"
                   class="px-4 py-2 rounded-lg text-[13.5px] font-medium text-white/80 hover:text-white hover:bg-white/10 transition
                          {{ request()->routeIs('objets.index') ? 'bg-white/10 text-white border-b-2 border-[#C8992A]' : '' }}">
                    Objets trouvés
                </a>
            </li>
            <li>
                <a href="{{ route('deposer') }}"
                   class="px-4 py-2 rounded-lg text-[13.5px] font-medium text-white/80 hover:text-white hover:bg-white/10 transition
                          {{ request()->routeIs('deposer') ? 'bg-white/10 text-white border-b-2 border-[#C8992A]' : '' }}">
                    Déclarer un objet
                </a>
            </li>
            <li>
                <a href="{{ route('comment') }}"
                   class="px-4 py-2 rounded-lg text-[13.5px] font-medium text-white/80 hover:text-white hover:bg-white/10 transition
                          {{ request()->routeIs('comment') ? 'bg-white/10 text-white border-b-2 border-[#C8992A]' : '' }}">
                    Comment ça marche
                </a>
            </li>
        </ul>

        {{-- BOUTON + HAMBURGER --}}
        <div class="flex items-center gap-3">

        @auth
            <div class="relative" id="user-menu-wrapper">

                <button id="user-menu-btn"
                        class="flex items-center gap-2 bg-[#C8992A] text-white text-[13.5px]
                            font-bold px-4 py-2 rounded-lg shadow hover:bg-[#b8861e] transition">

                    {{-- Icône selon le rôle --}}
                    @if(Auth::user()->isAdmin())
                        ⚙️
                    @else
                        👤
                    @endif

                    {{ Auth::user()->name }}
                    <span class="text-[10px]">▼</span>
                </button>

                {{-- Dropdown --}}
                <div id="user-dropdown"
                    class="hidden absolute right-0 top-12 w-52 bg-white rounded-xl
                            shadow-xl border border-gray-100 overflow-hidden z-50">

                    {{-- Info utilisateur --}}
                    <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                        <p class="text-[13px] font-black text-[#1B3A6B]">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-[11px] text-gray-400">
                            {{ Auth::user()->isAdmin() ? '⚙️ Administrateur' : '👤 Propriétaire' }}
                        </p>
                    </div>

                    {{-- Lien Mon Espace selon rôle --}}
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-2 px-4 py-3 text-[13.5px]
                                text-gray-700 hover:bg-[#EFF6FF] hover:text-[#1B3A6B]
                                transition font-medium">
                            📊 Dashboard Admin
                        </a>
                        <a href="{{ route('admin.coffre-fort') }}"
                        class="flex items-center gap-2 px-4 py-3 text-[13.5px]
                                text-gray-700 hover:bg-[#EFF6FF] hover:text-[#1B3A6B]
                                transition font-medium">
                            🔒 Coffre-fort
                        </a>
                    @else
                        <a href="{{ route('proprietaire.dashboard') }}"
                        class="flex items-center gap-2 px-4 py-3 text-[13.5px]
                                text-gray-700 hover:bg-[#EFF6FF] hover:text-[#1B3A6B]
                                transition font-medium">
                            🏠 Mon espace
                        </a>
                        <a href="{{ route('proprietaire.declarer') }}"
                        class="flex items-center gap-2 px-4 py-3 text-[13.5px]
                                text-gray-700 hover:bg-[#EFF6FF] hover:text-[#1B3A6B]
                                transition font-medium">
                            📝 Déclarer une perte
                        </a>
                        <a href="{{ route('proprietaire.alertes') }}"
                        class="flex items-center gap-2 px-4 py-3 text-[13.5px]
                                text-gray-700 hover:bg-[#EFF6FF] hover:text-[#1B3A6B]
                                transition font-medium">
                            🔔 Mes alertes
                        </a>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    {{-- Déconnexion --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-2 px-4 py-3 text-[13.5px]
                                    text-red-500 hover:bg-red-50 transition font-medium">
                            🚪 Se déconnecter
                        </button>
                    </form>

                </div>
            </div>
        @else
            <a href="{{ route('login') }}"
            class="flex items-center gap-2 bg-[#C8992A] text-white text-[13.5px]
                    font-bold px-5 py-2 rounded-lg shadow hover:bg-[#b8861e] transition">
                Se connecter
            </a>
        @endauth
            {{-- Hamburger mobile --}}
            <button id="hamburger" class="md:hidden flex flex-col gap-[5px] p-1 bg-transparent border-none cursor-pointer">
                <span class="block w-6 h-[2.5px] bg-white rounded"></span>
                <span class="block w-6 h-[2.5px] bg-white rounded"></span>
                <span class="block w-6 h-[2.5px] bg-white rounded"></span>
            </button>

        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div id="mobile-menu" class="hidden md:hidden bg-[#14305a] border-t border-white/10 px-6 py-3 flex flex-col gap-1">
        <a href="{{ route('home') }}" class="text-white/80 text-[14px] font-medium py-2 px-3 rounded-lg hover:bg-white/10 transition">Accueil</a>
        <a href="{{ route('objets.index') }}" class="text-white/80 text-[14px] font-medium py-2 px-3 rounded-lg hover:bg-white/10 transition">Objets trouvés</a>
        <a href="{{ route('deposer') }}" class="text-white/80 text-[14px] font-medium py-2 px-3 rounded-lg hover:bg-white/10 transition">Déclarer un objet</a>
        <a href="{{ route('comment') }}" class="text-white/80 text-[14px] font-medium py-2 px-3 rounded-lg hover:bg-white/10 transition">Comment ça marche</a>
        @guest
            <div class="navbar-mobile" id="mobile-menu">
                <a href="{{ route('home') }}"><i class="fas fa-house"></i>Accueil</a>
                <a href="{{ route('objets.index') }}"><i class="fas fa-magnifying-glass"></i>Objets trouvés</a>
                <a href="{{ route('deposer') }}"><i class="fas fa-box-open"></i>Déclarer un objet</a>
                <a href="{{ route('comment') }}"><i class="fas fa-circle-info"></i>Comment ça marche</a>
                <a href="#contact"><i class="fas fa-envelope"></i>Contact</a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                        class="font-bold text-[#C8992A]">
                            ⚙️ Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('proprietaire.dashboard') }}"
                        class="font-bold text-[#C8992A]">
                            👤 Mon espace
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left text-red-400 py-2 px-3
                                    rounded-lg hover:bg-white/10 transition text-[14px]">
                            🚪 Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-connect-mobile">
                        Se connecter
                    </a>
                @endauth
            </div>
        @endguest
    </div>
</nav>