<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Permission::class)->constrained();
            $table->foreignIdFor(\App\Models\Role::class)->constrained();
            $table->boolean('owner_restricted')->nullable();
        });
    }
}
