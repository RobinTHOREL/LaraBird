<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Mar 2017 13:37:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Follow
 * 
 * @property int $follower_id
 * @property int $followed_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Follow extends Eloquent
{
	protected $table = 'follow';
	public $incrementing = false;

	protected $casts = [
		'follower_id' => 'int',
		'followed_id' => 'int'
	];

	protected $fillable = [
		'follower_id',
		'followed_id'
	];
}
