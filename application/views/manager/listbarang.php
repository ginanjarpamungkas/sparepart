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
                          <th>Harga Supplier</th>
                          <th>Harga Jual</th>
                          <th>Rencana Harga Jual</th>
                          <th>Tanggal Berlaku Harga</th>
                          <th>Stock</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php $no=1?>
                          <?php $n=0?>
                          <?php foreach ($sport as $i): ?>
                            <td><?php echo $i->nama_sparepart; ?></td>
                            <td>Rp. <?php echo number_format($i->harga_supplier,0,".",".");?></td>
                            <td>Rp. <?php echo number_format($i->sekarang,0,".",".");?></td>
                            <td>Rp. <?php echo number_format($i->rencana,0,".",".");?></td>
                            <td><?php echo $i->tglrencana; ?></td>
                            
                            <td><?php if($i->stok <= 10 ){
                              echo "<span class='btn btn-danger' data-toggle='tooltip' title='Stok Terbatas'>".$i->stok."</span>";
                              } else {
                              echo "<span class='btn btn-success' data-toggle='tooltip' title='Stok Cukup'>".$i->stok."</span>";
                              } ?></td>
                            <td><span data-toggle="tooltip" title="Edit Harga Jual">
                                          <a data-toggle="modal" data-target="#editkomponen" id-komponen="<?php echo $i->id_sparepart?>" class=" btn btn-primary btneditkomponen">
                                             <i class="fa fa-edit"></i>Edit Harga
                                          </a>
                                       </span></td>
                          <?php $no++?>
                          </tr>
                          <?php endforeach ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
            </form>
            <a class="btn btn-primary" data-toggle="modal"  data-toggle="tooltip" title="Tambah Barang" href='#modal-id'>Add</a>
            <input type="hidden" id="max" value="<?php echo $no-1?>">
            </div>
            </div>
<div class="modal fade" id="editkomponen" role="dialog">
      <div class="modal-dialog">
         
         <!-- Modal content--> 
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title"><center>Form Perencanaan Harga</center></h4>
            </div>
            <div class="modal-body">
               <form action="<?php echo base_url(); ?>manager/update_action/id_sparepart" id="" method="post" name="login">
                  <div class="form-group has-feedback">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Nama Sparepart</label>
                           <input type="text" class="form-control" placeholder="Merk" name="nama_sparepart" id="nama_sparepart" value="nama_sparepart" readonly/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>

                        <div class="col-md-6 col-lg-6">
                           <label for="int">Harga Supplier</label>
                           <input type="number" step="0.01" class="form-control" placeholder="Tipe" name="harga_supplier" id="harga_supplier" value="harga_supplier" readonly/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>
                     </div>
                  <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Harga Jual</label>
                           <input type="text" class="form-control" placeholder="" name="harga_sekarang" id="harga_sekarang" value="harga_sekarang" readonly/>
                        </div>
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Berlaku Tanggal</label>
                          <input type="text" class="form-control" placeholder="" name="tglsekarang" id="tglsekarang" value="tglsekarang" readonly="" />
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                     <label for="int">Rencana Harga</label>
                     <input type="text" class="form-control" placeholder="Rencana Harga" name="harga_rencana" id="harga_rencana" value="harga_rencana" onkeydown="return(f_validchar('0123456789',event))"  required/>
                    </div>
                    <div class="col-md-6 col-lg-6">
                           <label for="int">Tanggal Rencana</label>
                          <input type="text" class="form-control" placeholder="" name="tglrencana" id="tglrencana" value="tglrencana" readonly="" />
                          
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-lg-12">
                           <label for="int">Ubah Tanggal Rencana</label>
                          <input type="text" class="form-control has-feedback-left" name="awal" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                          <input class="form-control" type="hidden" id="id_sparepart" name="id_sparepart" value="id_sparepart" readonly>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
               <span data-toggle="tooltip" title="Batal">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
               </span>
               <span data-toggle="tooltip" title="Simpan Perubahan">
               <button type="submit" class="btn btn-primary " href="">Simpan</button>
               </span>
            </div>
            </form>
         </div>
         
      </div>
   </div>
   <div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Pembelian Sparepart Baru</h4>
      </div>
      <div class="modal-body">
               <form action="<?php echo base_url(); ?>manager/input" id="" method="post" name="login">
                  <div class="form-group has-feedback">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Nama Sparepart</label>
                           <input type="text" class="form-control" placeholder="Nama Sparepart" name="nama_sparepart" id="nama_sparepart"/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>
                        <div class="col-md-3 col-lg-3">
                        <label for="int">Jenis Motor</label>
                          <select name="jenis" class="form-control">
                          <?php foreach ($list as $l): ?>
                            <option value="<?php echo $l->list; ?>"><?php echo $l->list; ?></option>
                          <?php endforeach ?>
                          </select>
                        </div>
                        <div class="col-md-3 col-lg-3">
                           <label for="int">Harga Supplier</label>
                           <input type="text" class="form-control" placeholder="Nominal" name="harga_supplier" id="harga_supplier" onkeydown="return(f_validchar('0123456789',event))"/>
                        </div>
                     </div>
                     <hr>
                  <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Harga Jual</label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <input type="checkbox" value="Plate Clamping Cavity"> Plate Clamping Cavity</input>
                         <input type="checkbox" value="Plate Clamping Cavity"> Plate Clamping Cavity</input>
                         <input type="checkbox" value="Plate Clamping Cavity"> Plate Clamping Cavity</input>
                       </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                     <label for="int">Rencana Perubahan Harga</label>
                     <input type="text" class="form-control" placeholder="Rencana Harga" name="harga2" id="harga_rencana" onkeydown="return(f_validchar('0123456789',event))"  required/>
                    </div>
                    <div class="col-md-6 col-lg-6">
                           <label for="int">Tanggal Rencana</label>
                          <input type="text" class="form-control has-feedback-left" name="tgl2" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status3">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                          
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
               <span data-toggle="tooltip" title="Batal">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
               </span>
               <span data-toggle="tooltip" title="Simpan Perubahan">
               <button type="submit" class="btn btn-primary " href="">Simpan</button>
               </span>
            </div>
            </form>
    </div>
  </div>
</div>