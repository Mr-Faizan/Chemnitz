<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_666906')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
