@extends('layouts.app')

@section('extra')

<link href="{{ asset('assets/plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
.buttons{
	display: none;
    padding: 0;
    margin: 0;
}
.buttons li{
	display: inline-block;
    margin-right: 10px;
    font-size: 13px;
    padding-left: 10px;
    border-left: 1px solid #cccccc;
    line-height: 1;
}
.buttons li:first-child{
	border:0;
	padding:0;
}
.table tr:hover .buttons{
	display:block;
}
</style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
			<div class="col-sm-12">
				<div class="btn-group pull-right">
					<button class="btn btn-default waves-effect waves-light btn-sm pull-right" data-toggle="modal" data-target="#con-close-modal">Add New Page</button>
				</div>
				<h4 class="page-title">All Pages</h4>
			</div>
			<div class="col-sm-12 m-t-15">	
				<div class="card-box">
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Slug</th>
								<th>Created on</th>
							</tr>
						</thead>
						<tbody>
							@foreach (json_decode($pages) as $page)
							<tr>
								<td>
								{{ $page->title }}
								<ul class="buttons">
									<li><a href="">View</a></li>
									<li><a href="{{URL::route('pages.edit', $page->id)}}">Edit</a></li>
									<li><a href="{{URL::route('pages.preview', $page->id)}}" target="_blank">Preview</a></li>
									<li><a href="">Trash</a></li>
								</ul>
								</td>
								<td>{{ $page->slug }}</td>
								<td>Published<br />{{ $page->created_at }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
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
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.colVis.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>
<script src="{{ asset('assets/pages/datatables.init.js') }}"></script>
<script>
$(document).ready(function(){
	$('#save').on('click', function(){
		$('#createpageform input[type="text"]').removeClass('parsley-error');
		$.ajax({
            type: "POST",
            url: '{{URL::route('pages.store')}}',
            data: $("#createpageform").serialize(),
            success: function( msg ) {
                if(msg == 'success'){
					window.location.href = "{{URL::route('pages.index')}}";
				}else{
					var obj = jQuery.parseJSON(msg);
					if(obj.error.length>0){
						for(var i = 0; i<obj.error.length; i++){
							$('input[name="'+obj.error[i].field+'"]').addClass('parsley-error');
						}
					}
				}
            }
        });
	})
	TableManageButtons.init();
})
</script>

@endsection
