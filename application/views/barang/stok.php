<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            POS (Point of Sale) <small>Tambah Stok</small>
        </h2>
    </div>
</div>
<!-- /. ROW  -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo form_open('barang/stok'); ?>
                <input type="hidden" name="id" value="<?php echo $record['barang_id']?>">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <p class="form-control-static"><?php echo $record['nama_barang']?></p>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <p class="form-control-static"> <?php echo $stok['jumlah'] ?></p>
                    </div>
                  </div>
                </div>
                <div class="form-group">

                    <label for="focusedInput">Stok</label>
                    <input class="form-control" id="focusedInput" type="text" name="stok" value="">

                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tambah Stok</button> |
                <?php echo anchor('barang','Kembali',array('class'=>'btn btn-danger btn-sm'))?>
                </form>
            </div>
        </div>
        <!-- /. PANEL  -->
    </div>
</div>
<!-- /. ROW  -->
