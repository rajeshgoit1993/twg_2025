@extends('layouts.master')
@section('content')
<style>
.package_changefreq_type {
	display: none;
}
.destination_changefreq_type {
	display: none;
}
.loading {
	position: absolute;
	left: 0;
	right: 0;
	top: 50%;
	width: 100px;
	color: #000;
	margin: auto;
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
	-o-transform: translateY(-50%);
	transform: translateY(-50%);
	padding-top: 20px;
}
.loading span {
	position: absolute;
	height: 10px;
	width: 84px;
	top: 50px;
	overflow: hidden;
}
.loading span > i {
	position: absolute;
	height: 4px;
	width: 4px;
	border-radius: 50%;
	-webkit-animation: wait 4s infinite;
	-moz-animation: wait 4s infinite;
	-o-animation: wait 4s infinite;
	animation: wait 4s infinite;
}
.loading span > i:nth-of-type(1) {
	left: -28px;
	background: yellow;
}
.loading span > i:nth-of-type(2) {
	left: -21px;
	-webkit-animation-delay: 0.8s;
	animation-delay: 0.8s;
	background: lightgreen;
}
@-webkit-keyframes wait {
	0%   { left: -7px  }
	30%  { left: 52px  }
	60%  { left: 22px  }
	100% { left: 100px }
}
@-moz-keyframes wait {
	0%   { left: -7px  }
	30%  { left: 52px  }
	60%  { left: 22px  }
	100% { left: 100px }
}
@-o-keyframes wait {
	0%   { left: -7px  }
	30%  { left: 52px  }
	60%  { left: 22px  }
	100% { left: 100px }
}
@keyframes wait {
	0%   { left: -7px  }
	30%  { left: 52px  }
	60%  { left: 22px  }
	100% { left: 100px }
}



/* Styles for the icon container */
.dashboard-item-icon-cont {
    border-radius: 50%; /* Round icon container */
    width: 50px; /* Set width */
    height: 50px; /* Set height */
    display: flex; /* Use flexbox for centering */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}

/* Card hover effect */
.card {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow on hover */
    border-radius: 10px;
}

/* Card hover effect */
.card:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); /* Subtle shadow on hover */
    transition: box-shadow 0.3s ease; /* Smooth transition */
}

/* Media object styles */
.media {
    align-items: center; /* Center the items in media */
}

/* General padding and margin adjustments */
.card-body {
    padding: 20px; /* Space inside the card */
}

.text-muted {
    margin-top: 5px; /* Space above description */
}

/* Button styles */
.btn-success {
    font-weight: bold; /* Make button text bold */
    padding: 10px 20px; /* Adjust button padding */
}

.package_link {
    transition: background-color 0.3s; /* Smooth background change */
}

.package_link:hover {
    background-color: #28a745; /* Darker green on hover */
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">

<div class="row">
  <div class="col-md-12">
    <!-- Main Container Box -->
    <div class="box">
      <div class="box-header">
      	<h3 class="box-title">Download Link for SEO</h3>
      </div>
      <!-- /.box-header -->

      <div class="box-body">
        <!-- Success Message Container (Hidden by Default) -->
        <div class="alert alert-success success-container-parent-hotel" id="success-container-parent-hotel" style="display:none">
          <p>Gateway deleted successfully.</p>
        </div>

        <!-- Error Message Container (Hidden by Default) -->
        <div class="alert alert-danger error-container-parent-hotel" style="display:none">
          <ul class="error-container-hotel" id="error-container-hotel"></ul>
        </div>

        <!-- Links Section -->
        <div class="row">
          <!-- Package Tour Link -->
          <!-- <div class="col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading">Package Tour Link</div>
              <br>
              <div class="textCenter" style="padding: 10px;">
                <button class="btn btn-success package_link">Download Tour Link <i class="apndLft5 fontSize14 fa">&#xf08e;</i>
                </button>
              </div>
            </div> -->
        
			<div class="col-md-3 col-sm-6 col-xs-12">
			    <a href="#" class="text-decoration-none">
			        <div class="card">
			            <div class="card-body">
			                <div class="media">
			                    <div class="media-left">
			                        <div class="bg-success text-center dashboard-item-icon-cont">
			                            <i class="fa fa-download fa-lg text-white"></i>
			                        </div>
			                    </div>
			                    <div class="media-body">
			                        <h5 class="media-heading">Package Tour Link</h5>
			                        <p class="text-muted">Download your tour link here</p>
			                    </div>
			                </div>
			                <div class="text-center mt-3">
			                    <button class="btn btn-success package_link">Download Tour Link
			                    	<i class="apndLft5 fa fa-download me-2"></i>
			                    </button>
			                </div>
			            </div>
			        </div>
			    </a>
			</div>

          	<!-- Country, State & City Link Panel -->
          	<!-- <div class="col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading">Country, State & City Link</div>
              <br>
              <div class="textCenter" style="padding: 10px;">
                <button class="btn btn-success destination_link">Downlaod Destination Link <i class="apndLft5 fontSize14 fa">&#xf08e;</i>
                </button>
              </div>
            </div>
          	</div> -->
          	<!-- Country, State & City Link -->
			<div class="col-md-3 col-sm-6 col-xs-12">
			    <a href="#" class="text-decoration-none">
			        <div class="card">
			            <div class="card-body">
			                <div class="media">
			                    <div class="media-left">
			                        <div class="bg-success text-center dashboard-item-icon-cont">
			                            <i class="fa fa-download fa-lg text-white"></i>
			                        </div>
			                    </div>
			                    <div class="media-body">
			                        <h5 class="media-heading">Destination Link (Country,State,City)</h5>
			                        <p class="text-muted">Download destination link here</p>
			                    </div>
			                </div>
			                <div class="text-center mt-3">
			                    <button class="btn btn-success destination_link">Download Destination Link
			                        <i class="apndLft5 fa fa-download me-2"></i>
			                    </button>
			                </div>
			            </div>
			        </div>
			    </a>
			</div>


        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="package_link_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content" style="border-radius: 5px">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="" value="" id="bookId">
        <h4 class="modal-title">Package Link</h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;">
        
        <!-- Link Type Selection -->
        <label>Select Link Type</label>
        <select class="form-control package_link_type" name="link_type">
          <option value="">Select</option>
          <option value="0">with sitemap</option>
          <option value="1" selected>without sitemap</option>
        </select>

        <!-- Package Change Frequency Options -->
        <div class="package_changefreq_type">
          <label>Package Changefreq</label>
          <select class="form-control package_changefreq" name="package_changefreq">
            <option value="" disabled>Select</option>
            <option value="Yearly">Yearly</option>
            <option value="Monthly">Monthly</option>
            <option value="Weakly">Weekly</option>
          </select>

          <!-- Priority Options -->
          <label>Priority</label>
          <select class="form-control package_priority" name="package_priority">
            <option value="0.9">0.9</option>
            <option value="0.8">0.8</option>
            <option value="0.7">0.7</option>
            <option value="0.6">0.6</option>
            <option value="0.5">0.5</option>
            <option value="0.4">0.4</option>
            <option value="0.3">0.3</option>
            <option value="0.2">0.2</option>
            <option value="0.1">0.1</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div style="text-align: right; padding: 10px;">
          <button class="btn btn-success download_package_link" type="submit">Submit</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Destination Link Modal -->
<div class="modal fade" id="destination_link_modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content" style="border-radius: 5px">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="" value="" id="bookId">
        <h4 class="modal-title">Destination Link</h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;">
        
        <!-- Destination Type Selection -->
        <label>Select Destination Type</label>
        <select class="form-control destination_type" name="destination_type">
          <option value="Country">Country</option>
          <option value="State">State</option>
          <option value="City">City</option>
        </select>

        <!-- Link Type Selection -->
        <label>Select Link Type</label>
        <select class="form-control destination_link_type" name="link_type">
          <option value="">Select</option>
          <option value="0">with sitemap</option>
          <option value="1" selected>without sitemap</option>
        </select>

        <!-- Destination Change Frequency Options -->
        <div class="destination_changefreq_type">
          <label>Destination Changefreq</label>
          <select class="form-control destination_changefreq" name="destination_changefreq">
            <option value="" disabled>Select</option>
            <option value="Yearly">Yearly</option>
            <option value="Monthly">Monthly</option>
            <option value="Weakly">Weekly</option>
          </select>

          <!-- Priority Options -->
          <label>Priority</label>
          <select class="form-control destination_priority" name="destination_priority">
            <option value="0.9">0.9</option>
            <option value="0.8">0.8</option>
            <option value="0.7">0.7</option>
            <option value="0.6">0.6</option>
            <option value="0.5">0.5</option>
            <option value="0.4">0.4</option>
            <option value="0.3">0.3</option>
            <option value="0.2">0.2</option>
            <option value="0.1">0.1</option>
          </select>
        </div>

        <!-- Submit Button -->
        <div style="text-align: right; padding: 10px;">
          <button class="btn btn-success download_destination_link" type="submit">Submit</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loding_modal" role="dialog">
  <div class="modal-dialog modal-sm">
    
    <!-- Modal Content -->
    <div class="modal-content" style="min-height: 80px;">
      
      <!-- Modal Body -->
      <div class="modal-body custom_border" id="modal-body" style="font-size: 15px; line-height: 24px;">
        
        <!-- Loading Message -->
        <div class="loading">
          <p>Please wait</p>
          <span><i></i><i></i></span>
        </div>

      </div>
    </div>
  </div>
</div>

</section>
<!-- /.content -->
</div>

<div class="testing">
	<input type="hidden" value="{{url('/')}}" name="" id="test">
</div>

<!-- /.content-wrapper -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	// Show package link modal on button click
	$(document).on("click", ".package_link", function() {
		$('#package_link_modal').modal('show');
	});

	// Toggle display of the package change frequency options based on selected link type
	$(document).on("change", ".package_link_type", function() {
		var package_link_type = $(this).val();

		if (package_link_type === '' || package_link_type == '1') {
			// Hide change frequency options if no selection or "without sitemap" option is chosen
			$(".package_changefreq_type").css("display", "none");
		} else {
			// Show change frequency options for "with sitemap" selection
			$(".package_changefreq_type").css("display", "block");
		}
	});

	// Handle package link download click event
	$(document).on("click", ".download_package_link", function() {
		var package_link_type = $(".package_link_type").val();
		var package_changefreq = $(".package_changefreq").val();
    	var package_priority = $(".package_priority").val();

    	// Validation checks for required fields
    	if (package_link_type === '') {
      		alert('Kindly select package link type');
    	} else if (package_link_type == 0 && package_changefreq === '') {
      		alert('Kindly select package changefreq');
    	} else {
	      	// Create a form for POST submission to initiate download
	      	var form = document.createElement("form");
	      	document.body.appendChild(form);
	      	form.method = "POST";
	      	form.action = "get_package_link";
	      	form.target = "_blank";

	      	// Append CSRF token
	      	var csrfToken = document.createElement("INPUT");
	      	csrfToken.name = "_token";
	      	csrfToken.value = $('meta[name="csrf-token"]').attr('content');
	      	csrfToken.type = 'hidden';
	      	form.appendChild(csrfToken);

	      	// Append package link type
	      	var linkTypeInput = document.createElement("INPUT");
	      	linkTypeInput.name = "package_link_type";
	      	linkTypeInput.value = package_link_type;
	      	linkTypeInput.type = 'hidden';
	      	form.appendChild(linkTypeInput);

	      	// Append package change frequency
	      	var changefreqInput = document.createElement("INPUT");
	      	changefreqInput.name = "package_changefreq";
	      	changefreqInput.value = package_changefreq;
	      	changefreqInput.type = 'hidden';
	      	form.appendChild(changefreqInput);

	      	// Append package priority
	      	var priorityInput = document.createElement("INPUT");
	      	priorityInput.name = "package_priority";
	      	priorityInput.value = package_priority;
	      	priorityInput.type = 'hidden';
	      	form.appendChild(priorityInput);

	      	// Submit form to download link
	      	form.submit();
	      
	      	// Hide the package link modal
	      	$('#package_link_modal').modal('hide');

	      	// Optionally show loading modal (uncomment below if needed)
	      	// $('#loding_modal').modal('show');

	      	// AJAX logic for file download (uncomment if required for a specific use case)
	      	
	      	/*$.ajax({
	        	xhrFields: {
	          		responseType: 'blob',
	        	},
	        	type: 'POST',
	        	url: APP_URL + '/get_package_link',
	        	data: {
	          		package_link_type: package_link_type,
	          		package_changefreq: package_changefreq,
	          		package_priority: package_priority,
	        	},
	        	success: function(result, status, xhr) {
	          		$('#loding_modal').modal('hide');
	          		var disposition = xhr.getResponseHeader('content-disposition');
	          		var matches = /"([^"]*)"/.exec(disposition);
	          		var filename = (matches != null && matches[1] ? matches[1] : 'Packages Links.xlsx');
	          		var blob = new Blob([result], {
	            		type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	          		});
	          		var link = document.createElement('a');
	          		link.href = window.URL.createObjectURL(blob);
	          		link.download = filename;
	          		document.body.appendChild(link);
	          		link.click();
	          		document.body.removeChild(link);
	        	}
	      	});*/
	    }
  	});
});


$(document).ready(function() {
	// Show the destination link modal on button click
  	$(document).on("click", ".destination_link", function() {
    	$('#destination_link_modal').modal('show');
  	});

  	// Toggle the display of destination change frequency options based on link type selection
  	$(document).on("change", ".destination_link_type", function() {
    	var destination_link_type = $(this).val();
    	if (destination_link_type === '' || destination_link_type == 1) {
      		$(".destination_changefreq_type").css("display", "none");
    	} else {
      	$(".destination_changefreq_type").css("display", "block");
    	}
  	});

  	// Handle the download button click for destination links
  	$(document).on("click", ".download_destination_link", function() {
    	var destination_link_type = $(".destination_link_type").val();
    	var destination_changefreq = $(".destination_changefreq").val();
    	var destination_type = $(".destination_type").val();
    	var destination_priority = $(".destination_priority").val();

    	if (destination_link_type === '') {
      		alert('Kindly select destination link type');
    	} else if (destination_link_type == 0 && destination_changefreq === '') {
      		alert('Kindly select destination changefreq');
    	} else {
      	// Create form for submitting the destination link download request
      	var form = document.createElement("form");
      	document.body.appendChild(form);
      	form.method = "POST";
      	form.action = "get_destination_link";
      	form.target = "_blank";

      	// Add CSRF token
      	var csrfToken = document.createElement("INPUT");
      	csrfToken.name = "_token";
      	csrfToken.value = $('meta[name="csrf-token"]').attr('content');
      	csrfToken.type = 'hidden';
      	form.appendChild(csrfToken);

      	// Add other form inputs
      	var linkTypeInput = document.createElement("INPUT");
      	linkTypeInput.name = "destination_link_type";
      	linkTypeInput.value = destination_link_type;
      	linkTypeInput.type = 'hidden';
      	form.appendChild(linkTypeInput);

      	var changefreqInput = document.createElement("INPUT");
      	changefreqInput.name = "destination_changefreq";
      	changefreqInput.value = destination_changefreq;
      	changefreqInput.type = 'hidden';
      	form.appendChild(changefreqInput);

      	var typeInput = document.createElement("INPUT");
      	typeInput.name = "destination_type";
      	typeInput.value = destination_type;
      	typeInput.type = 'hidden';
      	form.appendChild(typeInput);

      	var priorityInput = document.createElement("INPUT");
      	priorityInput.name = "destination_priority";
      	priorityInput.value = destination_priority;
      	priorityInput.type = 'hidden';
      	form.appendChild(priorityInput);

      	// Submit the form and hide the modal
      	form.submit();
      	$('#destination_link_modal').modal('hide');
    	}
  	});
});

</script>
<!-- /.content-wrapper -->
@endsection