<div class="modal fade" id="informatie-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #ffc45e;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><setText id="globalModalTitle"></setText></h4>
			</div>
			<div class="modal-body">
				<setText id="globalModalBody"></setText>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./wrapper -->
<div class="footer">
    <div id="bottom">
        <div id="bottombanner"></div>
        <div id="pagebottom" class="pageTopOrBottom">
        </div>
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 0.0.1
            </div>
            <strong>Copyright &copy; 2016 <a href="http://ubun07">Telesur</a>.</strong>
        </div>
        <!-- /.container -->
    </footer>
</div>

	<!-- jQuery 2.2.3 -->
	<script src="<?php echo BASE_HREF;?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo BASE_HREF;?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo BASE_HREF;?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo BASE_HREF;?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo BASE_HREF;?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo BASE_HREF;?>assets/plugins/fastclick/fastclick.js"></script>
	<script src="<?php echo BASE_HREF;?>assets/plugins/bootstrap-select-master/js/bootstrap-select.js"></script>
	<!-- charts -->
	<script src= "<?php echo BASE_HREF;?>assets/plugins/Highcharts-4.2.6/js/highcharts.js"></script>
	<script src="<?php echo BASE_HREF;?>assets/plugins/Highcharts-4.2.6/js/modules/exporting.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo BASE_HREF;?>assets/js/app.min.js"></script>
	<!-- Typeahead -->
	<script src="<?php echo BASE_HREF;?>assets/js/bootstrap-typeahead.js"></script>
	<!-- datepicker-->
	<script src="<?php echo BASE_HREF;?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<!-- IP format -->
	<script src="<?php echo BASE_HREF;?>assets/plugins/input-mask/jquery.input-ip-address-control.js"></script>
	
	<script>
		// To style all <select>s
		$('select').selectpicker();

		function setInfoModal(title,body){
			$('#globalModalTitle').empty();
			$('#globalModalBody').empty();
			$('#globalModalTitle').append(title);
			$('#globalModalBody').append(body);
			
			$('#informatie-modal').modal('show');
		}
	</script>
	
