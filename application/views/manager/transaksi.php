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
                    <h2>Daftar Struk Transaksi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <p>Bukti transaksi. Klik <i class="glyphicon glyphicon-eye-open"></i> untuk melihat struk</p>
                  <div class="x_content">
                       <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Nota No</th>
                            <th>Tanggal manager</th>
                            <th>Jumlah Harga</th>
                            <th>Kasir</th>
                            <th>Action</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($jual as $r): ?>
                          <tr>
                            <td>NN<?php echo $r->id_jual;?></td>
                            <td><?php echo $r->tgl_jual;?></td>
                            <td>Rp. <?php echo number_format($r->total_jual,0,".",".");?></td>
                            <td><?php echo $r->nama_user;?></td>
                            <td align="center"><a href="<?php echo base_url()?>manager/detail/<?php echo $r->id_jual?>" data-toggle="tooltip" title="View Struk"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                          </tr><?php endforeach ?>
                        </tbody>
                      </table>

                  </div>
                </div>
              </div>
            </div>
            </div>
        