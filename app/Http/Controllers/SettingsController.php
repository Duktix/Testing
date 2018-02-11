<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Http\Request;

use App\theme;
use App\Pages;
use App\Settings;
use App\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function header()
    {
		$currenttheme = theme::getCurrentTheme();
		$settings = getThemeConfig($currenttheme['name'],'all');
		$headersettings = Settings::where('type', "header")->first();
		
		if($headersettings){
			$savedsettings = unserialize($headersettings->setting);
			return view('admin.header', ['settings' => $settings, 'menus' => Menu::All(), 'savedsettings'=> $savedsettings]);
		}else{
			return view('admin.header', ['settings' => $settings,'menus' => Menu::All(), 'savedsettings'=> $settings]);
		}
    }
	public function footer()
    {
		$currenttheme = theme::getCurrentTheme();
		$settings = getThemeConfig($currenttheme['name'],'all');
		$footersettings = Settings::where('type', "footer")->first();
		
		if($footersettings){
			$savedsettings = unserialize($footersettings->setting);
			return view('admin.footer', ['settings' => $settings, 'menus' => Menu::All(), 'savedsettings'=> $savedsettings]);
		}else{
			return view('admin.footer', ['settings' => $settings,'menus' => Menu::All(), 'savedsettings'=> $settings]);
		}
    }
	public function fonts()
    {
		$currenttheme = theme::getCurrentTheme();
		$settings = getThemeConfig($currenttheme['name'],'all');
		$fontsettings = Settings::where('type', "fonts")->first();
		
		if($fontsettings){
			$savedsettings = unserialize($fontsettings->setting);
			return view('admin.fonts', ['settings' => $settings, 'menus' => Menu::All(), 'savedsettings'=> $savedsettings]);
		}else{
			return view('admin.fonts', ['settings' => $settings,'menus' => Menu::All(), 'savedsettings'=> $settings]);
		}
    }
	public function colors()
    {
		$currenttheme = theme::getCurrentTheme();
		$colors = getThemeConfig($currenttheme['name'],'colors');
        return view('admin.colors', ['colors' => $colors]);
    }
	public function update()
    {
		$process = new Process('cd '.base_path().';git reset --hard origin/master;git clean -f -d');
		$process->run();
		dd($process->getOutput());
		return redirect()->back();
    }
	public function saveSettings(Request $requests)
    {
		$predefined = array('logo', 'favicon', 'header_bg_color', 'header_menu_items_bg_color', 'header_menu_items_bg_color_hover', 'header_menu_items_color', 'header_menu_items_color_hover', 'custom_code_header_css', 'custom_code_header_js', 'custom_code_header_others', 'custom_code_body');
		$inputs = array();
		
		$currenttheme = theme::getCurrentTheme();
		$settings = getThemeConfig($currenttheme['name'],'all');
		$headersettings = Settings::where('type', "header")->first();
		if($headersettings)
			$savedsettings = unserialize($headersettings->setting);
		
		if($requests->settingType=='header'){
			$getfileinputs = array('logo', 'favicon');
			foreach($settings['logos'] as $key=>$val){
				$getfileinputs[] = $key;
			}
			foreach($requests->all() as $key=>$request){
				if($key!="logo"){
					$fileinput = substr($key, -4);
					if($fileinput != "logo"){
					$inputs[$key] = $request;
					}
				}
			}
			foreach($getfileinputs as $file){
				if($requests->hasFile($file)){
					 $validator = Validator::make($requests->all(), [
						$file => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
					]);
					if ($validator->fails()) {
						dd($validator);
					}else{
						$imagefile = substr($requests->file($file)->getClientOriginalName(), 0, strrpos($requests->file($file)->getClientOriginalName(), "."));
						$path = "/uploads/" . date("Y") . '/' . date("m") . "/";
						$imageName = $imagefile.'_'.rand().'.'.$requests->file($file)->getClientOriginalExtension();
						$requests->file($file)->move(public_path($path), $imageName);
						$inputs[$file] = $path . "$imageName";
					}
				}elseif(isset($savedsettings[$file]) && $savedsettings[$file]!=''){
					$inputs[$file] = $savedsettings[$file];
				}
			}
			$settings = Settings::updateOrCreate(
				['type' => 'header'],
				['type' => 'header', 'setting' => serialize($inputs)]
			);
			if($settings){
				return Redirect::back()->with('success', 'Settings successfully updated.');
			}
		}
		if($requests->settingType=='footer'){
			foreach($requests->all() as $key=>$request){
				$inputs[$key] = $request;
			}
			$settings = Settings::updateOrCreate(
				['type' => 'footer'],
				['type' => 'footer', 'setting' => serialize($inputs)]
			);
			if($settings){
				return Redirect::back()->with('success', 'Settings successfully updated.');
			}
		}
		if($requests->settingType=='fonts'){
			foreach($requests->all() as $key=>$request){
				$inputs[$key] = $request;
			}
			$settings = Settings::updateOrCreate(
				['type' => 'fonts'],
				['type' => 'fonts', 'setting' => serialize($inputs)]
			);
			if($settings){
				return Redirect::back()->with('success', 'Settings successfully updated.');
			}
		}
    }
}
