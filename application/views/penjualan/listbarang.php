<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cogs"></i> Pit Stop <small>Spareparts</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <form  method="POST" action="<?php echo base_url()?>penjualan/input" class="form-horizontal" name="form">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Sparepart</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Daftar sparepart motor, laporkan kebagian gudang apabila ada stok terbatas
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Sparepart</th>
                          <th>Harga Satuan</th>
                          <th>Tanggal Berlaku Harga</th>
                          <th>Jenis Motor</th>
                          <th>Stock</th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <?php $no=1?>
                          <?php $n=0?>

                          <?php foreach ($sport as $i): ?>
                            <td><?php echo $i->nama_sparepart; ?></td>
                            <td>Rp. <?php echo number_format($i->nominal,0,".",".");?></td>
                            <td><?php echo $i->tgljual; ?></td>
                            <td><?php echo $i->jenis_motor; ?></td>
                            <td><?php if($i->stok <= 10 ){
                              echo "<span class='btn btn-danger' data-toggle='tooltip' title='Stok Terbatas'>".$i->stok."</span>";
                              } else {
                              echo "<span class='btn btn-success' data-toggle='tooltip' title='Stok Cukup'>".$i->stok."</span>";
                              } ?></td>
                          </tr>
                          <?php $no++?>     
                          <?php endforeach ?>
        
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
            </form>
            <input type="hidden" id="max" value="<?php echo $no-1?>">
            </div>
            </div>