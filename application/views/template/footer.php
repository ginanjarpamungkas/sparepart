<!-- footer content -->
        <footer>
          <div class="pull-right">
            <i class="fa fa-cogs"></i> Pit Stop - Powered by GEPE
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url();?>assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url();?>assets/perhitungan.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/build/js/custom.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="<?php echo base_url();?>assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script type="text/javascript">
        $('.btneditkomponen').click(function(){

      var id = $(this).attr('id-komponen');

      $.ajax({
        url: "/sparepart/manager/update",
        dataType:'json',
        method:'POST',
        data:{id2:id},
      }).success(function(data) {

        console.log(data.id_invoice);
        
        $('#id_sparepart').val(data.id_sparepart);
        $('#nama_sparepart').val(data.nama_sparepart);
        $('#harga_supplier').val(data.harga_supplier);
        $('#harga_sekarang').val(data.sekarang);
        $('#harga_rencana').val(data.rencana);
        $('#tglrencana').val(data.tglrencana);
        $('#tglsekarang').val(data.tglsekarang);
      });
    });
    </script>

    <script type="text/javascript">
        $('.btnedituser').click(function(){

      var id = $(this).attr('id-komponen');

      $.ajax({
        url: "/sparepart/manager/update_user",
        dataType:'json',
        method:'POST',
        data:{id2:id},
      }).success(function(data) {

        console.log(data.id_invoice);
        
        $('#id_karyawan').val(data.id_user);
        $('.nama_user').val(data.nama_user);
        $('.status').val(data.status);
      });
    });
    </script>

    <script type="text/javascript">
        $('.btneditprofil').click(function(){

      var id = $(this).attr('id-user');

      $.ajax({
        url: "/sparepart/welcome/profil",
        dataType:'json',
        method:'POST',
        data:{id2:id},
      }).success(function(data) {

        console.log(data.id_invoice);
        
        $('#id_user').val(data.id_user);
        $('#nama_user').val(data.nama_user);
        $('#username').val(data.username);
        $('#password').val(data.password);
        $('#status').val(data.status);
        $('#since').val(data.tanggal);
      });
    });
    </script>

  </body>
</html>