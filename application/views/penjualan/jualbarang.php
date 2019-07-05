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
                      Daftar sparepart motor, ceklis <input type="checkbox" checked=""> apabila sparepart terjual
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nama Sparepart</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah Jual</th>
                          <th>Harga Total</th>
                          <th>Stock</th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <?php $no=1?>
                          <?php $n=0?>

                          <?php foreach ($sport as $i): ?>
                          
                            <td><input type="checkbox" name="a<?php echo $i->id_sparepart?>" onchange="
                              document.getElementById('b<?php echo $no?>').disabled = !this.checked;
                              document.getElementById('a<?php echo $no?>').disabled = !this.checked;
                              document.getElementById('total<?php echo $no?>').disabled = !this.checked;
                              document.getElementById('b<?php echo $no?>').value =0;
                              document.getElementById('total<?php echo $no?>').value =0;
                              total();
                              kembali();" 
                              id="c<?php echo $no?>" 
                              value="<?php echo $i->id_sparepart;?>"/><?php echo $i->nama_sparepart;?>
                            </td>

                            <td>Rp.<input type="text" name="b<?php echo $i->id_sparepart?>" id="a<?php echo $no?>"  value="<?php echo $i->nominal ?>" readonly disabled></td>

                            <td><input type="text" name="c<?php echo $i->id_sparepart?>" id="b<?php echo $no?>" autocomplete="off"  value="0" onkeydown="return(f_validchar('0123456789',event))" 
                            onkeyup="
                            document.getElementById('total<?php echo $no?>').value= document.getElementById(('a<?php echo $no?>')).value *  document.getElementById('b<?php echo $no?>').value; total(); kembali();" disabled
                            data-toggle='tooltip' title='Jumlah Barang Terjual'></td>

                            <td>Rp.<input type="number" name="d<?php echo $i->id_sparepart?>" id="total<?php echo $no?>" value="0" readonly disabled></td>

                            <td><?php if($i->stok <= 10 ){
                              echo "<input type='text' name='e". $i->id_sparepart ."' value='". $i->stok." ' id='stok". $no."' readonly class='btn-danger' data-toggle='tooltip' title='Stok Terbatas'>";
                              } else {
                              echo "<input type='text' name='e". $i->id_sparepart ."' value='".$i->stok." ' id='stok". $no."' readonly class='btn-success' data-toggle='tooltip' title='Stok Cukup'>";
                              } ?></td>
                          </tr>
                          <?php $no++?>     
                          <?php endforeach ?>
        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <table>
                    <tr>
                      <td><b>Jumlah Harga</b></td>
                      <td><b>:</b> Rp.<input type="text" id="jumlah" name="jumlah" value="0" readonly=""></td>
                    </tr>
                    <tr>
                      <td><b>Tunai</b></td>
                      <td><b>:</b> Rp.<input type="number" name="tunai" id="tunai" value="0" onkeyup="kembali(); haha();" onkeydown="return(f_validchar('0123456789',event))"></td>
                    </tr>
                    <tr>
                      <td><b>Uang Kembalian</b></td>
                      <td><b>:</b> Rp.<input type="text" name="kembalian" id="kembalian" value="0" readonly></td>
                    </tr>
                  </table>
                </div> 
                 
                <input type="hidden" name="data" id="w"><br>
                <input onclick=klik() type="submit" class="btn btn-primary" value="Save" disabled id="button" data-toggle='tooltip' title='Save Transaksi'></input><a href="<?php echo base_url();?>Penjualan/jual" class="btn btn-danger" data-toggle='tooltip' title='Hapus Transaksi'>Clear</a>
              </div>
            </div>
            </form>
            <input type="hidden" id="max" value="<?php echo $no-1?>">
            </div>
            </div>
            <iframe id="frame"></iframe>

            <script type="text/javascript">
    function klik(){
      $z="";
    for ($f = 1 ; $f < 8; $f++) {
      if (document.getElementById('p'+$f).checked) {
        $z=$z+"|"+document.getElementById('p'+$f).value;
      };

    };
    document.getElementById('w').value=$z;
};
</script>