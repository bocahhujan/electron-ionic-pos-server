                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header">
                            POS (Point of Sale) <small>Edit Data Operator</small>
                        </h2>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php echo form_open('operator/edit'); ?>
                                <input type="hidden" value="<?php echo $record['operator_id']?>" name="id">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $record['nama_lengkap']?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $record['username']?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="password" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label>Akses</label>
                                    <select class="form-control" name='akses'>
                                      <option <?php if($record['akses'] == 'admin') echo 'selected'?> value="admin">Administrator</option>
                                      <option <?php if($record['akses'] == 'user') echo 'selected'?> value="user">Operator</option>
                                    </select>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Update</button> |
                                <?php echo anchor('operator','Kembali',array('class'=>'btn btn-danger btn-sm'))?>
                                </form>
                            </div>
                        </div>
                        <!-- /. PANEL  -->
                    </div>
                </div>
                <!-- /. ROW  -->
