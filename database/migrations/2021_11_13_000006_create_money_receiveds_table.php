<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyReceivedsTable extends Migration
{
    public function up()
    {
        Schema::create('money_receiveds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_received');
            $table->decimal('amount', 15, 2);
            $table->string('transaction_ref')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
