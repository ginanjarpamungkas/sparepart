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
                    <h3>Laporan penjualan tahun <?php echo $bulan->tahun?></h3>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nama Sparepart</th>
                            <th class="column-title">Jumlah Sparepart Terjual</th>
                            <th class="column-title">Harga Satuan (pcs)</th>
                            <th class="column-title">Harga Total</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($jual as $r): ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $r->nama_sparepart;?></td>
                            <td class=" "><?php echo $r->SumOfjumlah;?> pcs</td>
                            <td class=" ">Rp. <?php echo number_format($r->harga_satuan,0,".",".");?></td>
                            <td class=" ">Rp. <?php echo number_format($r->SumOftotal,0,".",".");?></td>
                          </tr><?php endforeach ?>
                          <tr>
                            <td colspan="2"></td>
                            <td><h4><b>Total Pendapatan</b></h4></td>
                            <td><h4><b>Rp. <?php echo number_format($bulan->SumOftotal,0,".",".");?></b></h4></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <form action="<?php echo base_url()?>penjualan/action_tahun" method="POST">
                    <h4>Cari
                    tahun 
                    <?php
                        $f=date_create(date("Y-m-d"));
                        $st= DATE_FORMAT($f, "Y");

                        echo "<select name='tahun'>";
                        for ($a=2016;$a<=$st;$a++)
                        {
                             echo "<option value=' ".$a."'>".$a."</option>";
                        }
                        echo "</select>";
                        ?></h4>
                    <input type="submit" name="" value="Cari" class="btn btn-info">
                  </form>
                  </div>
                </div>
              </div>
            </div>
            </div>