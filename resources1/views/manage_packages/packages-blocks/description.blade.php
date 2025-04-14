<div class="row">

                          <!-- tour description -->
                          <div class="col-md-12">
                            <div class="form-group item-container custom_inc_exc">
                              <label class="collapse-toggle">Tour Description</label>
                              <br><br>
                              <span class="show_hide morePlus">More+</span>
                              <textarea class="form-control ckeditor" placeholder="Package Description..." name="description" id="" cols="30" rows="5">{{ $packagesData->description }}</textarea>
                            </div>
                          </div>
                            
                          <!-- tour highlights -->
                          <div class="col-md-12">
                            <div class="form-group item-container custom_inc_exc">
                              <label class="collapse-toggle">Tour Highlights</label>
                              <br><br>
                              <span class="show_hide morePlus">More+</span>
                              <textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5">{{$packagesData->highlights}}</textarea>
                            </div>
                          </div>
                        </div>