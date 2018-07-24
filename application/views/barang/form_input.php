                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            POS (Point of Sale) <small>Tambah Data Barang</small>
                        </h2>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">
                  <?php echo form_open('barang/post' , array('enctype' => 'multipart/form-data')); ?>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control" name="nama_barang" placeholder="nama barang">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control">
                                        <?php foreach ($kategori as $k) {
                                            echo "<option value='$k->kategori_id'>$k->nama_kategori</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input class="form-control" name="harga" placeholder="harga">
                                </div>
                                <div class="form-group">
                                    <label>HPP</label>
                                    <input class="form-control" name="hpp" placeholder="HPP">
                                </div>
                                <div class="form-group">
                                    <label>stok</label>
                                    <input class="form-control" name="stok" placeholder="Stok">
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
                                    <option value="1">Dapur</option>
                                    <option value="2">Bar</option>
                                    <option value="3">None</option>
                                  </select>
                              </div>
                                <div class="form-group">
                                    <label>Descrtion Barang</label>
                                    <textarea class="form-control" rows="10" cols="50" name="des_barang"></textarea>
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
