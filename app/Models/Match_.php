<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $league_id
 * @property int $match_id
 * @property Carbon $match_time
 * @property int $team1_id
 * @property string $team1_name
 * @property int $team2_id
 * @property string $team2_name
 * @property string $group_name
 * @property Carbon $last_update
 * @property int $is_finished
 * @property int $result_end_t1
 * @property int $result_end_t2
 * @property int $result_half_t1
 * @property int $result_half_t2
 *
 * @package App\Models
 */
class Match_ extends Model
{
	protected $table = 'matchs';

	protected $casts = [
		'league_id' => 'int',
		'match_id' => 'int',
		'team1_id' => 'int',
		'team2_id' => 'int',
		'is_finished' => 'int',
		'result_end_t1' => 'int',
		'result_end_t2' => 'int',
		'result_half_t1' => 'int',
		'result_half_t2' => 'int'
	];

	protected $dates = [
		'match_time',
		'last_update'
	];

	protected $fillable = [
		'league_id',
		'match_id',
		'match_time',
		'team1_id',
		'team1_name',
		'team2_id',
		'team2_name',
		'group_name',
		'last_update',
		'is_finished',
		'result_end_t1',
		'result_end_t2',
		'result_half_t1',
		'result_half_t2'
	];
}
