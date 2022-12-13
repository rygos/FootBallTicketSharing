<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamInvitation
 * 
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Team $team
 *
 * @package App\Models
 */
class TeamInvitation extends Model
{
	protected $table = 'team_invitations';

	protected $casts = [
		'team_id' => 'int'
	];

	protected $fillable = [
		'team_id',
		'email',
		'role'
	];

	public function team()
	{
		return $this->belongsTo(Team::class);
	}
}
