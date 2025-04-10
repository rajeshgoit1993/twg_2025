              <!--Mobile Tour Tabs-Overview Starts-->
              <div class="mTourPkgDesc">
                <?php if($details->description!=""): ?>
                <div class="mTourDesc">
                  <h2>Description</h2>
                  <p><?php echo $details->description; ?></p>
                </div>
                <?php endif; ?>
                <?php if($details->description!="" && $details->highlights!=""): ?>
                <?php endif; ?>
                <?php if($details->highlights!=""): ?>
                <div class="mTourHgLhts mHgLhtsSeparator">
                  <h2>Tour Highlights</h2>
                  <p><?php echo $details->highlights; ?></p>
                </div>
                <?php endif; ?>
              </div>
              <!--Mobile Tour Tabs-Overview Ends-->