<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('cname')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_person_position')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('full_address')->nullable();
            $table->integer('deal_size')->nullable();
            $table->string('close_won_date')->nullable();
            $table->string('lead_industry')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('market_contact')->nullable();
            $table->string('marketing_phone')->nullable();
            $table->string('marketing_email')->nullable();
            $table->string('billing_contact')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('lead_status')->default(1);
            $table->string('billing_email')->nullable();
            $table->string('_token')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
