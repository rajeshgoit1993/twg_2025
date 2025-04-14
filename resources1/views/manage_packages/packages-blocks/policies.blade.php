<div id="Additional">
                      
                        <div class="row">
                          <div class="col-md-12">

                          <!-- visa policy -->
                          <div class="item-container">
                            <div class="row">
                              <div class="form-group visaOption">
                                <label for="">Add Visa Policy</label>
                                <input type="checkbox" @if($packagesData->visa == 1) checked @endif name="visa" value="1" id="customize_onrequestvisa" />
                              </div>
                              <div class="col-md-12 costomize_tour_visa" @if($packagesData->visa == 1) style="display:block" @else style="display:none" @endif>
                                <h5>Visa Policy</h5>
                                <table class="table table-bordered" id="dynamic_field">
                                  <tbody>
                                    <tr>
                                      <td style="width: 60%;">
                                        <div>
                                        <select name="package_visa[]" class="select2 form-control" multiple>
                                        @foreach($visaPolicy as $pol)
                                        @if(empty($packagesData->visa_p))
                                        <option value="{{$pol->id}}">{{$pol->policy}}
                                        </option>
                                        @else
                                        <option value="{{$pol->id}}" @if(in_array($pol->id,$packagesData->visa_p) ) selected="selected" @endif >{{$pol->policy}}
                                        </option>
                                        @endif
                                        @endforeach
                                        </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control">{{$packagesData->visa_policy}}
                                        </textarea>
                                        <!--<input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- payment policy -->
                          <div class="item-container">
                            <div class="row">
                              <div class="form-group visaOption">
                                <label>Add Payment Policy</label>
                              </div>
                              <div class="col-md-12">
                                <h5>Payment Policy</h5>
                                <table class="table table-bordered" id="dynamic_field">
                                  <tbody>
                                      <tr>
                                        <td style="width: 60%;">
                                          <div>
                                          <select name="package_payment[]" class="select2 form-control" multiple>
                                            @foreach($paymentPolicy as $pol)
                                            @if(empty($packagesData->payment_p))
                                              <option value="{{$pol->id}}">{{$pol->policy}}</option>
                                            @else
                                              <option value="{{$pol->id}}" @if(in_array($pol->id,$packagesData->payment_p) ) selected="selected" @endif >{{$pol->policy}}
                                            </option>
                                            @endif
                                            @endforeach
                                          </select>
                                          </div>
                                        </td>
                                      </tr>
                                    <tr>
                                      <td>
                                        <textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control">{{$packagesData->payment_policy}}
                                        </textarea>
                                        <!--<input type="hidden" name="payment_policies" id="payment_policies_input" value=""/>-->
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- cancellation policy -->
                          <div class="item-container">
                            <div class="row">
                              <div class="form-group visaOption">
                                <label>Add Cancellation Policy</label>
                              </div>
                              <div class="col-md-12">
                                <h5>Cancellation Policy</h5>
                                <table class="table table-bordered" id="dynamic_field">
                                  <tbody>
                                    <tr>
                                      <td style="width: 60%;">
                                        <div>
                                          <select name="package_can[]" class="select2 form-control" multiple>
                                            @foreach($cancelPolicy as $pol)
                                            @if(empty($packagesData->can_p))
                                              <option value="{{$pol->id}}">{{$pol->policy}}</option>
                                            @else
                                              <option value="{{$pol->id}}" @if(in_array($pol->id,$packagesData->can_p) ) selected="selected" @endif >{{$pol->policy}}
                                            </option>
                                            @endif
                                            @endforeach
                                          </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control">{{$packagesData->cancel_policy}}
                                        </textarea>
                                        <!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- important notes -->
                          <div class="item-container">
                            <div class="row">
                              <div class="form-group visaOption">
                                <label>Add Important Notes</label>
                              </div>
                              <div class="col-md-12">
                                <h5>Important Notes</h5>
                                <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td style="width: 60%;">
                                        <div>
                                          <select name="package_impnotes[]" class="select2 form-control" multiple>
                                            @foreach($imp_notes as $pol)
                                            @if(empty($packagesData->importantnotes))
                                              <option value="{{$pol->id}}">{{$pol->policy}}</option>
                                            @else
                                              <option value="{{$pol->id}}" @if(in_array($pol->id,$packagesData->importantnotes) ) selected="selected" @endif >{{$pol->policy}}
                                            </option>
                                            @endif
                                            @endforeach
                                          </select>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <textarea name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control">{{$packagesData->extranotes}}
                                        </textarea>
                                        <!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          </div>
                        </div>
                      </div>