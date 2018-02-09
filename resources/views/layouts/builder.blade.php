<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<!-- content box -->
	<link href="{{ asset('contentbuilder/box/box.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('contentbuilder/contentbuilder/contentbuilder.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('contentbuilder/contentbox/contentbox.css') }}" rel="stylesheet" type="text/css" />
	@yield('styles')
	
	@yield('scripts')
	@if(!$preview)
	<link href="{{ asset('assets/css/builder.css') }}" rel="stylesheet">
	<script>var csrf_field = '{{csrf_field()}}';</script>
	@endif
	
	@if($preview)
	{!! !empty($headersettings['custom_code_header_others']) ? $headersettings['custom_code_header_others'] : '' !!}
	<style>
	{!! !empty($headersettings['custom_code_header_css']) ? $headersettings['custom_code_header_css'] : '' !!}
	</style>
	<script>
	{!! !empty($headersettings['custom_code_header_js']) ? $headersettings['custom_code_header_js'] : '' !!}
	</script>
	@endif
</head>
<body>
@if($preview)
	{!! !empty($headersettings['custom_code_body']) ? $headersettings['custom_code_body'] : '' !!}
@endif

@if(!$preview)
<div class="builder_controls text-center">
	<div class="container">
		<ul>
			<li><a href="#" class="btn btn-primary" id="add-section">Add New Section</a></li>
			<li><a href="#" class="btn btn-primary" id="save-html">Save</a></li>
			<li><a href="#" class="btn btn-primary" id="view-html">View Full Html</a></li>
		</ul>
	</div>
</div>
@endif

@yield('header')

@if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif

<div class="is-wrapper">
@if($page->html)
	{!! $page->html !!}
@else
	@yield('wrapper')
@endif
</div>

@if(!$preview)
<form id="form1" method="post" style="display:none" action="{{ route("pages.savehtml") }}">
	{{csrf_field()}}
	<input type="hidden" id="pageid" name="pageid" value="{{ $page->id }}" />
	<input type="hidden" id="hidContent" name="hidContent" />
	<input type="submit" id="btnPost" value="submit" />
</form>
@endif

@yield('footer')
@if(!$preview)
<script src="{{ asset('contentbuilder/contentbuilder/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('contentbuilder/contentbuilder/contentbuilder.js') }}" type="text/javascript"></script>
<script src="{{ asset('contentbuilder/contentbuilder/saveimages.js') }}" type="text/javascript"></script>
<script src="{{ asset('contentbuilder/contentbox/contentbox.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/simplelightbox/simple-lightbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('contentbuilder/box/box.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function($){
	$(".is-wrapper").contentbox({
		zoom: 0.85,
		snippetOpen: true,
		snippetFile: '{{ route("pages.snippets") }}',
		contentHtmlStart: '<div class="is-container is-builder container-fluid"><div class="row"><div class="col-md-12">',
		contentHtmlEnd: '</div></div></div>',
		coverImageHandler: '{{ route("pages.savecover") }}',
		//largerImageHandler: 'saveimage-large.php', /* for uploading larger image */
		onRender: function () {
			$('a.is-lightbox').simpleLightbox({ closeText: '<i style="font-size:35px" class="icon ion-ios-close-empty"></i>', navText: ['<i class="icon ion-ios-arrow-left"></i>', '<i class="icon ion-ios-arrow-right"></i>'], disableScroll: false });
		},
		snippetCustomCode: true
	});
	$("#add-section").click(function () {
            $('.is-wrapper').data('contentbox').addSection(); //To add new section, call addSection().
            return false;
    });
	$("#view-html").click(function () {
		$('.is-wrapper').data('contentbox').viewHtml();
		return false;
	});
	$("#save-html").click(function () {
		$("body").saveimages({
			handler: '{{ route("pages.saveimage") }}', /* or saveimage.php - for saving embedded base64 image to image file */
			onComplete: function () {
				//Save Content
				var sHTML = $('.is-wrapper').data('contentbox').html();
				$('#hidContent').val(sHTML);
				$('#btnPost').click();
			}
		});
		$("body").data('saveimages').save();
		$("html").fadeOut(1000);
		return false;
	});
})
</script>
@endif
</body>
</html>