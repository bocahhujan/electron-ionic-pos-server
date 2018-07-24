<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            POS (Point of Sale) <small>Detail Order</small>
        </h2>
    </div>
</div>
<!-- /. ROW  -->

<div class="row">

    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
               List Barang
          </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach ($recordbarang->result() as $r) { ?>
                            <tr class="gradeU">
                                <td><?php echo $no ?></td>
                                <td><?php echo $r->nama_barang ?></td>
                                <td><?php echo $r->qty  ?></td>
                            </tr>
                        <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /. PANEL  -->
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
             Detail Order
        </div>
          <div class="panel-body">
            <div class="form-group">
                <label>Tanggal</label>
                <p class="form-control-static"><?php echo $order['tanggal_transaksi']?></p>
            </div>
            <div class="form-group">
                <label>Kamar No</label>
                <p class="form-control-static"><?php echo $order['ruang']?></p>
            </div>
            <div class="form-group">
                <label>Total Pesanan</label>
                <p class="form-control-static">Rp. <?php echo number_format($order['total']) ?></p>
            </div>
            <?php echo anchor('order/proses/'.$order['transaksi_id'],'Proses',array('class'=>'btn btn-primary btn-sm'))?> |
            <?php echo anchor('order','Kembali',array('class'=>'btn btn-danger btn-sm'))?>
          </div>
      </div>
    </div>
</div>
<!-- /. ROW  -->
