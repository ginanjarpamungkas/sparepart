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
                    <h3>Daftar Karyawan</h3>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  <a class="pull-right btn btn-primary" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-plus"></i>Tambah</a>
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Nama Karyawan</th>
                            <th class="column-title">Jabatan</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Bergabung Sejak</th>
                            <th class="column-title">Action</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                        <?php foreach ($karyawan as $r): ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $r->nama_user;?></td>
                            <td class=" "><?php echo $r->status;?></td>
                            <td class=" "><?php if($r->akses == 1 ){
                              echo "<p>Karyawan Aktif</p>";
                              } else {
                              echo "<p><font color='red'>Karyawan Tidak Aktif</font></p>";
                              } ?></td>
                            <td class=" "><?php echo $r->tanggal;?></td>
                            <td>
                              <?php if($r->akses == 1 ){
                              echo "<a href='".base_url()."manager/change/0/".$r->id_user."' data-toggle='tooltip' title='Nonaktifkan'><i class='glyphicon glyphicon-off'></i>Change</a>";
                              } else {
                              echo "<a href='".base_url()."manager/change/1/".$r->id_user."' data-toggle='tooltip' title='Aktifkan'><i class='glyphicon glyphicon-off'></i>Change</a>";
                              } ?>&nbsp;&nbsp;

                            <a data-toggle="modal" data-target="#edituser" id-komponen="<?php echo $r->id_user?>" class="btn btnedituser"><i class="fa fa-edit"></i>Edit Data</a>
                            </td>
                          </tr><?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>

<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Karyawan</h4>
      </div>
      <div class="modal-body">
       <form action="<?php echo base_url(); ?>manager/addkar" id="" method="post" name="login">
                  <div class="form-group has-feedback">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Nama Karyawan</label>
                           <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama_karyawan" id="nama_karyawan"/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="int">Jabatan</label>
                          <select name="status" class="form-control">
                          <?php foreach ($jabatan as $l): ?>
                            <option value="<?php echo $l->list; ?>"><?php echo $l->list; ?></option>
                          <?php endforeach ?>
                          </select>
                        </div>
                     </div>
                     <hr>
                  <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Username</label>
                           <input type="text" class="form-control" placeholder="Username" name="username" id="username" data-toggle="tooltip" title="Isi username default untuk karyawan"/>
                        </div>
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Password</label>
                           <input type="text" class="form-control" placeholder="Password" name="password" id="password" data-toggle="tooltip" title="Isi password default untuk karyawan"/>
                     </div>
                  </div>
                  <hr>
                  <div class="row">
                  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                  
                    <p align="center">Isi username dan password dengan nama dan tanggal lahir. Beritahu karyawan username dan passwordnya untuk login lalu mintalah mereka menggantinya agar lebih aman.</p>
                  
                  </div>
                  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
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

<div class="modal fade" id="edituser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Karyawan</h4>
      </div>
      <div class="modal-body">
       <form action="<?php echo base_url(); ?>manager/editkar" id="" method="post" name="login">
                  <div class="form-group has-feedback">
                     <div class="row">
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Nama Karyawan</label>
                           <input type="text" class="form-control nama_user" placeholder="Nama Karyawan" name="nama_user" value="nama_user" id="nama_user" required="" data-toggle="tooltip" title="ganti nama karyawan"/>
                           <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                        </div>
                        <div class="col-md-6 col-lg-6">
                           <label for="int">Jabatan</label>
                           <input type="text" class="form-control status" placeholder="Nama Karyawan" name="status" value="status" id="status" readonly="" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <input type="hidden" name="id" value="id_karyawan" id="id_karyawan">
                        </div>
                        <div class="col-md-6 col-lg-6">
                        <label for="int">Ubah Jabatan</label>
                          <select name="jabatan" class="form-control" data-toggle="tooltip" title="Ganti Jabatan Karyawan">
                          <option name="status" value="status" id="status"></option>
                          <?php foreach ($jabatan as $l): ?>
                            <option value="<?php echo $l->list; ?>"><?php echo $l->list; ?></option>
                          <?php endforeach ?>
                          </select>
                        </div>
                     </div>
                     <hr>
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

<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>