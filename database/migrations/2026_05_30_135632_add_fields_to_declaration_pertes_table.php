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
        Schema::table('declaration_pertes', function (Blueprint $table) {
            $table->string('marque')->nullable()->after('nom');
            $table->string('couleur')->nullable()->after('marque');
            $table->string('heure_perte')->nullable()->after('date_perte');
            $table->string('lieu_precis')->nullable()->after('lieu');
            $table->text('circonstances')->nullable()->after('description');
            $table->string('moyen_contact')->default('telephone')->after('circonstances');
            $table->text('commentaires')->nullable()->after('moyen_contact');
            $table->string('photo_justificatif')->nullable()->after('commentaires');
        });
    }

    public function down(): void
    {
        Schema::table('declaration_pertes', function (Blueprint $table) {
            $table->dropColumn([
                'marque', 'couleur', 'heure_perte', 'lieu_precis',
                'circonstances', 'moyen_contact', 'commentaires', 'photo_justificatif'
            ]);
        });
    }
};
