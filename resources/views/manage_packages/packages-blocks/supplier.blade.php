<div class="item-container">
                          <div class="row">

                            <div class="col-md-12">

                              <div class="form-group">
                                    <label>Supplier</label>
                                    
                                    <select class="form-control" name="supplier_id" id="airfare">
                                  <option value="" >Select Supplier</option>
                                  @foreach($supplier as $suppliers)
                                  <option value="{{$suppliers->id}}" @if($packagesData->supplier_id==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
                                  @endforeach
                                </select>

                                  </div>

                            </div>

                            <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Supplier Remarks</label>
                                    <textarea class="form-control" name="supplier_remarks" placeholder="Supplier Remarks">{{ $packagesData->supplier_remarks }}</textarea>
                                  </div>
                                </div>

                            

                          </div>
                        </div>