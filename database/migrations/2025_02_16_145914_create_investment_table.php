<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment', function (Blueprint $table) {
            $table->id('invest_id');
            $table->string('prop_title');
            $table->string('prop_area');
            $table->string('prop_loc');
            $table->string('seller_name');
            $table->string('seller_contact');
            $table->string('seller_cnic');
            $table->string('buying_price');
            $table->string('my_investment');
            $table->string('my_equity');
            $table->boolean('is_sold')->default(false);
            $table->json('prop_img')->nullable();
            $table->text('prop_desc')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('investment');
    }
};
