<?php

use App\Domains\FormProduct\Models\FormProductModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $productNames = [
            'Absoluta',
            'Asa Laser',
            'Brava +',
            'Bruttus 12000',
            'Bruttus 18000',
            'Bruttus 25000',
            'Ceres e Ceres Master',
            'Cinderela',
            'Estrela',
            'Eva',
            'Fox',
            'Guapa',
            'Guapa Supra e Guapa Winter',
            'Guapita',
            'Hércules 10000, 15000 e 24000',
            'Hércules 4.0',
            'Hércules 6.0',
            'Hércules Caminhão',
            'Imperador 2000',
            'Imperador 2000 PV',
            'Imperador 2500',
            'Imperador 3.0',
            'Imperador 3000',
            'Imperador 4000',
            'PAD',
            'Princesa',
            'Reboke 11000',
            'Reboke 15000',
            'Reboke Inox',
            'Reboke Ninja',
            'Starplan',
            'Tornado 1300',
            'Twister 1500',
            'Veris',
            'Correção de Sinal',
            'Syncro',
            'Zero Amassamento',
        ];

        $products = array_map(function ($name) {
            return ['name' => $name];
        }, $productNames);

        FormProductModel::insert($products);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
