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

    public function comments()
    {
        return $this->hasMany(TicketAttachmentComment::class,'ticket_attachment_id','id');
    }
}
