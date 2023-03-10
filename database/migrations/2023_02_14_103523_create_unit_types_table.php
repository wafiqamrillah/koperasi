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
        Schema::create('unit_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->timestamps();
        });

        Schema::table('units', function (Blueprint $table) {
            $table->after('description', function($table) {
                $table->foreignId('type_id')->nullable()->constrained('unit_types')->onUpdate('cascade')->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('unit_types');
    }
};
