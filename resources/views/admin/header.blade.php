@extends('layouts.app')

@section('extra')
<link href="{{ asset('assets/plugins/codemirror/css/codemirror.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/codemirror/css/ambiance.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Header Settings</h4>
			</div>
    </div>
	@if (\Session::has('success'))
		<div class="row">
				<div class="col-sm-12 m-t-15">
				<div class="alert alert-success">
					{!! \Session::get('success') !!}
				</div>
				</div>
		</div>
			@endif
<form method="post" action="{{ route("settings.saveheader") }}" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" name="settingType" value="header">
	<div class="row">
		<div class="col-sm-6 m-t-15">	
			<div class="card-box">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-8">
								<label class="control-label">Upload Logo</label>
								<input type="file" class="filestyle" name="logo" data-placeholder="No file">
							</div>
							<div class="col-sm-4">
								<div class="placeholder">
									@if(array_key_exists('logo', $savedsettings))
										@if($savedsettings['logo']!='')
										<img src="{{ $savedsettings['logo'] }}" class="img-responsive">
										@endif
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-8">
								<label class="control-label">Upload Favicon</label>
								<input type="file" class="filestyle" name="favicon" data-placeholder="No file">
							</div>
							<div class="col-sm-4">
								<div class="placeholder">
									@if(array_key_exists('favicon', $savedsettings))
										@if($savedsettings['favicon']!='')
										<img src="{{ $savedsettings['favicon'] }}" class="img-responsive">
										@endif
									@endif
								</div>
							</div>
						</div>
					</div>
					@if(sizeof($settings['logos']))
						@foreach($settings['logos'] as $key=>$logo)
					<div class="form-group">
						<div class="row">
							<div class="col-sm-8">
								<label class="control-label">{{ $logo }}</label>
							<input type="file" class="filestyle" name="{{ $key }}" data-placeholder="No file">
							</div>
							<div class="col-sm-4">
								<div class="placeholder">
									@if(array_key_exists($key, $savedsettings) && $savedsettings[$key]!='')
										<img src="{{ $savedsettings[$key] }}" class="img-responsive">
									@endif
								</div>
							</div>
						</div>
					</div>
						@endforeach
					@endif
					<div class="form-group m-b-0">
						<label class="control-label">Select Menu</label>
						@foreach($settings['menu_locations'] as $key=>$location)
						<div class="form-group">
							<p class="text-muted m-b-15 m-t-15 font-15">{{ $location }}</p>
							<select class="selectpicker" data-live-search="true"  data-style="btn-white" name="{{ $key }}">
								<option value="">Select Menu</option>
								@foreach($menus as $menu)
								<option value="{{ $menu->id }}" @if(!empty($savedsettings[$key]) && $savedsettings[$key] == $menu->id) {{ "selected" }} @endif>{{ $menu->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="checkbox">
							<input id="checkbox{{ $key }}" type="checkbox" name="{{ $key }}_disabled" 
							@if(!empty($savedsettings[$key."_disabled"]))
								checked
							@endif
							>
							<label for="checkbox{{ $key }}">
								Disable
							</label>
						</div>
						@endforeach
					</div>
			</div>
		</div>
		<div class="col-sm-6 m-t-15">	
			<div class="card-box">
				@if(sizeof($settings['headers'])>0)
					<div class="form-group">
						<label class="control-label">Select Header Style</label>
						<select class="selectpicker" data-live-search="true" name="header"  data-style="btn-white">
							@foreach($settings['headers'] as $key=>$header)
							<option value="{{ $key }}"
							@if(!empty($savedsettings['header']) && $key==$savedsettings['header'])
								selected
							@endif
							>{{ $header }}</option>
							@endforeach
						</select>
					</div>
				@endif
				<div class="form-group">
					<label class="control-label">Header Background Color</label>
					<div data-color-format="rgba" data-color="@if(!empty($savedsettings['header_bg_color'])) {{ $savedsettings['header_bg_color'] }} @endif" class="colorpicker-rgba input-group">
						<input type="text" name="header_bg_color" readonly="readonly" value="" class="form-control">
						<span class="input-group-btn add-on">
							<button class="btn btn-white" type="button">
								<i style="background-color: @if(!empty($savedsettings['header_bg_color'])) {{ $savedsettings['header_bg_color'] }} @endif;margin-top: 2px;"></i>
							</button> 
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Header Menu items background Color</label>
					<div data-color-format="rgba" data-color="@if(!empty($savedsettings['header_menu_items_bg_color'])) {{ $savedsettings['header_menu_items_bg_color'] }} @endif" class="colorpicker-rgba input-group">
						<input type="text" name="header_menu_items_bg_color" readonly="readonly" value="" class="form-control">
						<span class="input-group-btn add-on">
							<button class="btn btn-white" type="button">
								<i style="background-color: @if(!empty($savedsettings['header_menu_items_bg_color'])) {{ $savedsettings['header_menu_items_bg_color'] }} @endif;margin-top: 2px;"></i>
							</button> 
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Header Menu items background Color (Hover/Active)</label>
					<div data-color-format="rgba" data-color="@if(!empty($savedsettings['header_menu_items_bg_color_hover'])) {{ $savedsettings['header_menu_items_bg_color_hover'] }} @endif" class="colorpicker-rgba input-group">
						<input type="text" readonly="readonly" name="header_menu_items_bg_color_hover" value="" class="form-control">
						<span class="input-group-btn add-on">
							<button class="btn btn-white" type="button">
								<i style="background-color: @if(!empty($savedsettings['header_menu_items_bg_color_hover'])) {{ $savedsettings['header_menu_items_bg_color_hover'] }} @endif;margin-top: 2px;"></i>
							</button> 
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Header Menu items Color</label>
					<div data-color-format="rgba" data-color="@if(!empty($savedsettings['header_menu_items_color'])) {{ $savedsettings['header_menu_items_color'] }} @endif" class="colorpicker-rgba input-group">
						<input type="text" readonly="readonly" name="header_menu_items_color" value="" class="form-control">
						<span class="input-group-btn add-on">
							<button class="btn btn-white" type="button">
								<i style="background-color: @if(!empty($savedsettings['header_menu_items_color'])) {{ $savedsettings['header_menu_items_color'] }} @endif;margin-top: 2px;"></i>
							</button> 
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Header Menu items Color (Hover/Active)</label>
					<div data-color-format="rgba" data-color="@if(!empty($savedsettings['header_menu_items_color_hover'])) {{ $savedsettings['header_menu_items_color_hover'] }} @endif" class="colorpicker-rgba input-group">
						<input type="text" readonly="readonly" name="header_menu_items_color_hover" value="" class="form-control">
						<span class="input-group-btn add-on">
							<button class="btn btn-white" type="button">
								<i style="background-color: @if(!empty($savedsettings['header_menu_items_color_hover'])) {{ $savedsettings['header_menu_items_color_hover'] }} @endif;margin-top: 2px;"></i>
							</button> 
						</span>
					</div>
				</div>
			</div>
		</div>
		@if(sizeof($settings['options'])>0)
			@foreach($settings['options'] as $key=>$header)
			<div class="col-sm-6 m-t-15">	
				<div class="card-box">
						<div class="form-group">
							<div class="checkbox">
								<input id="checkbox{{ $key }}" name="{{ $key }}" type="checkbox" 
								@if(!empty($savedsettings[$key]))
									checked 
								@endif
								>
								<label for="checkbox{{ $key }}">
								{{ $header['title'] }}
								</label>
							</div>
							@foreach($header['extra'] as $key=>$extra)
								@if($extra['type'] == "checkbox")
									<p class="text-muted m-b-15 m-t-15 font-15">{{ $extra['title'] }}</p>
									<div class="checkbox">
										<input id="checkbox{{ $key }}" name="{{ $key }}" type="checkbox" 
										@if(!empty($savedsettings[$key]))
											checked 
										@endif
										>
										<label for="checkbox{{ $key }}">
										{{ $extra['title'] }}
										</label>
									</div>
								@elseif($extra['type'] == "picker")
									<p class="text-muted m-b-15 m-t-15 font-15">{{ $extra['title'] }}</p>
									<div data-color-format="rgba" data-color="@if(!empty($savedsettings[$key])) {{ $savedsettings[$key] }} @endif" class="colorpicker-rgba input-group">
										<input type="text" name="{{ $key }}" readonly="readonly" value="" class="form-control">
										<span class="input-group-btn add-on">
											<button class="btn btn-white" type="button">
												<i style="background-color: @if(!empty($savedsettings[$key])) {{ $savedsettings[$key] }} @endif;margin-top: 2px;"></i>
											</button> 
										</span>
									</div>
								@endif
							@endforeach
						</div>
				</div>
			</div>
			@endforeach
		@endif
	</div>
</div>
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Custom Header Css</h4>
			</div>
    </div>
	<div class="row">
		<div class="col-sm-12 m-t-15">
			<div class="card-box">
				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title">Code Editor Theme</h3>
						<small class="text-muted">The code editor comes with different themes such as below. You can view more theme demos from the CodeMirror site by going here</small>
					</div>
					<div class="panel-body p-0 code-edit-wrap">
						<textarea id="code1" name="custom_code_header_css">
						@if(!empty($savedsettings['custom_code_header_css']))
						{!! $savedsettings['custom_code_header_css'] !!}
						@endif
						</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Custom Header Script</h4>
			</div>
    </div>
	<div class="row">
		<div class="col-sm-12 m-t-15">
			<div class="card-box">
				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title">XML/HTML Mode</h3>
						<small>The XML mode supports two configuration parameters <code>htmlMode</code> and <code>alignCDATA</code>. To learn more visit <a target="_blank" href="http://codemirror.net/mode/xml/index.html">here</a>. To view more languages visit <a href="http://codemirror.net/mode/index.html" target="_blank">here</a></small>
					</div>
					<div class="panel-body p-0">
						<textarea id="code2" name="custom_code_header_js">
						@if(!empty($savedsettings['custom_code_header_js']))
						{!! $savedsettings['custom_code_header_js'] !!}
						@endif
						</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Custom Head Elements</h4>
			</div>
    </div>
	<div class="row">
		<div class="col-sm-12 m-t-15">
			<div class="card-box">
				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title">XML/HTML Mode</h3>
						<small>The XML mode supports two configuration parameters <code>htmlMode</code> and <code>alignCDATA</code>. To learn more visit <a target="_blank" href="http://codemirror.net/mode/xml/index.html">here</a>. To view more languages visit <a href="http://codemirror.net/mode/index.html" target="_blank">here</a></small>
					</div>
					<div class="panel-body p-0">
						<textarea id="code3" name="custom_code_header_others">
						@if(!empty($savedsettings['custom_code_header_others']))
						{!! $savedsettings['custom_code_header_others'] !!}
						@endif
						</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Custom Html (Just after &lt;body&gt;)</h4>
			</div>
    </div>
	<div class="row">
		<div class="col-sm-12 m-t-15">
			<div class="card-box">
				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title">XML/HTML Mode</h3>
						<small>The XML mode supports two configuration parameters <code>htmlMode</code> and <code>alignCDATA</code>. To learn more visit <a target="_blank" href="http://codemirror.net/mode/xml/index.html">here</a>. To view more languages visit <a href="http://codemirror.net/mode/index.html" target="_blank">here</a></small>
					</div>
					<div class="panel-body p-0">
						<textarea id="code4" name="custom_code_body">
						@if(!empty($savedsettings['custom_code_body']))
						{!! $savedsettings['custom_code_body'] !!}
						@endif
						</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<button type="submit" class="btn btn-primary waves-effect waves-light btn-lg">Save All</button>
</div>
</form>
<script>
	var resizefunc = [];
</script>
<script src="{{ asset('assets/plugins/codemirror/js/codemirror.js') }}"></script>
<script src="{{ asset('assets/plugins/codemirror/js/formatting.js') }}"></script>
<script src="{{ asset('assets/plugins/codemirror/js/xml.js') }}"></script>
<script>
!function($) {
    "use strict";

    var CodeEditor = function() {};

    CodeEditor.prototype.getSelectedRange = function(editor) {
        return { from: editor.getCursor(true), to: editor.getCursor(false) };
    },
    CodeEditor.prototype.autoFormatSelection = function(editor) {
        var range = this.getSelectedRange(editor);
        editor.autoFormatRange(range.from, range.to);
    },
    CodeEditor.prototype.commentSelection = function(isComment, editor) {
        var range = this.getSelectedRange(editor);
        editor.commentRange(isComment, range.from, range.to);
    },
    CodeEditor.prototype.init = function() {
        var $this = this;
        //init plugin
        CodeMirror.fromTextArea(document.getElementById("code1"), {
            mode: {name: "xml", alignCDATA: true},
            lineNumbers: true
        });
        //example 2
        CodeMirror.fromTextArea(document.getElementById("code2"), {
            mode: {name: "xml", alignCDATA: true},
            lineNumbers: true
        });
		CodeMirror.fromTextArea(document.getElementById("code3"), {
            mode: {name: "xml", alignCDATA: true},
            lineNumbers: true
        });
		CodeMirror.fromTextArea(document.getElementById("code4"), {
            mode: {name: "xml", alignCDATA: true},
            lineNumbers: true
        });

        //CodeMirror.commands["selectAll"](editor);

        //binding controlls
        $('.autoformat').click(function(){
            $this.autoFormatSelection(editor);
        });
        
        $('.commentbtn').click(function(){
            $this.commentSelection(true, editor);
        });
        
        $('.uncomment').click(function(){
            $this.commentSelection(false, editor);
        });
    },
    //init
    $.CodeEditor = new CodeEditor, $.CodeEditor.Constructor = CodeEditor
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CodeEditor.init()
}(window.jQuery);
$(document).ready(function() {
	$('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
	$('.colorpicker-rgba').colorpicker();
})
</script>

@endsection
