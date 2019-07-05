<div class="right_col aa" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cogs"></i> Pit Stop <small>Spareparts</small></h3>
              </div>

              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="x_title">
                    <h2>Welcome Good People</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div> -->
                  <div class="x_content">
                  <?php if($this->session->flashdata('berhasil')){?>
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <?php echo $this->session->flashdata('berhasil');?>
                    </div>
                  <?php }; ?>
                  
                    <!-- Smart Wizard -->
                    <img src="<?php echo base_url()?>assets/foto/1.png" style="width: 100%">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</body>