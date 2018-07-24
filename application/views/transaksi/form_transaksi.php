                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            POS (Point of Sale) <small>Transaksi</small>
                        </h2>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">


                  <div class="col-md-5">
                      <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="row">

                                    <label class="col-md-3 control-label"><u>C</u>ari Barang</label>
                                    <div class="col-md-9">
                                      <input  id="caribarang" name="barang" placeholder="masukan nama barang" class="form-control">
                                    </div>

                            </div>
                            <hr />
                              <div class="table-responsive">
                                  <table class="table table-striped table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Nama Barang</th>
                                              <th>Harga</th>
                                              <th>Qty</th>
                                              <th>add</th>
                                          </tr>
                                      </thead>
                                      <tbody id="barangadd">

                                            <tr class="gradeU">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                      </tbody>
                                  </table>
                              </div>
                              <!-- /. TABLE  -->
                          </div>
                      </div>
                  </div>


                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>

                                      <tbody id="orderdetail">
                                            <tr class="gradeA">
                                                <td colspan="3">T O T A L</td>
                                                <td>Rp. <span id="totalbarang">0</span></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <?php echo form_open('transaksi', array('class'=>'form-horizontal' , 'id' => 'inputtransaksi')); ?>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><u>U</u>ang Di terima</label>
                                    <div class="col-sm-5">
                                      <input id="uangditerima" type="number" name="bayar" accesskey="u" placeholder="Uang Diterima" value="0" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kembalian</label>
                                    <div class="col-sm-10" id="kembalian">

                                    </div>
                                </div>
                                <input type="hidden" name="total" id="inputtoalbayar" value="0" />
                                <input type="hidden" name="baranjumlah" id="baranjumlah" value="0" />
                                <div id="boxbaranghidden">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" name="submit" accesskey="d"  class="btn btn-primary btn-sm"><u>S</u>impan</button>
                                    </div>
                                </div>
                                </form>

                        </div>
                        <!-- /. PANEL  -->
                    </div>



                </div>
                <!-- /. ROW  -->
