                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            POS (Point of Sale) <small>Edit Data Barang</small>
                        </h2>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">
                  <?php echo form_open('barang/edit' , array('enctype' => 'multipart/form-data')); ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <input type="hidden" name="id" value="<?php echo $record['barang_id']?>">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" name="nama_barang" value="<?php echo $record['nama_barang']?>">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control">
                                        <?php foreach ($kategori as $k) {
                                            echo "<option value='$k->kategori_id'";
                                            echo $record['kategori_id']==$k->kategori_id?'selected':'';
                                            echo">$k->nama_kategori</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input class="form-control" name="harga" value="<?php echo $record['harga']?>">
                                </div>
                                <div class="form-group">
                                    <label>HPP</label>
                                    <input class="form-control" name="hpp" value="<?php echo $record['hpp']?>">
                                </div>

                            </div>
                        </div>
                        <!-- /. PANEL  -->
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                  <label>Print</label>
                                  <select class="form-control" name='jenis'>
                                    <option <?php if($record['jenis'] == 1 ) echo 'selected' ?> value="1">Dapur</option>
                                    <option <?php if($record['jenis'] == 2 ) echo 'selected' ?>  value="2">Bar</option>
                                    <option <?php if($record['jenis'] == 3 ) echo 'selected' ?> value="3">None</option>
                                  </select>
                              </div>
                                <div class="form-group">
                                    <label>Descrtion Barang</label>
                                    <textarea class="form-control" rows="10" cols="50" name="des_barang"><?php echo $record['des']?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Image Barang</label>
                                    <input class="form-control" name="img_barang" type="file">
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button> |
                                <?php echo anchor('barang','Kembali',array('class'=>'btn btn-danger btn-sm'))?>

                            </div>
                        </div>
                        <!-- /. PANEL  -->
                    </div>

                  </form>
                </div>
                <!-- /. ROW  -->
