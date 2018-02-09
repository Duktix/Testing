@extends('layouts.app')

@section('extra')

<link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>

<style>
#processeshtml .customcol{
	border: 1px solid #eaeaea;
	    margin-top: 10px;
    min-height: 100px;
}
#processeshtml .customcol:before{
	content: "";
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    border: 2px dashed #eaeaea;
    position: absolute;
    top: 33px;
	border-top: 0;
}
.is-section{
	clear:both;
	margin-top:15px;
}
#processeshtml .customcol:after{
	content:"Add Content";
	color: #eaeaea;
    text-transform: uppercase;
    font-size: 12px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%);
    margin-top: 10px;
}
#processeshtml .customcol .boxelement{
	background-color:#ffffff;
	position:relative;
	    z-index: 9;
		clear: both;
    min-height: 40px;
}
#processeshtml .customcol.hascontent:after{
	display:none;
}
.customrow{
	margin-bottom:10px;
}
removable{
	margin: 0 -10px;
    border-bottom: 1px solid #eaeaea;
	    display: block;
}
removable .btn,removable .btn:hover{
	border-radius:0;
	border-bottom:0 !important;
}
removable .modal .btn{
	    border-bottom: 1px solid #eaeaea !important;
}
.addcol{
	border-bottom:0 !important;
}
.increcol,.decrecol,.addtext{
	border-bottom:0 !important;
	border-top:0 !important;
}
</style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Footer Settings</h4>
			</div>
			@if (\Session::has('success'))
			<div class="col-sm-12 m-t-15">
				<div class="alert alert-success">
					{!! \Session::get('success') !!}
				</div>
			</div>
			@endif
			<div class="col-sm-12 m-t-15">	
				<div class="card-box">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><button id="addrow" class="btn btn-icon waves-effect waves-light btn-white"> <i class="fa fa-plus"></i> Add Row</button><button id="clear" class="btn btn-icon waves-effect waves-light btn-white pull-right"> <i class="fa fa-minus"></i> Clear All</button></h3>
						</div>
						<div class="panel-body">
							<div id="processeshtml">
							@if(!empty($savedsettings['html']))
								{!! $savedsettings['html'] !!}
							@endif
							</div>
							<form id="savefooter" method="post" action="{{ route("settings.savefooter") }}" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" name="settingType" value="footer">
							<input type="hidden" name="html" value="">
							</form>
						</div>
					</div>
				</div>
			</div>
    </div>
</div>
<div class="container-fluid">
	<button type="button" id="savehtml" class="btn btn-primary waves-effect waves-light btn-lg">Save</button>
</div>

<div id="add-ele-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
				<h4 class="modal-title">Add New Text</h4> 
			</div> 
			<div class="modal-body"> 
				<div class="row"> 
					<textarea id="content" name="area"></textarea>
				</div> 
			</div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
				<button type="button" id="insertele" class="btn btn-info waves-effect waves-light">Add</button> 
				<input type="hidden" name="colid" value="">
			</div> 
		</div> 
	</div>
</div><!-- /.modal -->
<script>
jQuery(document).ready(function(){
	jQuery('#addrow').click(function(){
		var randomnumber = Math.floor(Math.random() * (100000 + 1) + 1);
		var html = "<div class='is-section' id='row_"+randomnumber+"'><div class='container'><div class='row customrow'><removable><button class='addcol btn btn-icon waves-effect waves-light btn-white'> <i class='fa fa-plus'></i> Add Col</button><button class='settings btn btn-icon waves-effect waves-light btn-white rowsetting'  data-toggle='modal' data-target='#add-setting-modal-row_"+randomnumber+"'> <i class='fa fa-cog'></i></button></removable></div></div>";
		html += '<removable><div id="add-setting-modal-row_'+randomnumber+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Advance Settings</h4></div><div class="modal-body">';
		html += '<div class="checkbox"><input type="checkbox" name="sectionwidth" id="sectionwidth'+randomnumber+'"><label for="sectionwidth'+randomnumber+'">Fullwidth</label></div>';
		html += '<div class="input"><label class="control-label">Custom Classes</label><input type="text" name="customclasses" placeholder="Custom Classes" class="form-control"></div>';
		html += '<div class="input m-t-10"><label class="control-label">Background Color</label><div data-color-format="rgba" data-color="rgba(0,0,0,0)" class="colorpicker-rgba input-group"><input type="text" name="bg_color" readonly="readonly" value="rgba(0,0,0,0)" class="form-control"><span class="input-group-btn add-on"><button class="btn btn-white" type="button"><i style="background-color:rgba(0,0,0,0);margin-top: 2px;"></i></button> </span></div></div>';
		html += '<div class="input m-t-10"><label class="control-label">Background Image</label><input type="text" name="bg_image" placeholder="Image Source" class="form-control"></div>';
		html += '<div class="input m-t-10"><label class="control-label">Text Color</label><div data-color-format="rgba" data-color="rgba(0,0,0,1)" class="colorpicker-rgba input-group"><input type="text" name="text_color" readonly="readonly" value="rgba(0,0,0,1)" class="form-control"><span class="input-group-btn add-on"><button class="btn btn-white" type="button"><i style="background-color:rgba(0,0,0,1);margin-top: 2px;"></i></button> </span></div></div>';
		html += '</div><div class="modal-footer"><button type="button" class="saverowsetting btn btn-info waves-effect waves-light">Save</button><input type="hidden" name="rowid" value="row_'+randomnumber+'"></div></div></div></div></removable>';
		html += "</div>";
		jQuery('#processeshtml').append(html);
	})
	jQuery('#clear').click(function(){
		jQuery('#processeshtml').html('');
	})
	jQuery('#processeshtml').on('click', '.addcol', function(){
		var randomnumber = Math.floor(Math.random() * (1000000 + 1) + 1);
		jQuery(this).parents('.customrow').append('<div class="col-sm-12 customcol" id="col_'+randomnumber+'"><removable><div class="text-right"><button class="addtext btn btn-icon waves-effect waves-light btn-white pull-left"> <i class="fa fa-plus"></i> Add Content</button><button class="decrecol btn btn-icon waves-effect waves-light btn-white"> <i class="fa fa-minus"></i></button><button class="increcol btn btn-icon waves-effect waves-light btn-white"> <i class="fa fa-plus"></i></button></div></removable></div>');
	})
	jQuery('#processeshtml').on('click', '.decrecol', function(){
		var col = jQuery(this).parents('.customcol').attr('class').replace('customcol', '');
		var currentcol = col.split('-');
		if(currentcol[2]>1){
			var newcol = parseInt(currentcol[2]) - 1;
			jQuery(this).parents('.customcol').removeClass(col).addClass('col-sm-'+newcol);
		}
	})
	jQuery('#processeshtml').on('click', '.increcol', function(){
		var col = jQuery(this).parents('.customcol').attr('class').replace('customcol', '');
		var currentcol = col.split('-');
		if(currentcol[2]<12){
			var newcol = parseInt(currentcol[2]) + 1;
			jQuery(this).parents('.customcol').removeClass(col).addClass('col-sm-'+newcol);
		}
	})
	jQuery('#processeshtml').on('click', '.saverowsetting', function(){
		var row = jQuery('#'+jQuery(this).next('input[name="rowid"]').val());
		// Fullwidth check
		if(row.find('input[name="sectionwidth"]').is(':checked')){
			row.find('input[name="sectionwidth"]').attr('checked', 'checked');
			row.find('.container').addClass('container-fluid').removeClass('container');
		}else{
			row.find('input[name="sectionwidth"]').removeAttr('checked');
			row.find('.container-fluid').addClass('container').removeClass('container-fluid');
		}
		
		// Add Custom Classes
		
		row.attr('data-classes', jQuery(this).parents('.is-section').find('input[name="customclasses"]').val());
		jQuery(this).parents('.is-section').find('input[name="customclasses"]').attr('value', jQuery(this).parents('.is-section').find('input[name="customclasses"]').val());
		
		// Background Color
		row.attr('data-bgcolor', jQuery(this).parents('.is-section').find('input[name="bg_color"]').val());
		jQuery(this).parents('.is-section').find('input[name="bg_color"]').attr('value', jQuery(this).parents('.is-section').find('input[name="bg_color"]').val());
		
		
		row.attr('data-bgimage', jQuery(this).parents('.is-section').find('input[name="bg_image"]').val());
		jQuery(this).parents('.is-section').find('input[name="bg_image"]').attr('value', jQuery(this).parents('.is-section').find('input[name="bg_image"]').val());
		
		row.attr('data-textcolor', jQuery(this).parents('.is-section').find('input[name="text_color"]').val());
		jQuery(this).parents('.is-section').find('input[name="text_color"]').attr('value', jQuery(this).parents('.is-section').find('input[name="text_color"]').val());
		
		jQuery('#add-setting-modal-'+jQuery(this).parents('.is-section').attr('id')).modal('hide');
	})
	jQuery('#processeshtml').on('click', '.addtext', function(){
		jQuery('#add-ele-modal').modal('show');
		var colID = jQuery(this).parents('.customcol').attr('id');
		jQuery('input[name="colid"]').val(colID);
	})
})
</script>
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		jQuery('#processeshtml').on('click', '.rowsetting', function(){
			$('.colorpicker-rgba').colorpicker();
		})
	})
	$(document).on('focusin', function(e) {
		if ($(e.target).closest(".mce-window").length) {
			e.stopImmediatePropagation();
		}
	});
	$(document).ready(function () {
		if($("#content").length > 0){
			tinymce.init({
				selector: "textarea#content",
				theme: "modern",
				height:300,
				plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
					"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
					"save table contextmenu directionality template paste textcolor"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
				style_formats: [
					{title: 'Bold text', inline: 'b'},
					{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
					{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
					{title: 'Example 1', inline: 'span', classes: 'example1'},
					{title: 'Example 2', inline: 'span', classes: 'example2'},
					{title: 'Table styles'},
					{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
				]
			});    
		}  
		jQuery('#insertele').click(function(){
			var content = tinymce.get("content").getContent();
			var html = "<div class='boxelement'>"+content+"</div>";
			jQuery('#'+jQuery(this).next('input[name="colid"]').val()).append(html);
			jQuery('#add-ele-modal').modal('hide');
		})
		jQuery('#savehtml').click(function(){
			jQuery('input[name="html"]').val(jQuery('#processeshtml').html());
			jQuery('#savefooter').submit();
		})
	});
</script>
@endsection
