@extends('layouts.app')

@section('extra')

<link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
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
				<h4 class="page-title">Header Settings</h4>
			</div>
			<div class="col-sm-6 m-t-15">	
				<div class="card-box">
					<form class="form-horizontal" role="form">
						@if(sizeof($colors)>0)
							@foreach($colors as $key=>$header)
							<div class="form-group">
								<label class="col-md-2 control-label">{{ $header['title'] }}</label>
								<div class="col-md-10">
									<div data-color-format="rgba" data-color="{{ $header['default'] }}" class="colorpicker-rgba input-group">
											<input type="text" readonly="readonly" value="" class="form-control" placeholder="{{ $header['default'] }}">
											<span class="input-group-btn add-on">
												<button class="btn btn-white" type="button">
													<i style="background-color: {{ $header['default'] }};margin-top: 2px;"></i>
												</button> 
											</span>
										</div>
								</div>
							</div>
							@endforeach
						@endif
					</form>
				</div>
			</div>
			<div class="col-sm-6 m-t-15">	
				<div class="card-box">
					<div class="repeaters">
						<div class="repeat row m-t-15">
							<div class="col-sm-5">
								<input type="text" name="" class="form-control" placeholder="Class/ID">
							</div>
							<div class="col-sm-3">
									<div data-color-format="rgba" data-color="rgba(0,0,0,0)" class="colorpicker-rgba input-group">
										<input type="text" readonly="readonly" value="" class="form-control" placeholder="Default">
										<span class="input-group-btn add-on">
											<button class="btn btn-white" type="button">
												<i style="background-color: rgba(0,0,0,0);margin-top: 2px;"></i>
											</button> 
										</span>
									</div>
							</div>
							<div class="col-sm-3">
								<input type="text" name="" class="form-control" placeholder="Font Size">
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
<script>
jQuery(document).ready(function(){
	jQuery('.repeaters').on('click', '.btn-repeat-add', function(){
		jQuery(this).parents('.repeat').clone().addClass('newrow').insertAfter(jQuery(this).parents('.repeat'));
	})
	jQuery('.repeaters').on('click', '.btn-repeat-remove', function(){
		jQuery(this).parents('.repeat').remove();
	})
})
jQuery(document).ready(function($) {
	$('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
	$('.colorpicker-rgba').colorpicker();
})
</script>
@endsection
