<nav class="bg-gradient-to-r from-[#1B3A6B] to-[#2D5FA8] border-b-2 border-[#C8992A]/40 sticky top-0 z-50 shadow-lg backdrop-blur-sm bg-opacity-95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-[72px] flex items-center justify-between relative">

            {{-- LOGO SECTION --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                <div class="relative w-[48px] h-[48px] bg-gradient-to-br from-[#C8992A] to-[#A67E1F] 
                            rounded-2xl flex items-center justify-center text-2xl shadow-lg
                            group-hover:shadow-2xl group-hover:from-[#D4A538] group-hover:to-[#B68A2A]
                            transition-all duration-300 group-hover:scale-110 group-hover:-rotate-6">
                    <span class="block transition-transform group-hover:scale-125">🛡</span>
                    <div class="absolute inset-0 rounded-2xl bg-white/0 group-hover:bg-white/10 transition-all duration-300"></div>
                </div>
                
                <div class="flex flex-col justify-center">
                    <span class="text-white font-black text-[16px] leading-none 
                                group-hover:text-[#C8992A] transition-colors duration-300">
                        Objets Égarés
                    </span>
                    <span class="text-[#93B8E8] text-[10px] uppercase tracking-[2px] font-bold 
                                group-hover:text-[#FFD700] transition-colors duration-300">
                        Dschang
                    </span>
                </div>
            </a>

            {{-- NAV DESKTOP --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['Accueil', 'home'],
                        ['Objets trouvés', 'objets.index'],
                        ['Déclarer un objet', 'deposer'],
                        ['Comment ça marche', 'comment'],
                    ];
                @endphp

                @foreach($navLinks as [$label, $route])
                    <a href="{{ route($route) }}"
                       class="px-5 py-2.5 rounded-xl text-[13.5px] font-semibold
                              relative group text-white/80 hover:text-white transition-colors duration-300
                              {{ request()->routeIs($route) ? 'text-white' : '' }}">
                        
                        {{-- Animated background --}}
                        <span class="absolute inset-0 bg-gradient-to-r from-white/0 to-white/0
                                    group-hover:from-white/10 group-hover:to-white/5
                                    rounded-xl transition-all duration-300"></span>
                        
                        <span class="relative flex items-center gap-2">
                            {{ $label }}
                        </span>

                        {{-- Bottom border animation --}}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#C8992A] to-[#FFD700]
                                    group-hover:w-full transition-all duration-300 rounded-full"></span>

                        @if(request()->routeIs($route))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-[#C8992A] to-[#FFD700] rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- RIGHT SECTION --}}
            <div class="flex items-center gap-3">

                @auth
                    {{-- USER MENU --}}
                    <div class="relative group hidden sm:block">
                        
                        <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl
                                     bg-gradient-to-r from-[#C8992A] to-[#A67E1F]
                                     hover:from-[#D4A538] hover:to-[#B68A2A]
                                     text-white text-[13.5px] font-bold
                                     shadow-lg hover:shadow-xl transition-all duration-300
                                     group-hover:scale-105">
                            
                            <span class="text-lg flex-shrink-0">
                                @if(Auth::user()->isAdmin())
                                    ⚙️
                                @else
                                    👤
                                @endif
                            </span>

                            <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4 text-white/80 group-hover:text-white transform 
                                       group-hover:rotate-180 transition-transform duration-300" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>

                        {{-- DROPDOWN MENU --}}
                        <div class="absolute right-0 top-full mt-2 w-64 opacity-0 invisible 
                                    group-hover:opacity-100 group-hover:visible transition-all duration-300
                                    transform origin-top-right group-hover:scale-100 scale-95
                                    group-hover:translate-y-0 -translate-y-2">
                            
                            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden
                                       backdrop-blur-xl">
                                
                                {{-- USER INFO --}}
                                <div class="px-6 py-4 bg-gradient-to-r from-[#EFF6FF] to-[#F0F9FF] border-b border-gray-100">
                                    <p class="text-[14px] font-black text-[#1B3A6B]">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-[12px] text-gray-500 mt-1 flex items-center gap-1">
                                        <span>@if(Auth::user()->isAdmin())⚙️ Administrateur @else 👤 Utilisateur @endif</span>
                                    </p>
                                </div>

                                {{-- MENU ITEMS --}}
                                <div class="py-2">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"
                                           class="flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                  text-gray-700 hover:bg-[#EFF6FF] hover:text-[#2D5FA8]
                                                  transition-all duration-300 font-medium group/item">
                                            <span class="text-lg">📊</span>
                                            <span class="group-hover/item:translate-x-1 transition-transform">Dashboard</span>
                                        </a>
                                        <a href="{{ route('admin.coffre-fort') }}"
                                           class="flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                  text-gray-700 hover:bg-[#EFF6FF] hover:text-[#2D5FA8]
                                                  transition-all duration-300 font-medium group/item">
                                            <span class="text-lg">🔒</span>
                                            <span class="group-hover/item:translate-x-1 transition-transform">Coffre-fort</span>
                                        </a>
                                    @else
                                        <a href="{{ route('proprietaire.dashboard') }}"
                                           class="flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                  text-gray-700 hover:bg-[#EFF6FF] hover:text-[#2D5FA8]
                                                  transition-all duration-300 font-medium group/item">
                                            <span class="text-lg">🏠</span>
                                            <span class="group-hover/item:translate-x-1 transition-transform">Mon espace</span>
                                        </a>
                                        <a href="{{ route('proprietaire.declarer') }}"
                                           class="flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                  text-gray-700 hover:bg-[#EFF6FF] hover:text-[#2D5FA8]
                                                  transition-all duration-300 font-medium group/item">
                                            <span class="text-lg">📝</span>
                                            <span class="group-hover/item:translate-x-1 transition-transform">Déclarer une perte</span>
                                        </a>
                                        <a href="{{ route('proprietaire.alertes') }}"
                                           class="flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                  text-gray-700 hover:bg-[#EFF6FF] hover:text-[#2D5FA8]
                                                  transition-all duration-300 font-medium group/item">
                                            <span class="text-lg">🔔</span>
                                            <span class="group-hover/item:translate-x-1 transition-transform">Mes alertes</span>
                                        </a>
                                    @endif
                                </div>

                                <div class="border-t border-gray-100"></div>

                                {{-- LOGOUT --}}
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-3 px-6 py-3 text-[13.5px]
                                                   text-red-500 hover:bg-red-50 transition-colors duration-300
                                                   font-medium group/item">
                                        <span class="text-lg">🚪</span>
                                        <span class="group-hover/item:translate-x-1 transition-transform">Se déconnecter</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden sm:flex items-center gap-2 px-6 py-2.5 rounded-xl
                              bg-gradient-to-r from-[#C8992A] to-[#A67E1F]
                              hover:from-[#D4A538] hover:to-[#B68A2A]
                              text-white text-[13.5px] font-bold
                              shadow-lg hover:shadow-xl transition-all duration-300
                              hover:scale-105 relative group overflow-hidden">
                        
                        <span class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-500
                                    group-hover:translate-x-full translate-x-[-100%]"></span>
                        
                        <span class="relative flex items-center gap-2">
                            <span>🔐</span> Se connecter
                        </span>
                    </a>
                @endauth

                {{-- HAMBURGER MOBILE --}}
                <button id="hamburger" class="lg:hidden flex flex-col gap-1.5 p-2 
                                             hover:bg-white/10 rounded-xl transition-all duration-300
                                             group">
                    <span class="block w-5 h-0.5 bg-white rounded-full transition-all duration-300
                                group-hover:w-6 group-hover:bg-[#FFD700]"></span>
                    <span class="block w-5 h-0.5 bg-white rounded-full transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-white rounded-full transition-all duration-300
                                group-hover:w-6 group-hover:bg-[#FFD700]"></span>
                </button>
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu" class="hidden lg:hidden max-h-0 overflow-hidden transition-all duration-300
                                      bg-gradient-to-b from-[#14305a]/50 to-transparent border-t border-white/10">
            
            <div class="px-4 py-4 space-y-1">
                @foreach($navLinks as [$label, $route])
                    <a href="{{ route($route) }}"
                       class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                              hover:bg-white/10 hover:text-white transition-all duration-300
                              {{ request()->routeIs($route) ? 'bg-white/10 text-white border-l-2 border-[#C8992A]' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach

                <div class="border-t border-white/10 my-3"></div>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                                  hover:bg-white/10 hover:text-white transition-all duration-300">
                            📊 Dashboard Admin
                        </a>
                        <a href="{{ route('admin.coffre-fort') }}"
                           class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                                  hover:bg-white/10 hover:text-white transition-all duration-300">
                            🔒 Coffre-fort
                        </a>
                    @else
                        <a href="{{ route('proprietaire.dashboard') }}"
                           class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                                  hover:bg-white/10 hover:text-white transition-all duration-300">
                            🏠 Mon espace
                        </a>
                        <a href="{{ route('proprietaire.declarer') }}"
                           class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                                  hover:bg-white/10 hover:text-white transition-all duration-300">
                            📝 Déclarer une perte
                        </a>
                        <a href="{{ route('proprietaire.alertes') }}"
                           class="block px-4 py-3 rounded-xl text-white/80 text-[14px] font-medium
                                  hover:bg-white/10 hover:text-white transition-all duration-300">
                            🔔 Mes alertes
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-3 rounded-xl text-red-400 text-[14px]
                                       font-medium hover:bg-red-500/10 transition-all duration-300">
                            🚪 Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="block w-full px-4 py-3 rounded-xl bg-gradient-to-r from-[#C8992A] to-[#A67E1F]
                              text-white text-[14px] font-bold text-center
                              hover:from-[#D4A538] hover:to-[#B68A2A] transition-all duration-300">
                        🔐 Se connecter
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    let isOpen = false;

    hamburger.addEventListener('click', () => {
        isOpen = !isOpen;
        
        if (isOpen) {
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
            mobileMenu.classList.add('visible');
        } else {
            mobileMenu.style.maxHeight = '0';
            mobileMenu.classList.remove('visible');
        }

        // Hamburger animation
        const spans = hamburger.querySelectorAll('span');
        if (isOpen) {
            spans[0].style.transform = 'rotate(45deg) translateY(12px)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'rotate(-45deg) translateY(-12px)';
        } else {
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    });

    // Close menu when clicking a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            isOpen = false;
            mobileMenu.style.maxHeight = '0';
            const spans = hamburger.querySelectorAll('span');
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        });
    });
</script>
@endpush