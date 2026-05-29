<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion — DschangLost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen relative overflow-hidden">

    {{-- IMAGE DE FOND --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/dschang1.jpg') }}"
             alt="Dschang"
             class="w-full h-full object-cover"/>
        {{-- Overlay dégradé bleu --}}
        <div class="absolute inset-0 bg-gradient-to-br from-[#1B3A6B]/90 via-[#1B3A6B]/75 to-[#0f2244]/90"></div>
    </div>

    {{-- NAVBAR MINIMALE --}}
    <nav class="relative z-10 px-8 py-5 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#C8992A] rounded-xl flex items-center justify-center text-white text-lg shadow-lg">
                🛡
            </div>
            <div>
                <span class="text-white font-black text-[15px] block leading-tight">Objets Égarés</span>
                <span class="text-[#93B8E8] text-[10px] uppercase tracking-widest">Dschang</span>
            </div>
        </a>
        <a href="{{ route('home') }}"
           class="text-white/70 text-[13px] hover:text-white transition flex items-center gap-2">
            ← Retour à l'accueil
        </a>
    </nav>

    {{-- CONTENU CENTRÉ --}}
    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-80px)] px-4 py-8">

        <div class="w-full max-w-[420px]">

            {{-- TITRE AU DESSUS --}}
            <div class="text-center mb-8">
                <h1 class="text-white font-black text-4xl mb-2" style="font-family:Georgia,serif">
                    Connexion
                </h1>
                <p class="text-white/65 text-[14px]">
                    Connectez-vous pour gérer vos déclarations<br>et suivre vos alertes
                </p>
            </div>

            {{-- CARD FORMULAIRE --}}
            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden
                        border border-white/20">

                {{-- BANDE COULEUR EN HAUT --}}
                <div class="h-1.5 bg-gradient-to-r from-[#1B3A6B] via-[#2D5FA8] to-[#C8992A]"></div>

                <div class="px-8 py-8">

                    {{-- MESSAGE SUCCÈS --}}
                    @if (session('status'))
                        <div class="bg-green-50 border border-green-200 rounded-xl px-4 py-3 mb-5">
                            <p class="text-green-700 text-[13px] flex items-center gap-2">
                                ✅ {{ session('status') }}
                            </p>
                        </div>
                    @endif

                    {{-- ERREURS --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-5">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-600 text-[13px] flex items-center gap-2">
                                    ⚠️ {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                        @csrf

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide mb-2">
                                Email ou téléphone
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    ✉️
                                </span>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       placeholder="exemple@gmail.com"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- MOT DE PASSE --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-[12.5px] font-bold text-gray-600 uppercase tracking-wide">
                                    Mot de passe
                                </label>
                                <a href="{{ route('password.request') }}"
                                   class="text-[#2D5FA8] text-[12px] font-semibold hover:underline">
                                    Oublié ?
                                </a>
                            </div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[15px]">
                                    🔒
                                </span>
                                <input type="password"
                                       name="password"
                                       required
                                       placeholder="••••••••"
                                       class="w-full pl-10 pr-4 py-3 border-2 rounded-xl text-[14px]
                                              text-gray-800 bg-gray-50 outline-none transition-all
                                              focus:border-[#2D5FA8] focus:bg-white focus:shadow-sm
                                              @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror"/>
                            </div>
                        </div>

                        {{-- SE SOUVENIR --}}
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember" id="remember"
                                   class="w-4 h-4 accent-[#1B3A6B] cursor-pointer"/>
                            <label for="remember" class="text-[13px] text-gray-500 cursor-pointer">
                                Se souvenir de moi
                            </label>
                        </div>

                        {{-- BOUTON CONNEXION --}}
                        <button type="submit"
                                class="w-full bg-[#1B3A6B] text-white font-black text-[15px] py-3.5
                                       rounded-xl shadow-lg transition-all duration-200
                                       hover:bg-[#14305a] hover:-translate-y-0.5 hover:shadow-xl
                                       active:translate-y-0 flex items-center justify-center gap-2">
                            🔑 Se connecter
                        </button>

                    </form>

                    {{-- SÉPARATEUR --}}
                    <div class="flex items-center gap-3 my-6">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-gray-400 text-[12px] font-medium">ou</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- LIEN INSCRIPTION --}}
                    <a href="{{ route('register') }}"
                       class="w-full border-2 border-[#C8992A] text-[#C8992A] font-bold text-[14px]
                              py-3 rounded-xl transition-all duration-200
                              hover:bg-[#C8992A] hover:text-white
                              flex items-center justify-center gap-2">
                        👤 Pas encore de compte ? S'inscrire
                    </a>

                </div>
            </div>

            {{-- NOTE SÉCURITÉ --}}
            <p class="text-center text-white/40 text-[12px] mt-5 flex items-center justify-center gap-2">
                🔒 Connexion sécurisée — DschangLost · Ville de Dschang
            </p>

        </div>
    </div>

</body>
</html>