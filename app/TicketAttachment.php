<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $fillable = [
		'ticket_id',
		'attachment_title',
		'attachment',
	];
}
