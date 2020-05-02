<?php

/**
 * Created by Reliese Model.
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class TicketLog
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property array $data
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App
 */
class TicketLog extends Model
{
	protected $table = 'ticket_logs';

	protected $casts = [
		'ticket_id' => 'int',
		'user_id' => 'int',
		'data' => 'json'
	];

	protected $fillable = [
		'ticket_id',
		'user_id',
		'data'
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
