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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('code')->index();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->after('brand', function($table) {
                $table->foreignId('default_unit_id')->nullable()->constrained('units')->onUpdate('cascade')->onDelete('set null');
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['default_unit_id']);

            $table->dropColumn('default_unit_id');
        });

        Schema::dropIfExists('units');
    }
};
