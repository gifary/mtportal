<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAttachmentComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_attachment_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ticket_attachment_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->mediumText('comment')->nullable();

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
        Schema::dropIfExists('ticket_attachment_comments');
    }
}
