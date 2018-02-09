<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       return view('admin.menu', ['pages' => Pages::All(), 'menus' => Menu::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.menu', ['pages' => Pages::All(), 'menus' => Menu::All()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menuitems = array();
		if(sizeof($request->dataID)>0){
			foreach($request->dataID as $key=>$val){
				$menuitems[] = array('dataID'=>$val,'title'=>$request['title'][$key],'link'=>$request['link'][$key],'classes'=>$request['classes'][$key],'target'=>$request['target'][$key],'type'=>$request['type'][$key]);
			}
		}
		$validator = Validator::make($request->all(), [
			'menu_name' => 'required',
		]);
		if ($validator->fails()) {
			dd($validator);
		}else{
			$menu = new Menu;
			$menu->name = $request->menu_name;
			$menu->menu = serialize($menuitems);
			$menu->order = serialize(json_decode($request->order));
			$menu->save();
			return Redirect::route('menu.edit', $menu->id)->with('success', 'Menu successfully created.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$menu = Menu::find($id);
		$menu['menu'] = unserialize($menu->menu);
		$menu['order'] = unserialize($menu->order);
        return view('admin.menu', ['pages' => Pages::All(), 'menus' => Menu::All(), 'currentmenu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
		$menu['menu'] = unserialize($menu->menu);
		$menu['order'] = unserialize($menu->order);
        return view('admin.menu', ['pages' => Pages::All(), 'menus' => Menu::All(), 'currentmenu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menuitems = array();
		if(sizeof($request->dataID)>0){
			foreach($request->dataID as $key=>$val){
				if(isset($request['target'][$key])){
					$target = $request['target'][$key];
				}else{
					$target="";
				}
				$menuitems[] = array('dataID'=>$val,'title'=>$request['title'][$key],'link'=>$request['link'][$key],'classes'=>$request['classes'][$key],'target'=>$target,'type'=>$request['type'][$key]);
			}
		}
		$validator = Validator::make($request->all(), [
			'menu_name' => 'required',
		]);
		if ($validator->fails()) {
			dd($validator);
		}else{
			$menu = Menu::find($id);
			$menu->name = $request->menu_name;
			$menu->menu = serialize($menuitems);
			$menu->order = serialize(json_decode($request->order));
			$menu->save();
			return Redirect::back()->with('success', 'Menu successfully updated.');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
