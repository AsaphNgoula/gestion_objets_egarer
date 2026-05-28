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
                {{-- Si connecté : afficher le nom --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white text-[13.5px] font-bold px-5 py-2 rounded-lg shadow hover:bg-[#b8861e] transition">
                    👤 {{ Auth::user()->name }}
                </a>
            @else
                {{-- Sinon : bouton Se connecter --}}
                <a href="{{ route('login') }}"
                   class="flex items-center gap-2 bg-[#C8992A] text-white text-[13.5px] font-bold px-5 py-2 rounded-lg shadow hover:bg-[#b8861e] transition">
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
            <a href="{{ route('login') }}" class="mt-2 bg-[#C8992A] text-white font-bold text-[14px] py-3 px-3 rounded-lg text-center">Se connecter</a>
        @endguest
    </div>
</nav>