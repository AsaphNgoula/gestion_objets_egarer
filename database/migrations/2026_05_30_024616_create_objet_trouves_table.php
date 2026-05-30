<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('objet_trouves', function (Blueprint $table) {
        $table->id();                              // clé primaire auto

        // ── Infos sur l'objet ──
        $table->string('nom');                     // nom de l'objet
        $table->string('categorie');               // electronique, sac, cle...
        $table->text('description');               // description détaillée
        $table->string('photo_path')->nullable();  // chemin photo (privé)

        // ── Lieu & Date ──
        $table->string('lieu');                    // quartier de Dschang
        $table->string('lieu_detail')->nullable(); // précision optionnelle
        $table->date('date_decouverte');           // date de découverte
        $table->time('heure_decouverte')->nullable(); // heure optionnelle

        // ── Inventeur anonyme ──
        $table->string('inventeur_nom');           // nom de l'inventeur
        $table->string('inventeur_tel');           // téléphone

        // ── Statut ──
        $table->enum('statut', [
            'en_attente',
            'en_cours',
            'restitue'
        ])->default('en_attente');

        $table->timestamps();                      // created_at + updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objet_trouves');
    }
};
