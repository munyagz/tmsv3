<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFloatManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('float_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4333472')->references('id')->on('users');
        });
    }
}
