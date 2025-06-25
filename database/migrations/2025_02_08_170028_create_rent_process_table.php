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
        Schema::create('rent_process', function (Blueprint $table) {
            $table->id('prop_id');
            $table->string('prop_title');
            $table->string('prop_area');
            $table->string('prop_loc');
            $table->string('prop_rent');
            $table->string('landlord_name');
            $table->string('landlord_contact');
            $table->string('landlord_cnic');
            $table->string('tenant_name');
            $table->string('tenant_contact');
            $table->string('tenant_cnic');
            $table->string('advance');
            $table->string('commision');
            $table->string('agreement')->nullable();
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
        Schema::dropIfExists('rent_process');
    }
};
