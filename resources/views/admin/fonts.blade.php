@extends('layouts.app')

@section('extra')

<script src="{{ asset('assets/plugins/bootstrap-formhelpers/bootstrap-formhelpers-selectbox.js') }}" type="text/javascript"></script>
<link href="{{ asset('assets/plugins/bootstrap-formhelpers/bootstrap-formhelpers.css') }}" rel="stylesheet" type="text/css" />
<style>
.btn-repeat-remove{
	display:none;
}
.newrow .btn-repeat-remove{
	display:block;
}
.newrow .btn-repeat-add{
	display:none;
}
</style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Fonts Settings</h4>
			</div>
			@if (\Session::has('success'))
				<div class="col-sm-12 m-t-15">
						<div class="alert alert-success">
							{!! \Session::get('success') !!}
						</div>
				</div>
			@endif
			<div class="col-sm-6 m-t-15">	
				<div class="card-box">
					<form class="form-horizontal" role="form" id="savefont" method="post" action="{{ route("settings.savefonts") }}">                                    
						<div class="form-group">
							<label class="col-md-2 control-label">Body Font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['body_font']) ? $savedsettings['body_font'] : "Default" }}">
								  <input type="hidden" name="body_font" value="{{ !empty($savedsettings['body_font']) ? $savedsettings['body_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="body_font_size" value="{{ !empty($savedsettings['body_font_size']) ? $savedsettings['body_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="example-email">Paragraph font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['p_font']) ? $savedsettings['p_font'] : "Default" }}">
								  <input type="hidden" name="p_font" value="{{ !empty($savedsettings['p_font']) ? $savedsettings['p_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="p_font_size" value="{{ !empty($savedsettings['p_font_size']) ? $savedsettings['p_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 1 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h1_font']) ? $savedsettings['h1_font'] : "Default" }}">
								  <input type="hidden" name="h1_font" value="{{ !empty($savedsettings['h1_font']) ? $savedsettings['h1_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h1_font_size" value="{{ !empty($savedsettings['h1_font_size']) ? $savedsettings['h1_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div>
												 
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 2 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h2_font']) ? $savedsettings['h2_font'] : "Default" }}">
								  <input type="hidden" name="h2_font" value="{{ !empty($savedsettings['h2_font']) ? $savedsettings['h2_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h2_font_size" value="{{ !empty($savedsettings['h2_font_size']) ? $savedsettings['h2_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 3 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h3_font']) ? $savedsettings['h3_font'] : "Default" }}">
								  <input type="hidden" name="h3_font" value="{{ !empty($savedsettings['h3_font']) ? $savedsettings['h3_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h3_font_size" value="{{ !empty($savedsettings['h3_font_size']) ? $savedsettings['h3_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 	
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 4 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h4_font']) ? $savedsettings['h4_font'] : "Default" }}">
								  <input type="hidden" name="h4_font" value="{{ !empty($savedsettings['h4_font']) ? $savedsettings['h4_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h4_font_size" value="{{ !empty($savedsettings['h4_font_size']) ? $savedsettings['h4_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 	
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 5 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h5_font']) ? $savedsettings['h5_font'] : "Default" }}">
								  <input type="hidden" name="h5_font" value="{{ !empty($savedsettings['h5_font']) ? $savedsettings['h5_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h5_font_size" value="{{ !empty($savedsettings['h5_font_size']) ? $savedsettings['h5_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 	
						<div class="form-group">
							<label class="col-md-2 control-label">Heading 6 font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['h6_font']) ? $savedsettings['h6_font'] : "Default" }}">
								  <input type="hidden" name="h6_font" value="{{ !empty($savedsettings['h6_font']) ? $savedsettings['h6_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="h6_font_size" value="{{ !empty($savedsettings['h6_font_size']) ? $savedsettings['h6_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 		
						<div class="form-group">
							<label class="col-md-2 control-label">Link font</label>
							<div class="col-md-5">
								<div class="bfh-selectbox bfh-googlefonts" data-family="{{ !empty($savedsettings['link_font']) ? $savedsettings['link_font'] : "Default" }}">
								  <input type="hidden" name="link_font" value="{{ !empty($savedsettings['link_font']) ? $savedsettings['link_font'] : "Default" }}">
								  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
									<span class="bfh-selectbox-option input-large" data-option=""></span>
									<b class="caret"></b>
								  </a>
								  <div class="bfh-selectbox-options">
									<input type="text" class="bfh-selectbox-filter form-control">
									<div role="listbox">
									<ul role="option">
									</ul>
								  </div>
								  </div>
								</div>
							</div>
							<div class="col-md-5">
								<input type="text" name="link_font_size" value="{{ !empty($savedsettings['link_font_size']) ? $savedsettings['link_font_size'] : "" }}" class="form-control" placeholder="Font Size">
							</div>
						</div> 
				</div>
			</div>
			<div class="col-sm-6 m-t-15">	
				<div class="card-box">
					<div class="repeaters">
						
						@if(sizeof($savedsettings['classid_font_name'])>0)
							@foreach($savedsettings['classid_font_name'] as $key=>$val)
						
							@endforeach
						@endif
						<div class="repeat row m-t-15">
							<div class="col-sm-5">
								<input type="text" name="classid_font_name[]" class="form-control" placeholder="Class/ID">
							</div>
							<div class="col-sm-3">
									<div class="bfh-selectbox bfh-googlefonts" data-family="Default">
									  <input type="hidden" value="classid_font[]" value="">
									  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
										<span class="bfh-selectbox-option input-large" data-option=""></span>
										<b class="caret"></b>
									  </a>
									  <div class="bfh-selectbox-options">
										<input type="text" class="bfh-selectbox-filter form-control">
										<div role="listbox">
										<ul role="option">
										</ul>
									  </div>
									  </div>
									</div>
							</div>
							<div class="col-sm-3">
								<input type="text" name="classid_font_size[]" class="form-control" placeholder="Font Size">
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-white waves-effect btn-repeat-add">Add</button>
								<button type="button" class="btn btn-white waves-effect btn-repeat-remove">Del</button>
							</div>
						</div>
						
						
						<div class="repeat row m-t-15">
							<div class="col-sm-5">
								<input type="text" name="classid_font_name[]" class="form-control" placeholder="Class/ID">
							</div>
							<div class="col-sm-3">
									<div class="bfh-selectbox bfh-googlefonts" data-family="Default">
									  <input type="hidden" value="classid_font[]" value="">
									  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
										<span class="bfh-selectbox-option input-large" data-option=""></span>
										<b class="caret"></b>
									  </a>
									  <div class="bfh-selectbox-options">
										<input type="text" class="bfh-selectbox-filter form-control">
										<div role="listbox">
										<ul role="option">
										</ul>
									  </div>
									  </div>
									</div>
							</div>
							<div class="col-sm-3">
								<input type="text" name="classid_font_size[]" class="form-control" placeholder="Font Size">
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-white waves-effect btn-repeat-add">Add</button>
								<button type="button" class="btn btn-white waves-effect btn-repeat-remove">Del</button>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>
</div>
{{csrf_field()}}
<input type="hidden" name="settingType" value="fonts">
<div class="container-fluid">
	<button type="submit" class="btn btn-primary waves-effect waves-light btn-lg">Save All</button>
</div>
</form>

<script>
jQuery(document).ready(function(){
	jQuery('.repeaters').on('click', '.btn-repeat-add', function(){
		jQuery(this).parents('.repeat').clone().addClass('newrow').insertAfter(jQuery(this).parents('.repeat'));
	})
	jQuery('.repeaters').on('click', '.btn-repeat-remove', function(){
		jQuery(this).parents('.repeat').remove();
	})
})
</script>
<script src="{{ asset('assets/plugins/bootstrap-formhelpers/prettify.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-formhelpers/bootstrap-formhelpers-googlefonts.codes.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-formhelpers/bootstrap-formhelpers-googlefonts.js') }}" type="text/javascript"></script>
@endsection
