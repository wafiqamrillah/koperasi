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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('number')->index();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->string('brand')->nullable()->index();
            $table->boolean('is_active')->default(true);
            $table->string('barcode')->nullable()->index();

            $table->foreignId('created_by')->nullable()->constrained((new \App\Models\User)->getTable())->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained((new \App\Models\User)->getTable())->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained((new \App\Models\User)->getTable())->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
