<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id');
            $table->primary('id');
            $table->string('no_transaksi', 100);
            $table->date('transaction_date');
            $table->tinyInteger('type');
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sellerid')->nullable();
            $table->decimal('grandtotal', 13, 2)->nullable()->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('invoice_id');
            $table->integer('product_id');
            $table->integer('qty')->default(0);
            $table->decimal('price', 13, 2)->default(0);
            $table->decimal('disc', 13, 2)->default(0);
            $table->decimal('amount', 13, 2)->default(0);
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        
        
        Schema::create('log_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('invoice_id');
            $table->uuid('invoice_dt');
            $table->integer('product_id');
            $table->integer('qty')->default(0);
            $table->decimal('price', 13, 2)->default(0);
            $table->decimal('disc', 13, 2)->default(0);
            $table->decimal('amount', 13, 2)->default(0);
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_details');
        Schema::dropIfExists('log_invoices');
    }
}
