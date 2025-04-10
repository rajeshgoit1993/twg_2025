          <!--Mobile Tour Tabs-Inclusions Starts-->
          <div class="mTourPkgDesc">
            <?php if($details->inclusions!=""): ?>
            <div class="mTourInclusions"> 
              <h2>Inclusions</h2>
              <p><?php echo $details->inclusions; ?></p>
            </div>
            <?php endif; ?>
            <?php if($details->exclusions!=""): ?>
            <div class="mTourInclusions" id="description">
              <h2>Exclusions</h2>
              <p><?php echo $details->exclusions; ?></p>
            </div>
            <?php endif; ?>
          </div>
          <!--Mobile Tour Tabs-Inclusions Ends-->