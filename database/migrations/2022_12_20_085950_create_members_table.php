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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('id_card_number')->nullable()->index();
            $table->string('birth_place', 50);
            $table->date('birth_date');
            $table->text('address');
            $table->boolean('is_married')->default(false);
            $table->string('phone_number', 13)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->boolean('is_active')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->after('remember_token', function($table) {
                $table->foreignId('member_id')->nullable()->constrained('members')->onUpdate('cascade')->onDelete('set null');
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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn($table->getTable(), 'member_id')) {
                $table->dropForeign(['member_id']);
                $table->dropColumn('member_id');
            }
        });

        Schema::dropIfExists('members');
    }
};
