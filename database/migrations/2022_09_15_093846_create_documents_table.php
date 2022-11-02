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
        Schema::dropIfExists('documents');
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lease_id');
            $table->foreign('lease_id')
                ->references('id')->on('leases');
            $table->string('name', 50);
            $table->string('original_name');
            $table->string('full_path');
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
        Schema::dropIfExists('documents');
    }
};
