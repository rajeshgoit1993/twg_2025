<div class="col-md-12">
    <div class="form-container makeflex flex-column">
        <form id="searchLead" method="POST" action="/search-lead-results">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="enquiryRefNo">Enquiry Reference No</label>
                        <input type="text" id="enquiryRefNo" name="enquiry_ref_no" placeholder="Enter Enquiry Reference No">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="quoteRefNo">Quote Reference No</label>
                        <input type="text" id="quoteRefNo" name="quote_ref_no" placeholder="Enter Quote Reference No">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="travellerName">Traveller Name</label>
                        <input type="text" id="travellerName" name="travellerName" placeholder="Enter Name">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="travellerEmail">Traveller Email ID</label>
                        <input type="email" id="travellerEmail" name="travellerEmail" placeholder="Enter Email ID">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="travellerMobile">Traveller Mobile No</label>
                        <input type="text" id="travellerMobile" name="travellerMobile" placeholder="Enter Mobile No">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="assignedUser">Assigned Consultant</label>
                        <select id="assignedUser" name="assigned_user">
                            <option value="">Select User</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12"></div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tripBookDateFrom">Booking Date From</label>
                        <input type="date" id="tripBookDateFrom" name="trip_book_date_from">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tripBookDateTo">Booking Date To</label>
                        <input type="date" id="tripBookDateTo" name="trip_book_date_to">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="serviceType">Trip Type</label>
                        <select id="serviceType" name="serviceType">
                            <option value="">Select Trip Type</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="leadStatus">Lead Status</label>
                        <select id="leadStatus" name="lead_status">
                            <option value="">Select Lead Status</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="travelDateFrom">Travel Date From</label>
                        <input type="date" id="travelDateFrom" name="travel_date_from">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="travelDateTo">Travel Date To</label>
                        <input type="date" id="travelDateTo" name="travel_date_to">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-actions">
                        <button type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>