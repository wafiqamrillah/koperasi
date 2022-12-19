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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->default(0);
            $table->string('label', 100)->index();
            $table->enum('link_type', ['url', 'route'])->default('url')->comment("{ url : for no Laravel route generator, route : for Laravel routes }");
            $table->string('link')->default('#');
            $table->string('icon_class', 100)->nullable();
            $table->boolean('has_translation')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->after('id', function($table){
                $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('menus');
    }
};
