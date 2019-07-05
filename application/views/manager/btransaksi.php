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
                    <h2>Daftar Kwitansi Pembelian</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <p>Bukti transaksi. Klik <i class="glyphicon glyphicon-eye-open"></i> untuk melihat kwitansi</p>
                  <div class="x_content">
                       <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Kwitansi No</th>
                            <th>Tanggal Pembelian</th>
                            <th>Jumlah Harga</th>
                            <th>Gudang</th>
                            <th>Action</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($beli as $r): ?>
                          <tr>
                            <td>KT<?php echo $r->id_beli;?></td>
                            <td><?php echo $r->tanggal;?></td>
                            <td>Rp. <?php echo number_format($r->total_beli,0,".",".");?></td>
                            <td><?php echo $r->nama_user;?></td>
                            <td align="center"><a href="<?php echo base_url()?>manager/bdetail/<?php echo $r->id_beli?>" data-toggle="tooltip" title="View Struk"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                          </tr><?php endforeach ?>
                        </tbody>
                      </table>

                  </div>
                </div>
              </div>
            </div>
            </div>
        