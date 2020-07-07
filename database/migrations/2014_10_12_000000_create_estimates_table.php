<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number')->default('draft');
            $table->string('title')->nullable();
            $table->string('sign_id')->nullable();
            $table->uuid('company_id');
            $table->uuid('client_id');
            $table->decimal('total',9,2);
            $table->integer('discount')->nullable()->default(0);
            $table->decimal('amount',9,2)->nullable()->default(0.00);
            $table->timestamp('send_date')->nullable();
            $table->timestamp('due_date');
            $table->timestamp('sign_date')->nullable();
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
        Schema::dropIfExists('estimates');
    }
}
