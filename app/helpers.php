<?php
function IncludeAsset($asset){
	$theme = App\theme::where('active', 1)->first();
	return asset('templates/'.$theme['name'].'/'.$asset);
}
function getThemeConfig($theme, $parameter){
	$settings = File::get(public_path('templates/'.$theme.'/config.json'));
	$json = object_to_array(json_decode(utf8_encode($settings)));
	if($parameter=='all'){
		return $json;
	}else{
		return $json[$parameter];
	}
}
function object_to_array($obj) {
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        foreach ($_arr as $key => $val) {
                $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
                $arr[$key] = $val;
        }
        return $arr;
}
function getThemeName($theme){
	return getThemeConfig($theme,'name');
}
function getMenuLocations($theme){
	$locations = getThemeConfig($theme,'menu_locations');
	return $locations['menu_locations'];
}
function loopmenu($currentmenu){
	$menu = "";
	foreach($currentmenu->order as $key=>$order):
		$menu.=getMenuitems($currentmenu, $order->id);
		$menu.=getMenuitemsChildren($currentmenu, $order);
	endforeach;
	return $menu;
}
function getMenuitems($currentmenu, $dataID){
	$menuitems = "";
	foreach($currentmenu->menu as $key=>$menu):
		if($dataID == $menu['dataID']){
			$checktarget = "";
			if(!empty($menu['target']))
				$checktarget = "checked";
		$menuitems .='<li class="dd-item" data-id="'.$menu['dataID'].'">';
		$menuitems .='<div class="dd-handle dd3-handle"></div><div class="dd3-content"><a href="javascript:void(0)" data-toggle="collapse" data-target="#drop'.$menu['dataID'].'">'.$menu['title'].'</a><a href="javascript:void(0)" data-target="'.$menu['dataID'].'" class="deleteitem pull-right"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
		$menuitems .='<div id="drop'.$menu['dataID'].'" class="collapse"><div class="well"><div class="form-group"><label class="control-label">Title</label><input class="form-control" type="text" name="title[]" value="'.$menu['title'].'"></div><div class="form-group"><label class="control-label">Classes</label><input class="form-control" type="text" name="classes[]" value="'.$menu['classes'].'"></div>';
		$menuitems .='<div class="checkbox"><input id="newtab'.$menu['dataID'].'" type="checkbox" name="target[]" value="_blank" '.$checktarget.'><label for="newtab'.$menu['dataID'].'">Open New Tab</label></div></div></div>';
		$menuitems .='<input type="hidden" name="dataID[]" value="'.$menu['dataID'].'">';
		$menuitems .='<input type="hidden" name="link[]" value="'.$menu['link'].'">';
		$menuitems .='<input type="hidden" name="type[]" value="'.$menu['type'].'">';
		}
	endforeach;
	return $menuitems;
}
function getMenuitemsChildren($currentmenu, $order){
	$menu = "";
	if(!empty($order->children)){
		$menu.='<ol class="dd-list">';
		foreach($order->children as $keychild=>$orderchild):
			$menu.=getMenuitems($currentmenu, $orderchild->id);
			$menu.=getMenuitemsChildren($currentmenu, $orderchild);
		endforeach;
		$menu.="</ol></li>";
	}else{
		$menu.="</li>";
	}
	return $menu;
}
function getMenubyID($menuid){
	$menu = App\Menu::find($menuid);
	$menu['menu'] = unserialize($menu->menu);
	$menu['order'] = unserialize($menu->order);
	return loopmenu_frontend($menu);
}
function loopmenu_frontend($currentmenu){
	$menu = "";
	foreach($currentmenu->order as $key=>$order):
		$menu.=getMenuitems_frontend($currentmenu, $order->id);
		$menu.=getMenuitemsChildren_frontend($currentmenu, $order);
	endforeach;
	return $menu;
}
function getMenuitems_frontend($currentmenu, $dataID){
	$menuitems = "";
	foreach($currentmenu->menu as $key=>$menu):
		if($dataID == $menu['dataID']){
		$menuitems .='<li class="menu-item">';
		$menuitems .='<a class="nav-link" href="'.$menu['link'].'">'.$menu['title'].'</a>';
		}
	endforeach;
	return $menuitems;
}
function getMenuitemsChildren_frontend($currentmenu, $order){
	$menu = "";
	if(!empty($order->children)){
		$menu.='<ul class="sub-menu">';
		foreach($order->children as $keychild=>$orderchild):
			$menu.=getMenuitems_frontend($currentmenu, $orderchild->id);
			$menu.=getMenuitemsChildren_frontend($currentmenu, $orderchild);
		endforeach;
		$menu.="</ull></li>";
	}else{
		$menu.="</li>";
	}
	return $menu;
}
function filterOutput($string){
	$filterelements = array('<removable>(.*?)<\/removable>');
	foreach($filterelements as $filterelement){
		$string = preg_replace("/".$filterelement."/", "", $string);
	}
	$attributes = preg_match('/<div class=\"is-section\" id=\"(.*?)\" data-classes=\"(.*?)\" data-bgcolor=\"(.*?)\" data-bgimage=\"(.*?)\" data-textcolor=\"(.*?)\">/i', $string, $match);
	if($attributes){
	$replace = '<div class="is-section '.$match[2].'" id="'.$match[1].'" style="clear:both;background-color:'.$match[3].';background-image:url('.$match[4].');color:'.$match[5].'">';
	$string = preg_replace("/<div class=\"is-section\" id=\"(.*?)\" data-classes=\"(.*?)\" data-bgcolor=\"(.*?)\" data-bgimage=\"(.*?)\">/", $replace, $string);
	}
	return $string;
}
?>