<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelNameType extends Model
{
	protected $fillable = array('name',
	                            'sort',
	);
	protected $hidden = ['id',
	                     'created_at',
	                     'updated_at',
	                     'deleted_at',
	];
	protected $table = 'hotel_name_type';
}
