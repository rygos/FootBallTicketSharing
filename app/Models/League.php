<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class League
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $league_id
 * @property string $league_name
 *
 * @package App\Models
 */
class League extends Model
{
	protected $table = 'league';

	protected $casts = [
		'league_id' => 'int'
	];

	protected $fillable = [
		'league_id',
		'league_name'
	];
}
