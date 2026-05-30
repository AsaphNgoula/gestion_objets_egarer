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
    Schema::create('demande_assistances', function (Blueprint $table) {
        $table->id();

        // ── Liens ──
        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');

        $table->foreignId('declaration_perte_id')
              ->constrained('declaration_pertes')
              ->onDelete('cascade');

        // ── Message ──
        $table->text('message');

        // ── Statut ──
        $table->enum('statut', [
            'non_lu',
            'lu',
            'traite'
        ])->default('non_lu');

        // ── Réponse admin ──
        $table->text('reponse_admin')->nullable();
        $table->timestamp('reponse_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_assistances');
    }
};
