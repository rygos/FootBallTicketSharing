<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property int $owner_id
 * @property string|null $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $season
 * @property int $league_id
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';

	protected $casts = [
		'owner_id' => 'int',
		'season' => 'int',
		'league_id' => 'int'
	];

	protected $fillable = [
		'owner_id',
		'title',
		'season',
		'league_id'
	];
}
