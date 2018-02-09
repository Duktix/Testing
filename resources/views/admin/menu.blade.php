@extends('layouts.app')

@section('extra')
<link href="{{ asset('assets/plugins/nestable/jquery.nestable.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<style>
.panel-title{
	text-transform:none;
}
.dd{
	max-width:400px;
}
.custom-dd .dd-list .dd-item .dd-handle {
    height: 30px;
    border-radius: 0;
    background: #36404a;
	    line-height: 26px;
}
.bootstrap-select.btn-group .dropdown-menu.inner{
	max-height:300px !important;
}
.custom-dd .well{
	margin-bottom:5px;
}
</style>
<script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script>
jQuery(document).ready(function($){
	$('#nestable_list').nestable();
})
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Menu Settings</h4>
			</div>
			<div class="col-sm-12 m-t-15">	
				<div class="card-box">
					<div class="row">
						<div class="col-sm-3">
							<p class="m-t-5 m-b-0">Select a menu to edit: </p>
						</div>
						<div class="col-sm-4">
							<select class="selectpicker selectmenu" data-live-search="true"  data-style="btn-white">
								<option value="">Select Menu</option>
								@foreach($menus as $menu)
								<option value="{{ $menu->id }}" @if(!empty($currentmenu) && $currentmenu->id == $menu->id) {{ "selected" }} @endif>{{ $menu->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-5">
							<p class="m-t-5 m-b-0"> Or <a href="{{ route('menu.create') }}">create a new menu</a>.</p>
						</div>
					</div>
				</div>
			</div>
			@if (\Session::has('success'))
				<div class="col-sm-12 m-t-15">
				<div class="alert alert-success">
					{!! \Session::get('success') !!}
				</div>
				</div>
			@endif
			<div class="col-sm-12 m-t-15">	
				<div class="row">
					<div class="col-sm-3">
						<div class="panel panel-default"> 
							<div class="panel-heading"> 
								<h4 class="panel-title"> 
									<a data-toggle="collapse" data-parent="#accordion-test-2" href="#pages" class="" aria-expanded="false">
										Pages
									</a> 
								</h4> 
							</div> 
							<div id="pages" class="panel-collapse collapse in"> 
								<div class="panel-body">
									@foreach($pages as $page)
									<div class="checkbox">
										<input id="page_{{ $page->title }}" type="checkbox">
										<label for="page_{{ $page->title }}">
										{{ $page->title }}
										</label>
										<div class="checkbox_data">
											<input type="hidden" name="title[]" value="{{ $page->title }}">
											<input type="hidden" name="link[]" value="{{ $page->slug }}">
											<input type="hidden" name="classes[]" value="">
											<input type="hidden" name="target[]" value="">
											<input type="hidden" name="type[]" value="page">
										</div>
									</div>
									@endforeach
								</div> 
								<div class="panel-footer">
									<button type="button" class="btn btn-white waves-effect addpages">Add To Menu</button>
								</div>
							</div> 
						</div> 
						<div class="panel panel-default"> 
							<div class="panel-heading"> 
								<h4 class="panel-title"> 
									<a data-toggle="collapse" data-parent="#accordion-test-2" href="#custom" class="" aria-expanded="false">
										Custom
									</a> 
								</h4> 
							</div> 
							<div id="custom" class="panel-collapse collapse"> 
								<div class="panel-body">
									<div class="form-group">
										<label for="title">Title:</label>
										<input type="text" class="form-control" id="title">
									</div>
									<div class="form-group">
										<label for="link">Link:</label>
										<input type="text" class="form-control" id="link">
									</div>
								</div> 
								<div class="panel-footer">
									<button type="button" class="btn btn-white waves-effect addcustom">Add To Menu</button>
								</div>
							</div> 
						</div> 
					</div>
					<form method="post" action="
					@if(!empty($currentmenu))
						{{ route("menu.update", $currentmenu->id) }}
					@else
						{{ route("menu.store") }}
					@endif
					">
					{{csrf_field()}}
					@if(!empty($currentmenu))
						<input type='hidden' name='_method' value='PATCH' />
					@endif
					<div class="col-sm-9">
						<div class="panel panel-default"> 
							<div class="panel-heading"> 
								<h4 class="panel-title"> 
									<div class="row">
										<div class="col-sm-2">
											<p class="m-t-5 m-b-0">Menu Name</p> 
										</div>
										<div class="col-sm-4">
											<input class="form-control" type="text" placeholder="Menu Name Here" name="menu_name" value="@if(!empty($currentmenu)) {{ $currentmenu->name }} @endif" required>
										</div>
										<div class="col-sm-6 text-right">
											@if(!empty($currentmenu)) 
												<button type="submit" class="btn btn-primary">Update Menu</button>
											@else
												<button type="submit" class="btn btn-primary">Create Menu</button>
											@endif
										</div>
									</div>
								</h4> 
							</div> 
							<div class="panel-collapse collapse in"> 
								<div class="panel-body">
									<div class="custom-dd dd" id="nestable_list">
										<ol class="dd-list">
										@if(!empty($currentmenu))
											{!! loopmenu($currentmenu) !!}
										@endif
										</ol>
									</div>
									<input type="hidden" name="order" value="">
								</div> 
								<div class="panel-footer text-right">
									@if(!empty($currentmenu)) 
										<button type="submit" class="btn btn-primary">Update Menu</button>
									@else
										<button type="submit" class="btn btn-primary">Create Menu</button>
									@endif
								</div>
							</div> 
						</div> 
					</div>
					</form>
				</div>
			</div>
			
    </div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery('input[name="order"]').val(JSON.stringify(jQuery('.custom-dd').nestable('serialize')));
	jQuery('.addpages').click(function(){
		jQuery('#pages .checkbox input[type="checkbox"]').each(function(){
			var totalitem = jQuery('.dd-list li').length;
			var nextitem = totalitem+1;
			var inputs = '<input type="hidden" name="dataID[]" value="'+nextitem+'">'+jQuery(this).parents('.checkbox').find('.checkbox_data').html();
			if(jQuery(this).is(":checked")){
				var title = jQuery(this).parents('.checkbox').find('input[name="title[]"]').val();
				jQuery('#nestable_list .dd-list').eq(0).append('<li class="dd-item" data-id="'+nextitem+'"><div class="dd-handle dd3-handle"></div><div class="dd3-content">'+title+'</div>'+inputs+'</li>');
				jQuery(this).prop("checked", false);
			}
		})
		jQuery('input[name="order"]').val(JSON.stringify(jQuery('.custom-dd').nestable('serialize')));
	})
	jQuery('.addcustom').click(function(){
		var totalitem = jQuery('.dd-list li').length;
		var nextitem = totalitem+1;
		var title = jQuery('#custom #title').val();
		var link = jQuery('#custom #link').val();
		var inputs = '<input type="hidden" name="dataID[]" value="'+nextitem+'"><input type="hidden" name="title[]" value="'+title+'"><input type="hidden" name="link[]" value="'+link+'"><input type="hidden" name="classes[]" value=""><input type="hidden" name="target[]" value=""><input type="hidden" name="type[]" value="custom">';
		
		jQuery('#nestable_list .dd-list').eq(0).append('<li class="dd-item" data-id="'+nextitem+'"><div class="dd-handle dd3-handle"></div><div class="dd3-content">'+title+'</div>'+inputs+'</li>');
			
		jQuery('input[name="order"]').val(JSON.stringify(jQuery('.custom-dd').nestable('serialize')));
		jQuery('#custom #title').val('');
		jQuery('#custom #link').val('');
	})
	jQuery('.custom-dd').on('change', function() {
		jQuery('input[name="order"]').val(JSON.stringify(jQuery('.custom-dd').nestable('serialize')));
	});
	jQuery('.selectmenu').change(function(){
		window.location.href= '{{ route("menu.index") }}/'+jQuery(this).val()+'/edit';
	})
	jQuery('.custom-dd').on('click', '.deleteitem', function(){
		var item = jQuery(this);
		if (confirm('Are you sure ?')) {
			item.parents('.custom-dd').find('li[data-id="'+item.attr('data-target')+'"]').fadeOut();
			setTimeout(function(){ item.parents('.custom-dd').find('li[data-id="'+item.attr('data-target')+'"]').remove(); }, 500);
		}
	})
})
</script>
@endsection
