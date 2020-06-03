<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('house_number_suffix')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('logo')->default('default');
            $table->string('company')->nullable();
            $table->string('invoices')->nullable();
            $table->string('estimates')->nullable();
            $table->timestamp('last_login')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
