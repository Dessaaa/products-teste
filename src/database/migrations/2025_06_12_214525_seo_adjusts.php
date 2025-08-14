<?php

use App\Domains\Redirect\Models\RedirectModel;
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
        $redirects = [
            ['slug_from' => '/produtos-servicos/maquinas-agricolas/distribuidores/hercules-15000-e-10000-inox', 'slug_to' => '/produtos-servicos/maquinas-agricolas/distribuidores/distribuidor-agricola-hercules-24000-15000-e-10000-inox'],
            ['slug_from' => '/web/index.php?menu=produtos&language=pt', 'slug_to' => '/produtos-servicos'],
        ];

        foreach ($redirects as $redirect) {
            RedirectModel::firstOrCreate([
                'slug_from' => $redirect['slug_from'],
                'slug_to' => $redirect['slug_to']
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
