@extends('layouts.app')

@section('extra')


@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right">
					<button class="btn btn-default waves-effect waves-light btn-sm pull-right" data-toggle="modal" data-target="#con-close-modal">Add New Theme</button>
				</div>
				<h4 class="page-title">All Themes</h4>
			</div>
			<div class="col-sm-12 m-t-15">	
				
				<div class="row port">
					<div class="portfolioContainer">
						@foreach($themes as $theme)
						<div class="col-sm-6 col-lg-4 col-md-4 webdesign illustrator">
							<div class="gal-detail thumb">
								<img src="{{ asset('/templates/'.$theme['name'].'/screenshot.png') }}" class="thumb-img" alt="work-thumbnail">
								<div class="row">
									<div class="col-xs-4  m-t-15">
									<h5>{{ getThemeName($theme['name']) }}</h5>
									</div>
									<div class="col-xs-8 m-t-15 text-right">
									@if($theme['active'])
									<button type="button" class="btn btn-info btn-rounded waves-effect waves-light" disabled><span class="btn-label"><i class="fa fa-check"></i></span>Activated</button>
									@else
									<button type="button" class="btn btn-info btn-rounded waves-effect waves-light">Active</button>
									@endif
									<button style="margin-left:10px;" type="button" class="btn btn-danger btn-rounded waves-effect waves-light">Remove</button>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div> <!-- End row -->
				
			</div>
    </div>
</div>

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Create New Page</h4> 
			</div> 
			<div class="modal-body"> 
				<div class="row"> 
					<form method="POST" id="createpageform" action="">
					{{ csrf_field() }}
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-1" class="control-label">Title</label> 
							<input type="text" name="title" class="form-control" id="field-1" placeholder="" required> 
						</div> 
					</div> 
					<div class="col-md-12"> 
						<div class="form-group"> 
							<label for="field-2" class="control-label">Slug</label> 
							<input type="text" name="slug" class="form-control" id="field-2" placeholder="" > 
						</div> 
					</div> 
					</form>
				</div> 
			</div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
				<button type="button" id="save" class="btn btn-info waves-effect waves-light">Add Page</button> 
			</div> 
		</div> 
	</div>
</div><!-- /.modal -->
<script type="text/javascript" src="{{ asset('assets/plugins/isotope/js/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript">
	$(window).load(function(){
		var $container = $('.portfolioContainer');
		$container.isotope({
			filter: '*',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});

		$('.portfolioFilter a').click(function(){
			$('.portfolioFilter .current').removeClass('current');
			$(this).addClass('current');

			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			return false;
		}); 
	});
	$(document).ready(function() {
		$('.image-popup').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			mainClass: 'mfp-fade',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			}
		});
	});
</script>

@endsection
