<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licence');
            $table->text('address');
            $table->string('client_company');
            $table->string('client_name');
            $table->string('client_address');
            $table->string('rfq_number');
            $table->date('date');
            $table->string('quotation_number');
            $table->string('valid_until');
            $table->integer('company_id')->default(1);
            $table->integer('status')->default(0);
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations_master');        
    }
}
