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
        Schema::create('sale_prop', function (Blueprint $table) {
            $table->id('seller_id');
            $table->string('seller_name');
            $table->string('seller_contact');
            $table->string('seller_cnic');
            $table->string('prop_title'); 
            $table->string('prop_area');
            $table->string('prop_loc');
            $table->decimal('demand', 10, 2);
            $table->json('prop_img');
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
        Schema::dropIfExists('sale_prop');
    }
};
