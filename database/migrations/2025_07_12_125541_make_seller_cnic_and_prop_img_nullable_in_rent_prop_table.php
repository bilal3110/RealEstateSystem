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
        Schema::table('rent_prop', function (Blueprint $table) {
            $table->string('seller_cnic')->nullable()->change();
            $table->json('prop_img')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_prop', function (Blueprint $table) {
            $table->string('seller_cnic')->nullable(false)->change();
            $table->json('prop_img')->nullable(false)->change();
        });
    }
};
