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
					<a href="{{ URL::to('/img_gallery') }}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
					<div class="box-header" style="padding: 10px 0;">
						<h3 class="box-title">Add Video In Gallery</h3>
					</div>
					<div class="well">
						<div class="modal-body">
							<form action="{{ URL::to('/store_video_image_gallery/') }}" enctype="multipart/form-data" method="POST" >
								{{csrf_field()}}

								<div class="row">
									@include('manage_packages.country_state_city_insert_tour_gallery') 

									

									<div class="col-md-12"></div>

									<!-- Image name -->
									<div class="col-md-2">
										<div class="form-group">
											<label>Video Name </label>
											<input type="text" class="form-control" name="name" placeholder="Image Name" required>
										</div>
									</div>

									<!-- Thumb File upload -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="image_thumb">Select Video Thumb</label>
											<input type="file" class="form-control" name="image_thumb" id="image_thumb" accept="" required>
										</div>
									</div>

									<!-- Video File upload -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="upload_video">Select Video</label>
											<input type="file" class="form-control" name="uploadvideo" id="upload_video" accept="" required>
										</div>
									</div>

									<div class="col-md-12"></div>

									<!-- Save button -->
									<div class="col-md-4">
										<div class="form-group">
										<button class="btn btn-success">Proceed to add video</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
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