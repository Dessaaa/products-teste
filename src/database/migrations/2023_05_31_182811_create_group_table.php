<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Utilizado para agrupar produtos com especificações técnicas
         **/
        Schema::create('groups', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();

            $table->softDeletes();
        });

        Schema::create('model_groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('model_id');
            $table
                ->foreign('model_id')
                ->references('id')
                ->on('models')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('group_id');
            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('techspec_groups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('techspec_id');
            $table
                ->foreign('techspec_id')
                ->references('id')
                ->on('techspecs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('group_id');
            $table
                ->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('model_groups');
        Schema::dropIfExists('techspec_groups');
    }
};
