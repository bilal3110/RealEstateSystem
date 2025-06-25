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
        Schema::create('invest_disposed', function (Blueprint $table) {
            $table->id('buyer_id');
            $table->foreignId('investment_id')->constrained('investment', 'invest_id')->onDelete('cascade'); // Correct FK
            $table->string('buyer_name');
            $table->string('buyer_contact');
            $table->string('buyer_cnic');
            $table->decimal('sell_price', 10, 2);
            $table->decimal('advance', 10, 2);
            $table->decimal('profit', 10, 2);
            $table->text('agreement')->nullable();
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
        Schema::dropIfExists('invest_disposed');
    }
};
