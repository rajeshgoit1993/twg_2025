
<div class="col-md-2">
                                    <div class="form-group">
                                      <label for="country">Country</label>
                                      <select class="form-control country" name="country" >
                                        <option value="">Select Country</option>
                                          @foreach($countries as $cont)
                                            <option value="{{ $cont->id }}">{{ $cont->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>

                                    <!-- State Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">State</label>
                                        <select class="form-control states" name="state" >
                                            <option value="">Select State</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- City Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">City</label>
                                        <select class="form-control city" name="city">
                                            <option value="">Select City</option>
                                        </select>
                                      </div>
                                    </div>