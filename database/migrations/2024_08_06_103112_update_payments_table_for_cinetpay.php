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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('cpm_site_id')->nullable();
            $table->string('signature')->nullable();
            $table->string('cpm_trans_id')->nullable();
            $table->string('cpm_custom')->nullable();
            $table->string('cpm_currency')->nullable();
            $table->string('cpm_payid')->nullable();
            $table->dateTime('cpm_payment_date')->nullable();
            $table->string('cpm_payment_time')->nullable();
            $table->string('cpm_error_message')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('cpm_phone_prefixe')->nullable();
            $table->string('cel_phone_num')->nullable();
            $table->string('cpm_ipn_ack')->nullable();
            $table->string('cpm_result')->nullable();
            $table->string('cpm_trans_status')->nullable();
            $table->string('cpm_designation')->nullable();
            $table->string('buyer_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'cpm_site_id', 'signature', 'cpm_trans_id', 'cpm_custom', 'cpm_currency',
                'cpm_payid', 'cpm_payment_date', 'cpm_payment_time', 'cpm_error_message',
                'payment_method', 'cpm_phone_prefixe', 'cel_phone_num', 'cpm_ipn_ack',
                'cpm_result', 'cpm_trans_status', 'cpm_designation', 'buyer_name'
            ]);
        });
    }
};
