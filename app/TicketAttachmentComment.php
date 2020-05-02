<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketAttachmentComment
 * 
 * @property int $id
 * @property int $ticket_attachment_id
 * @property int $user_id
 * @property string $comment
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App
 */
class TicketAttachmentComment extends Model
{
	protected $table = 'ticket_attachment_comments';

	protected $casts = [
		'ticket_attachment_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'ticket_attachment_id',
		'user_id',
		'comment'
	];
}
