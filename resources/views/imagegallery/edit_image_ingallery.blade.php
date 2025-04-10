@extends('layouts.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
				<div class="box-header"></div>
				<!-- /.box-header -->
				<div class="box-body">
					<a href="{{URL::to('/img_gallery')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a> 
					<h3 class="box-title">Add Image In Gallery</h3>
					<form action="{{URL::to('/update_package_image_gallery/'.$data->id)}}" enctype="multipart/form-data" method="POST" >
						{{csrf_field()}}
						<br>
						<div class="row">
							<div class="col-md-1">Country: </div>
							<div class="col-md-6"><input type="text" name="country" placeholder="Country Name" class="form-control" required value="{{$data->country}}"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-1">City: </div>
							<div class="col-md-6"><input type="text" name="city" placeholder="Country city" class="form-control" required value="{{$data->city}}"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-1">Name: </div>
							<div class="col-md-6"><input type="text" name="name" placeholder="Image Name" class="form-control" value="{{$data->name}}"></div>
						</div>
						<br>
						<div class="row">

							<div class="col-md-1">Choose Image: </div>
							<div class="col-md-6">
						      <img src="{{URL::to('/public/'.$data->image_path)}}"  width="100" style="margin-bottom: 5px">
							  <input type="file" name="uploadimage" class="form-control">
							  <input type="hidden" name="uploadimage_value" value="{{$data->image_path}}">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-6"><button class="btn btn-success">Save</button></div>
						</div>                 
					</form>
				</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection