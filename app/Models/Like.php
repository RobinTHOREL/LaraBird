<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Mar 2017 13:37:41 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Like
 * 
 * @property int $user_id
 * @property int $post_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Like extends Eloquent
{
	protected $table = 'like';
	public $incrementing = false;

	protected $casts = [
		'user_id' => 'int',
		'post_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'post_id'
	];
}
