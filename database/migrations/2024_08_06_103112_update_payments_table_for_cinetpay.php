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
            if (!Schema::hasColumn('payments', 'cpm_site_id')) {
                $table->string('cpm_site_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'signature')) {
                $table->string('signature')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_trans_id')) {
                $table->string('cpm_trans_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_custom')) {
                $table->string('cpm_custom')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_currency')) {
                $table->string('cpm_currency')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_payid')) {
                $table->string('cpm_payid')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_payment_date')) {
                $table->dateTime('cpm_payment_date')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_payment_time')) {
                $table->string('cpm_payment_time')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_error_message')) {
                $table->string('cpm_error_message')->nullable();
            }
            // Ne pas ajouter 'payment_method' car il existe déjà
            if (!Schema::hasColumn('payments', 'cpm_phone_prefixe')) {
                $table->string('cpm_phone_prefixe')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cel_phone_num')) {
                $table->string('cel_phone_num')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_ipn_ack')) {
                $table->string('cpm_ipn_ack')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_result')) {
                $table->string('cpm_result')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_trans_status')) {
                $table->string('cpm_trans_status')->nullable();
            }
            if (!Schema::hasColumn('payments', 'cpm_designation')) {
                $table->string('cpm_designation')->nullable();
            }
            if (!Schema::hasColumn('payments', 'buyer_name')) {
                $table->string('buyer_name')->nullable();
            }
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
                'cpm_phone_prefixe', 'cel_phone_num', 'cpm_ipn_ack',
                'cpm_result', 'cpm_trans_status', 'cpm_designation', 'buyer_name'
            ]);
        });
    }
};
