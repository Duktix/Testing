
<div class="navbar navbar-custom {{ !empty($headersettings['static_header']) ? 'sticky':'' }} {{ !empty($headersettings['static_header']) ? 'navbar-fixed-top':'' }}" role="navigation" id="{{ !empty($headersettings['static_header']) ? 'sticky-nav':'' }}">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand logo" href="index.html">
				@if(!empty($headersettings['logo']))
				<img src="{{ $headersettings['logo'] }}" class="img-responsive">
				@endif
			</a>
		</div>
		<div class="navbar-collapse collapse" id="navbar-menu">
			<ul class="nav navbar-nav navbar-right">
				{!! getMenubyID($headersettings['menu_location_top']) !!}
			</ul>

		</div>
	</div>
</div>
