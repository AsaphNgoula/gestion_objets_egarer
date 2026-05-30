<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Connexion — DschangLost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Animations clés */
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.96); }
            to   { opacity: 1; transform: scale(1); }
        }
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(25px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50%      { transform: translateY(-8px); }
        }
        @keyframes shine {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes borderPulse {
            0%, 100% { border-color: rgba(255,255,255,0.2); box-shadow: 0 0 0 0 rgba(45,95,168,0.2); }
            50%      { border-color: rgba(200,153,42,0.5); box-shadow: 0 0 0 4px rgba(45,95,168,0.1); }
        }

        /* Classes d'animation */
        .animate-fade-scale {
            animation: fadeInScale 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }
        .animate-slide-up {
            animation: slideUpFade 0.5s ease-out forwards;
        }
        .animate-float-slow {
            animation: gentleFloat 6s ease-in-out infinite;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Effets de survol et focus */
        .input-fancy {
            transition: all 0.25s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(4px);
        }
        .input-fancy:focus {
            background: rgba(255,255,255,0.15);
            box-shadow: 0 4px 14px rgba(0,0,0,0.1), inset 0 0 0 1px rgba(200,153,42,0.4);
            transform: translateY(-1px);
        }
        .btn-gold {
            background: linear-gradient(135deg, #C8992A 0%, #e0ad35 100%);
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -12px rgba(200,153,42,0.4);
            background: linear-gradient(135deg, #d4a32e 0%, #f0bc45 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .glass-card-dark {
            background: rgba(27, 58, 107, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(200,153,42,0.3);
        }
        .focus-glow:focus {
            outline: none;
            ring: 2px solid #C8992A;
            ring-offset: 2px;
        }
    </style>
</head>

<body class="min-h-screen relative font-['Inter'] antialiased">

    {{-- IMAGE DE FOND PLEIN ÉCRAN --}}
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('images/insc.jpeg') }}"
             alt="Dschang paysage"
             class="w-full h-full object-cover object-center scale-105 animate-float-slow">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0a1a2e]/85 via-[#1B3A6B]/75 to-[#0f2244]/90"></div>
        <!-- Motif subtil en overlay -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.02"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
    </div>

    {{-- NAVBAR ÉPURÉE --}}
    <nav class="relative z-20 px-6 md:px-10 py-5 flex items-center justify-between max-w-7xl mx-auto">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group transition-transform hover:scale-105 duration-200">
            <div class="w-10 h-10 bg-gradient-to-br from-[#C8992A] to-[#e0ad35] rounded-xl flex items-center justify-center text-white shadow-lg">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
            </div>
            <div>
                <span class="text-white font-extrabold text-[15px] block leading-tight drop-shadow-sm">Objets Égarés</span>
                <span class="text-[#93B8E8] text-[10px] uppercase tracking-widest font-semibold">Dschang</span>
            </div>
        </a>
        <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium hover:bg-white/20">
            ← Retour à l'accueil
        </a>
    </nav>

    {{-- CONTENEUR PRINCIPAL CENTRÉ --}}
    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-80px)] px-4 py-8">
        <div class="w-full max-w-[460px]">

            {{-- TITRE AVEC ANIMATION --}}
            <div class="text-center mb-8 animate-slide-up">
                <h1 class="text-white font-black text-4xl md:text-5xl mb-3 font-['Playfair_Display'] tracking-tight">
                    Connexion
                </h1>
                <div class="w-20 h-1 bg-[#C8992A] rounded-full mx-auto mb-4"></div>
                <p class="text-white/70 text-sm md:text-base font-light">
                    Accédez à votre espace personnel
                </p>
            </div>

            {{-- CARD PRINCIPALE (GLASSMORPHISM) --}}
            <div class="glass-card-dark rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-fade-scale">
                <!-- Bande décorative lumineuse -->
                <div class="h-1.5 bg-gradient-to-r from-[#C8992A] via-[#2D5FA8] to-[#1B3A6B] w-full"></div>

                <div class="p-6 md:p-8">

                    {{-- Message de succès (reset password par exemple) --}}
                    @if (session('status'))
                        <div class="bg-green-500/10 border border-green-500/30 rounded-xl px-4 py-3 mb-5 backdrop-blur-sm">
                            <p class="text-green-200 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ session('status') }}
                            </p>
                        </div>
                    @endif

                    {{-- Erreurs de validation --}}
                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3 mb-5 backdrop-blur-sm">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-200 text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        {{-- Champ EMAIL / TÉLÉPHONE --}}
                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-bold text-white/80 uppercase tracking-wider ml-1">
                                Email ou téléphone
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="exemple@gmail.com"
                                       class="input-fancy w-full pl-10 pr-4 py-3 rounded-xl text-white placeholder-white/40 border border-white/20 focus:border-[#C8992A]/60 focus:outline-none transition-all text-sm bg-white/5">
                            </div>
                        </div>

                        {{-- Champ MOT DE PASSE --}}
                        <div class="space-y-1.5">
                            <div class="flex justify-between items-center ml-1">
                                <label class="block text-[11px] font-bold text-white/80 uppercase tracking-wider">
                                    Mot de passe
                                </label>
                                <a href="{{ route('password.request') }}" class="text-[11px] text-[#C8992A] hover:text-white transition font-medium">
                                    Oublié ?
                                </a>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       required
                                       placeholder="••••••••"
                                       class="input-fancy w-full pl-10 pr-10 py-3 rounded-xl text-white placeholder-white/40 border border-white/20 focus:border-[#C8992A]/60 focus:outline-none transition-all text-sm bg-white/5">
                                <button type="button"
                                        onclick="togglePassword()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white transition">
                                    <svg id="toggleIcon" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Se souvenir de moi --}}
                        <div class="flex items-center gap-2 pl-1">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-white/30 bg-white/5 text-[#C8992A] focus:ring-[#C8992A] focus:ring-offset-0">
                            <label for="remember" class="text-white/70 text-sm cursor-pointer select-none">
                                Se souvenir de moi
                            </label>
                        </div>

                        {{-- Bouton connexion premium --}}
                        <button type="submit"
                                class="btn-gold w-full text-white font-extrabold text-base py-3.5 rounded-xl shadow-md transition-all duration-300 flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14.5M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>
                            </svg>
                            Se connecter
                        </button>
                    </form>

                    {{-- Séparateur élégant --}}
                    <div class="flex items-center gap-3 my-6">
                        <div class="flex-1 h-px bg-white/20"></div>
                        <span class="text-white/40 text-[11px] font-bold tracking-wider">OU</span>
                        <div class="flex-1 h-px bg-white/20"></div>
                    </div>

                    {{-- Lien vers l'inscription --}}
                    <a href="{{ route('register') }}"
                       class="w-full flex items-center justify-center gap-2 border-2 border-white/30 text-white font-bold text-sm py-3 rounded-xl transition-all duration-300 hover:border-[#C8992A] hover:bg-white/10 hover:shadow-md group">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Pas encore de compte ? S'inscrire
                    </a>
                </div>
            </div>

            {{-- Badge de confiance --}}
            <div class="text-center mt-6 flex items-center justify-center gap-3 text-white/50 text-xs font-medium">
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A10 10 0 0010 2.5a10 10 0 007.834 2.5 10 10 0 01-.002 10 10 10 0 01-7.832 2.5A10 10 0 002.166 15a10 10 0 010-10z" clip-rule="evenodd"/><path d="M10 6a4 4 0 100 8 4 4 0 000-8z"/></svg>
                    <span>SSL Sécurisé</span>
                </div>
                <div class="w-1 h-1 bg-white/30 rounded-full"></div>
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    <span>Données confidentielles</span>
                </div>
                <div class="w-1 h-1 bg-white/30 rounded-full"></div>
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
                    <span>Assistance 24/7</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Script léger pour toggle password (sans dépendance externe) --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                // change l'icône pour "œil barré" (optionnel)
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }
    </script>
</body>
</html>