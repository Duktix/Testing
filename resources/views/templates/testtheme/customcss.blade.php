@if(!empty($headersettings['transparent_header']))
	.navbar-custom{
		background-color: transparent;
	}
@else
	.navbar-custom{
		{{ !empty($headersettings['header_bg_color']) ? 'background-color:'.$headersettings['header_bg_color'].';' : '' }}
	}
@endif

.navbar-custom .navbar-nav li a{
	{{ !empty($headersettings['header_menu_items_bg_color']) ? 'background-color:'.$headersettings['header_menu_items_bg_color'].';' : '' }}
	{{ !empty($headersettings['header_menu_items_color']) ? 'color:'.$headersettings['header_menu_items_color'].';' : '' }}
}
.navbar-custom .navbar-nav li:hover > a{
	{{ !empty($headersettings['header_menu_items_bg_color_hover']) ? 'background-color:'.$headersettings['header_menu_items_bg_color_hover'].';' : '' }}
	{{ !empty($headersettings['header_menu_items_color_hover']) ? 'color:'.$headersettings['header_menu_items_color_hover'].';' : '' }}
}
.navbar-custom .navbar-nav li.active > a{
	{{ !empty($headersettings['header_menu_items_bg_color_hover']) ? 'background-color:'.$headersettings['header_menu_items_bg_color_hover'].';' : '' }}
	{{ !empty($headersettings['header_menu_items_color_hover']) ? 'color:'.$headersettings['header_menu_items_color_hover'].';' : '' }}
}
.sticky-wrapper.is-sticky .navbar-custom{
	{{ !empty($headersettings['static_background_color']) ? 'background-color:'.$headersettings['static_background_color'].';' : '' }}
}
.sticky-wrapper.is-sticky .navbar-custom .navbar-nav li a{
	{{ !empty($headersettings['static_menu_item_color']) ? 'color:'.$headersettings['static_menu_item_color'].';' : '' }}
}
.sticky-wrapper.is-sticky .navbar-custom .navbar-nav li:hover > a{
	{{ !empty($headersettings['static_menu_item_color_hover']) ? 'color:'.$headersettings['static_menu_item_color_hover'].';' : '' }}
}

