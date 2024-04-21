<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('quotation_id')->default(0);
            $table->string('series');
            $table->string('material');
            $table->string('hsn_sac');

            $table->text('description');
            $table->string('make');
            $table->string('quantity');
            $table->string('unit');
            $table->string('rate');
            $table->string('amount');
            $table->string('gst_percentage');
            $table->string('gst_amount');
            $table->string('total_amount');
            $table->string('extra');

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
        Schema::dropIfExists('quotations_detail');
    }
}
