<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned();
            $table->integer('expenses_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->double('saleprice');
            $table->integer('amount');
            $table->integer('partner_id')->unsigned();
            $table->string('address');
            $table->integer('status_id')->unsigned();
            $table->integer('purchaseorder_id')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
