<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloatManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('float_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_type');
            $table->string('transactio_ref')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('running_balance', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
