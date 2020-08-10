<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->string('number')->nullable()->default('draft');
            $table->string('color')->nullable()->default(null);
            $table->string('pay_id');
            $table->string('color')->nullable()->default('#0000A0');
            $table->uuid('company_id');
            $table->uuid('client_id');
            $table->uuid('invoice_id')->nullable()->default(null);
            $table->decimal('amount',9,2);
            $table->decimal('total',9,2);
            $table->timestamp('send_date');
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
        Schema::dropIfExists('invoices');
    }
}
