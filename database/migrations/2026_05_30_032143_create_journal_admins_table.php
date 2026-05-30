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
    Schema::create('journal_admins', function (Blueprint $table) {
        $table->id();

        // ── Lien avec l'admin ──
        $table->foreignId('admin_id')
              ->constrained('users')
              ->onDelete('cascade');

        // ── Type d'action ──
        $table->enum('action', [
            'consultation',
            'relation',
            'notification',
            'validation',
            'connexion'
        ]);

        // ── Détail de l'action ──
        $table->string('detail');

        // ── Objet concerné (optionnel) ──
        $table->foreignId('objet_trouve_id')
              ->nullable()
              ->constrained('objet_trouves')
              ->onDelete('set null');

        // ── Adresse IP ──
        $table->string('ip_address')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_admins');
    }
};
