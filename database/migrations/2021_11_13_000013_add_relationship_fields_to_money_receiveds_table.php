<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMoneyReceivedsTable extends Migration
{
    public function up()
    {
        Schema::table('money_receiveds', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4327384')->references('id')->on('users');
        });
    }
}
