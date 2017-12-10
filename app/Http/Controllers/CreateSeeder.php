<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSeeder extends Controller
{
    public function Index()
    {
		exec('php artisan db:seed --class=UsersTableSeeder');
		exec('git push origin master');
	}
}
