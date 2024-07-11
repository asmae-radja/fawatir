<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_num');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('product');
            //  $table->string('section');
            $table->decimal('Amount_collection', 8, 2)->nullable();;
            $table->decimal('Amount_Commission', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('value_vat', 8, 2);
            $table->string('rate_vat', 999);
            $table->decimal('total', 8, 2);
            $table->string('status', 50);
            $table->integer('value_Status');
            $table->string('file_name', 999)->nullable();
            $table->text('note')->nullable();
            $table->string('user')->nullable();
            $table->foreignId('section_id')->constrained('sections');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
