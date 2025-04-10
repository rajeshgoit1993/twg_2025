@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{URL::to('/packageUploads/'.$data->package_id)}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
                        <h3 class="box-title"> Package Image Edit ({{$data1->title}})</h3>
                        <form action="{{URL::to('/update_uploadimage/'.$data->id)}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="Private Tour"/>
                            {{csrf_field()}}

                            <img src="{{URL::to('/').'/public/'.$data->image_path }}" width="100" height="50">
                            <br>
                            <input type="file" class="form-control"   name="upload_image" style="width: 20%;margin-top: 10px">
                            <input type="hidden" name="upload_image_value" value="{{$data->image_path}}">
                            <br>
                            <button type="submit" name="add" class="btn btn-danger btn-lg">Update<i class="fa  fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection