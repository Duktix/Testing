<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;

class CreateSeeder extends Controller
{
    public function Index()
    {
		exec('php artisan db:seed --class=UsersTableSeeder');
		exec('git push origin master');
	}
	public function resetdb()
    {
		$process = new Process('php artisan migrate;php artisan db:seed --class=UsersTableSeeder');
		$process->run();
		return redirect()->back();
	}
}
