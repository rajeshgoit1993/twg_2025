		<!--Search Panel Tab-Content Starts-->
		<div class="bgGradient webBG">
			<div class="dPageContainer">
				<div class="dSearchPanel">
					<!--Tab Content-->
					<div class="nav-item-content">
			  			<!--Holiday Search Starts-->
			  			<?php echo $__env->make('home.desktop.desktopSearchPanelContent.dTabContent-holidays', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			    		<!--Holiday Search Ends-->

			    		<!--Travel Insurance Search Starts-->
			    		<?php echo $__env->make('home.desktop.desktopSearchPanelContent.dTabContent-travelinsurance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			    		<!--Travel Insurance Search Ends-->
		    		</div>
				</div>
			</div>
		</div>
		<!--Search Panel Tab-Content Ends-->