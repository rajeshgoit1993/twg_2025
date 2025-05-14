								<!--Desktop Tour Tabs-Inclusions Starts-->
								<div class="dTourPkgDesc">
									<?php if($details->inclusions!=""): ?>
									<div class="dTourInclusions"> 
										<h2>Tour Inclusions</h2>
										<p><?php echo $details->inclusions; ?></p>
									</div>
									<!--<div class="custom_padding"></div>-->
									<?php endif; ?>
									<?php if($details->exclusions!=""): ?>
									<div class="dTourInclusions" id="description">
										<h2>Tour Exclusions</h2>
										<p><?php echo $details->exclusions; ?></p>
									</div>
									<?php endif; ?>
								</div>
								<!--Desktop Tour Tabs-Inclusions Ends-->