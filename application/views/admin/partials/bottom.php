<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div id="call-ring" class="w3-modal">
      <div class="w3-modal-content w3-animate-zoom">
        <header class="w3-container w3-teal"> 
          <input type="hidden" id="is_calling" value="0" />
          <input type="hidden" id="call_id" value="0">
          <input type="hidden" id="caller_id" value="0">
          <input type="hidden" id="receiver_id" value="0">
          <h5 id="who-is-calling" class="text-center"><span id="caller"></span> is calling...</h5>
        </header>
        <div class="w3-container w3-light-grey w3-padding">
          <div class="pull-right">
          <a id="call-receive" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-phone"></i></a>
          <button id="cancel-call" class="btn btn-danger btn-xs">Cancel</button>
          </div>
        </div>
        <audio id="ringtone">
          <source src="<?php echo base_url('assets/ringtone.mp3');?>" type="audio/mpeg">
        </audio>
      </div>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2018-2019 <a href="#">Decima Technology</a>.</strong> All rights reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
  </div><!-- ./wrapper -->

  <script>
    var base_url = "<?php echo base_url();?>";
  </script>


    <!-- jQuery 2.1.4 -->
    <script src="<?php  echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php  echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <?php if($active == 'call-conference'):?>
      <!-- Select2 -->
      <script src="<?php  echo base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
      <!-- bootstrap time picker -->
      <script src="<?php  echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
    <?php endif;?>
    <!-- DataTables -->
    <script src="<?php  echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?php  echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
    <!-- SlimScroll -->
    <script src="<?php  echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php  echo base_url('assets/plugins/fastclick/fastclick.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php  echo base_url('assets/dist/js/app.min.js');?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php  echo base_url('assets/dist/js/demo.js');?>"></script>
    <script src="<?php  echo base_url('assets/js/main.js');?>"></script>
    <!-- page script -->
    <script>
      $(function () {
        $(".datatable").DataTable();
      });
      <?php if($active == 'call-conference'):?>
      $(function () {
        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
        //Initialize Select2 Elements
        $(".select2").select2();
      });
      <?php endif;?>
    </script>
  </body>
</html>