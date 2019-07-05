<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-cogs"></i> Pit Stop <small>Spareparts</small></h3>
              </div>
            </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laporan Pembelian Harian</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  <form action="<?php echo base_url()?>manager/baction_harian" method="POST">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                       <h4>Cari dari tanggal</h4>
                    </div>

                    <div class="col-md-3 xdisplay_inputx form-group has-feedback">        
                      <input type="text" class="form-control has-feedback-left" name="awal" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <h4>Sampai Tanggal</h4>
                    </div>

                    <div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                
                      <input type="text" class="form-control has-feedback-left" name="akhir" id="single_cal4" placeholder="First Name" aria-describedby="inputSuccess2Status3">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <input type="submit" name="" value="Cari" onclick="tgl()" class="btn btn-info"></p>
                    </div>
                 </div>
                  </form><br><br>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Tanggal Transaksi</th>
                          <th>Nama Sparepart</th>
                          <th>Jumlah Sparepart Terbeli</th>
                          <th>Harga Supplier (pcs)</th>
                          <th>Harga Total</th>
                        </tr>
                      </thead>

                        <tbody>
                        <?php foreach ($beli as $r): ?>
                          <tr>
                            <td><?php echo $r->tglbeli;?></td>
                            <td><?php echo $r->nama_sparepart;?></td>
                            <td><?php echo $r->jumlah_beli;?> pcs</td>
                            <td>Rp. <?php echo number_format($r->harga_supplier,0,".",".");?></td>
                            <td>Rp. <?php echo number_format($r->total_harga,0,".",".");?></td>
                          </tr><?php endforeach ?>
                           
                        </tbody>
                      </table>
                         <tr>
                            <td colspan="3"></td>
                            <td><h4><b>Total Pengeluaran</b></h4></td>
                            <td><h4><b>Rp. <?php echo number_format($bulan->SumOftotal,0,".",".");?></b></h4></td>
                          </tr>            
                  </div>

                  
                </div>
              </div>
            </div>
            </div>
        