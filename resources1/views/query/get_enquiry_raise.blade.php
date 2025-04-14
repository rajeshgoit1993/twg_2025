<form method="POST" id="close_raise_concern" name="close_raise_concern" enctype="multipart/form-data">
    <!-- CSRF Protection -->
    {{ csrf_field() }}
    
    <!-- Hidden Input for Query Reference -->
    <input type="hidden" name="query_reference" value="{{ $query_reference }}">
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <td>Select</td>
                        <td>S.No.</td>
                        <td>Date & Time</td>
                        <td>Raise</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    @foreach($datas as $data)
                        <tr>
                            <!-- Checkbox for selecting raise concern -->
                            <td><input type="checkbox" name="raise_id[]" value="{{ $data->id }}"></td>

                            <!-- Serial number -->
                            <td>{{ $a++ }}</td>

                            <!-- Formatted date and time -->
                            <td>{{ date('d-m-Y h:i A', strtotime($data->created_at)) }}</td>

                            <!-- Raise concern description -->
                            <td>{{ $data->raise_concern }}</td>
                            
                            <!-- Status with color coding -->
                            <td>
                                @if($data->status == 0)
                                    <span style="color:red">Pending</span>
                                @elseif($data->status == 1)
                                    <span style="color:yellow">Open</span>
                                @else
                                    <span style="color:green">Closed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <?php 
            // Fetch pending, open, and latest concern records
            $pending = DB::table('quote_raise_concern')
                ->where([['query_reference', (int)$query_reference], ['status', 0]])
                ->get();
            $open = DB::table('quote_raise_concern')
                ->where([['query_reference', (int)$query_reference], ['status', 1]])
                ->get();
            $last = DB::table('quote_raise_concern')
                ->where('query_reference', (int)$query_reference)
                ->latest()
                ->first();
            ?>

            <div class="form-group">
                <!-- Status Dropdown -->
                <label for="status">Status <span class="requiredcolor">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="" selected disabled>Select</option>
                    @if(count($pending) > 0)
                        <option value="0" selected>Pending</option>
                        <option value="1">Open</option>
                        <option value="2">Close</option>
                    @elseif(count($pending) == 0 && count($open) > 0)
                        <option value="1" selected>Open</option>
                        <option value="2">Close</option>
                    @else
                        <option value="2" selected>Close</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <!-- Remarks Textarea -->
                <label>Remarks</label>
                <textarea class="form-control" name="raise_remarks">
                    @if($last != ''){{ $last->admin_remarks }}@endif
                </textarea>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Extra column, currently empty -->
        </div>
    </div>
    
    <div class="modal-footer">
        <div class="text-center appendBottom20">
            <!-- Submit button if there are pending or open concerns -->
            @if(count($pending) > 0 || count($open) > 0)
                <button type="submit" name="submit_close_raise" id="close_raise_submit" class="btnblue font-weight600 location_add" style="width: 20%; height: 30px">
                    Update
                </button>
            @endif
        </div>
    </div>
</form>