<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            POS (Point of Sale) <small>Laporan Pendapatan Per Kategori</small>
        </h2>
    </div>
</div>
<!-- /. ROW  -->

<div class="row">


    <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
               <?php echo anchor('transaksi/perpordakkategori/excel','Download Excel',array('class'=>'btn btn-danger btn-sm')) ?>
          </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kategori</th>
                                <th>Qty</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; $total=0; foreach ($data->result() as $r){ ?>
                            <tr class="gradeU">
                                <td><?php echo $no ?></td>
                                <td><?php echo $r->nama_kategori ?></td>
                                <td><?php echo $r->qty ?></td>
                                <td>Rp. <?php echo number_format($r->jumlah, 0) ?></td>
                            </tr>
                        <?php $no++; $total=$total+$r->jumlah; } ?>
                            <tr>
                                <td colspan="3">Total</td>
                                <td>Rp. <?php echo $total;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /. TABLE  -->
            </div>
        </div>
    </div>
</div>
<!-- /. ROW  -->
