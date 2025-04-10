			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="copyRightCont">
					<div>
						<h4>{{ getWebsiteData('startingYear') }} - {{ date('Y') }}, {{ getWebsiteData('copyRight') }}</h4>
					</div>
					<div>
						<h4>{{ getWebsiteData('developerName') }}</h4>
					</div>
				</div>
			</footer>
		</div><!-- ./wrapper -->

		<!-- backend script starts -->
		@include('layouts.backend.backend-script')
		<!-- backend script ends -->
	</body>
</html>