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
    Schema::create('declaration_pertes', function (Blueprint $table) {
        $table->id();

        // ── Lien avec le propriétaire ──
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');   // si l'user est supprimé → sa déclaration aussi

        // ── Infos sur l'objet perdu ──
        $table->string('nom');
        $table->string('categorie');
        $table->text('description');
        $table->string('signes_particuliers')->nullable(); // signes distinctifs

        // ── Lieu & Date ──
        $table->string('lieu');
        $table->date('date_perte');

        // ── Statut ──
        $table->enum('statut', [
            'en_attente',
            'en_cours',
            'retrouve'
        ])->default('en_attente');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_pertes');
    }
};
