@extends('layouts.master')

@section('content')

<style type="text/css">
//
#overlay_custom{
}
.cv-spinner {
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	}
.spinner {
	width: 40px;
	height: 40px;
	border: 4px #ddd solid;
	border-top: 4px #2e93e6 solid;
	border-radius: 50%;
	animation: sp-anime 0.8s infinite linear;
	}
@keyframes sp-anime {
	100% {
	transform: rotate(360deg);
	}
}
.is-hide{
	display:none;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content">
	<div id="overlay" style=" position: fixed;top: 0;z-index: 100;width: 100%;height:100%;display: none;background: rgba(0,0,0,0.6);">
		<div class="cv-spinner">
			<span class="spinner"></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Short URLs List</h3>
				</div>
				<div class="box-body">
					<div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
						<p>Short URLs Deleted Successfully.</p>
					</div>
					<div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
						<ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
					</div>
					<table id="example1" class="table table-bordered table-striped">
					@if(Sentinel::check())
						@if(Sentinel::getUser()->inRole('administrator') ||
						Sentinel::getUser()->inRole('supervisor') ||
						Sentinel::getUser()->inRole('super_admin'))
						<div class="add">
							<a href="{{URL::route('add_short_url')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add Short URLs</a>
						</div>
						@endif
					@endif
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Domain</th>
							<th>Title</th>
							<th>Long URL</th>
							<th>Short URLs</th>
							<th>App</th>
							<th>Device</th>
							<th>Hits</th>
							<th>Tags</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php $a=1; ?>
					@forelse($data as $single)
						<tr>
							<td>{{ $a++ }}</td>

							<td>{{ $single->url_domain }}</td>

							<td>{{ $single->url_title }}</td>

							<td>
								{{ $single->long_url }}
							</td>

							<td>
								@if($single->url_domain=='rapidextravels')
									https://www.rapidextravels.com/{{ $single->short_code }}
								@else
									https://www.theworldgateway.com/{{ $single->short_code }}
								@endif
							</td>
							<td class="textCapitalize">{{ $single->url_app }}</td>

							<td class="textCapitalize">{{ $single->url_device }}</td>

							<td>
								<?php $hits=DB::table('short_urls_link_tracking')->where('short_url_id',$single->id)->get(); ?>
								{{ count($hits) }}</td>

							<td>{{ $single->url_tags }}</td>

							<td>
								<form action="{{ URL::to('/delete_short_url/'.$single->id) }}" onsubmit="return confirm('Are you sure you want to delte this?');" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="id" value=""/>
									@if(Sentinel::check())
									@if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
										<a href="{{ URL::to('/edit_short_url/'.$single->id) }}">
											<button type="button" class="btn btn-sm btn-warning">Edit</button>
										</a>
									@endif
									@endif
									@if(Sentinel::check())
										@if(Sentinel::getUser()->inRole('administrator') ||
										Sentinel::getUser()->inRole('super_admin'))
										<button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
										@endif
									@endif
								</form>
							</td>
						</tr>
						@empty
						<tr>
							<th colspan="9" class="text-center text-danger"> Short URLs Not Found</th>
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