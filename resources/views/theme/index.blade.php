@extends('layouts.master')

@section('content')

<style type="text/css">
  .typeImage {
    border: 1px solid #ccc;
    width: 100px;
    height: 75px;
    overflow: hidden;
    border-radius: 5px;
    background-color: #f2f2f2;
  }
  .typeImage img {
    width: 100px;
    height: 75px;
    object-fit: cover;
  }
</style>

<div class="content-wrapper">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Tour Theme</h3>
				</div>
				<div class="box-body">
					<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
						<p>Theme Data Deleted Successfully.</p>
					</div>
					<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
						<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
					</div>

					<table id="example1" class="example1 table table-bordered table-striped">
						@if(Sentinel::check())
						@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
						<div class="add">
							<a href="{{ route('newTheme') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Theme</a>
						</div>
						@endif
						@endif
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Image</th>
								<th width="100">Theme</th>
								<th width="100">Paragraph 1</th>
								<th width="100">Paragraph 2</th>
								<th width="100">About(Front End)</th>
								<th width="200">Title(SEO)</th>
								<th width="200">Key(SEO)</th>
								<th width="200">Description(SEO)</th>
								<th width="100">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php $i="1"; ?>
						@forelse($data as $single)
							<tr>
								<td>{{$i++}}</td>
								<td>
									<div class="typeImage">
							    	@php
							        // Define the default image file name
							        $defaultImage = 'uploads/default-img.webp';
							        $imagePath = public_path('uploads/theme/' . $single->theme_image);

							        // Check if the image exists; otherwise, use the default image
							        $image = (!empty($single->theme_image) && file_exists($imagePath)) 
							                 ? 'uploads/theme/' . $single->theme_image 
							                 : $defaultImage;
							    	@endphp
							    <img src="{{ asset('public/' . $image) }}" alt="img">
							    <input type="hidden" name="edit_img_value" class="edit_img_value" value="{{ $image }}">
								</div>

								</td>
								<td>{{ $single->theme_name }}</td>
								<td>{{ $single->theme_para1 }}</td>
								<td>{{ $single->theme_para2 }}</td>
								<td>{!! substr($single->about_theme,0,50) !!} @if(strlen($single->about_theme)>50) ... @endif</td>
								<td>{{ $single->title }}</td>
								<td>{{ $single->theme_key }}</td>
								<td>{{ substr($single->theme_desc,0,50) }} @if(strlen($single->theme_desc)>50) ... @endif</td>
								<td>
									<form action="{{ route('deleteTheme', $single->id) }} " onsubmit="return confirm('Are you sure, you want to delete this theme?');" method="post">
										{{csrf_field()}}
										<input type="hidden" name="id" value=""/>
											<a class="" href="{{ route('editTheme', $single->id) }}">
												<button type="button" class="btn btn-sm btn-warning">Edit</button>
											</a>
										@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('super_admin'))
											<button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
										@endif
										@endif
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<th colspan="9" class="text-center text-danger">Theme not available</th>
							</tr>
						@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

@endsection