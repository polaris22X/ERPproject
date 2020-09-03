<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner', function (Blueprint $table) {
            $table->integer('organization_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->string('partner_name');
            $table->string('partner_address');
            $table->string('partner_type');
            $table->string('partner_tel')->nulllabel();
            $table->string('partner_email')->nulllabel();
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
        Schema::dropIfExists('partner');
    }
}
