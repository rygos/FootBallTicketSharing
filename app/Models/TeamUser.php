<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamUser
 * 
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TeamUser extends Model
{
	protected $table = 'team_user';

	protected $casts = [
		'team_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'team_id',
		'user_id',
		'role'
	];
}
