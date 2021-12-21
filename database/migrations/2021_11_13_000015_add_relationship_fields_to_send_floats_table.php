<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSendFloatsTable extends Migration
{
    public function up()
    {
        Schema::table('send_floats', function (Blueprint $table) {
            $table->unsignedBigInteger('sent_to_id');
            $table->foreign('sent_to_id', 'sent_to_fk_5299364')->references('id')->on('users');
            $table->unsignedBigInteger('sent_by_id');
            $table->foreign('sent_by_id', 'sent_by_fk_5299365')->references('id')->on('users');
        });
    }
}
