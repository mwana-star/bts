{{-- <footer class="bg-white shadow-sm border-top p-2 text-center fixed-bottom">
    <p class="mb-0">Copyright © 2023. All right reserved.</p>
</footer> --}}
<!--start overlay-->
<div class="search-overlay"></div>
<div class="overlay toggle-icon"></div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js ')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/variable-pie.js')}}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/accessibility.js')}}"></script>
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>

<script>
    new PerfectScrollbar('.dashboard-top-countries');
</script>

<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );

			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>

<script src="{{ asset('assets/js/index.js')}}"></script>

<!-- google maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKXKdHQdtqgPVl2HI2RnUa_1bjCxRCQo4&amp;callback=initMap" async defer></script>
<script src="{{ asset('assets/plugins/gmaps/map-custom-script.js') }}"></script>

<script src="{{ asset('assets/js/app.js')}}"></script>

</body>


<!-- Mirrored from codervent.com/mons/synadmin/demo/vertical/authentication-signup-with-header-footer.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Jul 2023 05:39:44 GMT -->

</html>
