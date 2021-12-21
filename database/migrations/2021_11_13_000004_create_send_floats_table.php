<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendFloatsTable extends Migration
{
    public function up()
    {
        Schema::create('send_floats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_sent');
            $table->decimal('amount', 15, 2);
            $table->string('transaction_ref')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
