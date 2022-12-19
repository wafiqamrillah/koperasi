<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_matrices', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->json('matrices')->default('[]')->comment("Array of role id matrix in sorted");
            $table->timestamps();

            $table->index(['model_type'], 'approval_matrices_model_type_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_matrices');
    }
};
