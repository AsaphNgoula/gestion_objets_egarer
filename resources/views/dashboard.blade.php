@extends('layouts.app')

@section('title', 'Mon Espace')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-[#F1F5F9]">
        <div class="bg-white rounded-2xl shadow-lg p-10 text-center max-w-md">

            <div class="text-5xl mb-4">🎉</div>

            <h1 class="text-[#1B3A6B] font-black text-2xl mb-2"
                style="font-family:Georgia,serif">
                Bienvenue, {{ Auth::user()->name }} !
            </h1>

            <p class="text-gray-500 text-[14px] mb-6">
                Vous êtes connecté sur DschangLost.<br>
                Le dashboard complet arrive bientôt.
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-[#DC2626] text-white font-bold px-6 py-2.5 rounded-xl
                               hover:bg-red-700 transition">
                    Se déconnecter
                </button>
            </form>

        </div>
    </div>
@endsection