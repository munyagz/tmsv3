<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetDatasTable extends Migration
{
    public function up()
    {
        Schema::create('fleet_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->date('journey_date');
            $table->string('vehicle_reg_no');
            $table->string('destination');
            $table->string('customer_name');
            $table->string('invoice_number')->unique();
            $table->string('quantity');
            $table->decimal('amount_paid_in', 15, 2)->nullable();
            $table->decimal('amount_paid_out', 15, 2);
            $table->decimal('profit_loss', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
