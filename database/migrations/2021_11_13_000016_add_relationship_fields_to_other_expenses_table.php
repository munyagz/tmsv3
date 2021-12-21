<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOtherExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('other_expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id', 'expense_fk_5299391')->references('id')->on('expense_categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5334319')->references('id')->on('users');
        });
    }
}
