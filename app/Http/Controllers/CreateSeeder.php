<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Artisan;
use File;

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
			$ee = \DB::table('users')->insert(array (
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
			$themesdir = File::directories(resource_path('views/templates'));
			$themes = array();
			foreach($themesdir as $themedir){
				$active = 0;
				if(basename($themedir) == 'testtheme'){
					$active = 1;
				}
				$themes[] = array('name' => basename($themedir),'active' => $active);
			}
			$ee = \DB::table('themes')->insert($themes);
			dd('success');
		}
	}
	public function update()
    {
		$process = new Process('cd '.base_path().';git reset --hard origin/master;git clean -df;git pull');
		$process->run();
		dd($process->getOutput());
    }
}