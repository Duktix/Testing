<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class theme extends Model
{
    protected $fillable = [
        'site_id', 'name', 'active'
    ];
	public static function getCurrentTheme(){
		return theme::where('active', 1)->first();
	}
}
