<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{
	use \App\Traits\Uuids;

	/**
	 * @var bool
	 */
	public $incrementing = false;

    /**
     * @var bool
     */
    public $timestamps = true;

	protected $fillable = [
		'uid',
		'title',
		'content',
		'type',
		'comment',
		'url',
		'featured_image_url',
		'thumbnail',
		'emoji',
		'mood',
		'current_music',
		'weather',
		'location',
		'ip_address',
		'latitude',
		'longitutde',
		'discovered_at'
	];

    /**
     * Get the person that owns the comment.
     */
    public function person()
    {
        return $this->belongsTo('Person');
    }
}