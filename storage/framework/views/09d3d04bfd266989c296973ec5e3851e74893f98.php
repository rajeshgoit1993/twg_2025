									<!--Desktop Tour Tabs-Overview Starts-->
									<div class="dTourPkgDesc">
										<?php if($details->description!=""): ?>
										<!--<div class="dTourDesc" style="display: none;">
											<h2>Tour Description</h2>
											<p><?php echo $details->description; ?></p>
										</div>-->
										<?php endif; ?>
										<?php if($details->description!="" && $details->highlights!=""): ?>
										<?php endif; ?>
										<?php if($details->highlights!=""): ?>
										<div class="dTourHgLhts dHgLhtsSeparator">
											<h2>Tour Highlights</h2>
											<p><?php echo $details->highlights; ?></p>
										</div>
										<?php endif; ?>
									</div>
									<!--Desktop Tour Tabs-Overview Ends-->