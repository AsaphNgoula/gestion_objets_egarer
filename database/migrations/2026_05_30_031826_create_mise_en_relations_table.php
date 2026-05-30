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
    Schema::create('mise_en_relations', function (Blueprint $table) {
        $table->id();

        // ── Liens ──
        $table->foreignId('objet_trouve_id')
              ->constrained('objet_trouves')
              ->onDelete('cascade');

        $table->foreignId('declaration_perte_id')
              ->constrained('declaration_pertes')
              ->onDelete('cascade');

        $table->foreignId('admin_id')
              ->constrained('users')
              ->onDelete('cascade');

        // ── Infos ──
        $table->text('note')->nullable();       // note de l'admin
        $table->integer('score')->default(0);   // score de correspondance

        // ── Statut ──
        $table->enum('statut', [
            'en_attente',
            'en_cours',
            'confirme',
            'restitue'
        ])->default('en_attente');

        // ── Email envoyé ? ──
        $table->boolean('email_inventeur')->default(false);
        $table->boolean('email_proprietaire')->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mise_en_relations');
    }
};
