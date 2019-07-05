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
                    <h2>Struk Pembayaran <small><?php echo $beli->tgl_beli;?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button data-toggle="tooltip" title="Print Struk" onclick="window.print()"><i class="fa fa-print"></i></button><a data-toggle="tooltip" title="Cetak PDF" href="<?php echo base_url()?>cetak/index/<?php echo $beli->id_beli ?>" class="btn btn-default"><i class="glyphicon glyphicon-save-file"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <p align="center">Jl. Raya Bogor Km.41 RT.005 Cibinong <br> <b>Kwitansi No : KT<?php echo $beli->id_beli;?></b></p>

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nama Spareparts</th>
                            <th class="column-title">Harga Satuan</th>
                            <th class="column-title">Jumlah Sparepart</th>
                            <th class="column-title">Harga Total</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($bayar as $r): ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $r->nama_sparepart;?></td>
                            <td class=" ">Rp. <?php echo number_format($r->harga_supplier,0,".",".");?></td>
                            <td class=" "><?php echo $r->jumlah_beli;?> pcs</td>
                            <td class=" ">Rp. <?php echo number_format($r->total_harga,0,".",".");?></td>
                          </tr><?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="pull-right">
                          <tr>
                            <td>Jumlah Harga </td>
                            <td><b>:</b> Rp. <?php echo number_format($beli->total_beli,0,".",".");?></td>
                          </tr>
                          <tr>
                            <td>Tunai</td>
                            <td><b>:</b> Rp. <?php echo number_format($beli->tunai,0,".",".");?></td>
                          </tr>
                          <tr>
                          <td>Kembali</td>
                          <td><b>:</b> Rp. <?php echo number_format($beli->kembali,0,".",".");?></td>
                          </tr>
                        </table>
                    </div>
                    <p align="center"> Terimakasih atas kerjasama anda <br> ==== LAYANAN KONSUMEN PIT STOP SPAREPARTS ==== <br> SMS: 081227535208   CALL: 15045 <br> E-mail: Ginanjar69919082@gmail.com</p>
                  </div>
                </div>
              </div>
            </div>
            </div>
        