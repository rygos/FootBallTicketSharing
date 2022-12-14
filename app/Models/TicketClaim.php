<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketClaim
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $match_id
 * @property int $ticket_id
 * @property int|null $claimed_by_id
 * @property int|null $claim_confirmend
 * @property Carbon|null $claim_confirmed_at
 * @property int|null $payment_confirmed
 * @property Carbon|null $payment_confirmed_at
 * @property int|null $payment_confirmed_by_id
 *
 * @package App\Models
 */
class TicketClaim extends Model
{
	protected $table = 'ticket_claims';

	protected $casts = [
		'match_id' => 'int',
		'ticket_id' => 'int',
		'claimed_by_id' => 'int',
		'claim_confirmend' => 'int',
		'payment_confirmed' => 'int',
		'payment_confirmed_by_id' => 'int'
	];

	protected $dates = [
		'claim_confirmed_at',
		'payment_confirmed_at'
	];

	protected $fillable = [
		'match_id',
		'ticket_id',
		'claimed_by_id',
		'claim_confirmend',
		'claim_confirmed_at',
		'payment_confirmed',
		'payment_confirmed_at',
		'payment_confirmed_by_id'
	];
}
