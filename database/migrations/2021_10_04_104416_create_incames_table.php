<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incame_title_id');
            $table->unsignedBigInteger('incame_categorie_id');
            $table->decimal('amount')->default(0.00);
            $table->string('bayer_name')->nullable();
            $table->string('bayer_phone')->nullable();
            $table->date('incame_date')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('incames');
    }
}
