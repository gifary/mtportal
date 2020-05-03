<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

	protected $with=['user'];

	public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        if(Auth::check()){
            if(!empty(Auth::user()->zone_name)){
                $dt = Carbon::parse($value);
                $zone = Zone::find(Auth::user()->zone_name);
                return $dt->setTimezone($zone->zone_name)->toDateTimeString();
            }else{
                return $value;
            }
        }else{
            return $value;
        }

    }
}
