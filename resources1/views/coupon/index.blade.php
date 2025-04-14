@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <!--icon management start-->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Coupon List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                        <p>Coupon Deleted Successfully.</p>
                    </div>
                    <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                        <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        @if(Sentinel::check())
                        @if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin'))
                        <div class="add">
                            <a href="{{URL::to('/Add-Coupon')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Coupon</a>
                        </div>
                        @endif
                        @endif
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Coupon Name</th>
                                <th>Coupon Description</th>
                                <!-- <th>Type</th> -->
                                <th>Coupon Value</th>
                                <th>Coupon Start Date</th>
                                <th>Coupon End Date</th>
                                <th>Coupon Code</th>
                                <th>CouponStatus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $single)
                            <tr>
                                <td>{{ $single->id }}</td>

                                <td>{{ $single->coupon_name }}</td>

                                <td>
                                    {{ $single->coupon_desc }}
                                </td>

                                <!-- <td>{{ $single->type }}</td> -->

                                <td>{{ $single->value }} %</td>

                                <?php
                                    $startdate=date('d-m-Y', strtotime($single->start_date ));
                                    $enddate=date('d-m-Y', strtotime($single->end_date ));
                                ?>
                                <td>{{ $startdate }}</td>

                                <td>{{ $enddate  }}</td>

                                <td>{{ $single->coupon_code }}</td>

                                <td>
                                    <button type="button" class="btn btn-sm no-event {{ $single->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                        {{ $single->status == 1 ? 'Enabled' : 'Disabled' }}
                                    </button>
                                </td>

                                <td>
                                    <form action="{{URL::to('/Delete-Coupon/'.$single->id)}}" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                                        <span class="">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value=""/>
                                            @if(Sentinel::check())
                                                @if(Sentinel::getUser()->inRole('super_admin') ||
                                                Sentinel::getUser()->inRole('administrator') ||
                                                Sentinel::getUser()->inRole('supervisor'))
                                                <a href="{{ URL::to('/Edit-Coupon/'.$single->id) }}">
                                                    <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                                </a>
                                                @endif
                                            @endif
                                            @if(Sentinel::check())
                                                @if(Sentinel::getUser()->inRole('super_admin') ||
                                                Sentinel::getUser()->inRole('administrator'))
                                                <button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
                                                @endif
                                            @endif
                                        </span>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="9" class="text-center text-danger"> Testimonial No Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!--icon management end-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection