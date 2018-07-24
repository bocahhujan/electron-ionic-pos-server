<div class="row">
    <div class="col-md-12">
        <h2 class="page-header">
            POS (Point of Sale) <small>Laporan Fast Moving Menu</small>
        </h2>
    </div>
</div>
<!-- /. ROW  -->

<div class="row">


    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <form method="post">
              <div class="panel-body">
                <div class="form-group">
                  <label>Dari</label>
                  <div class="input-group">
                      <input type="text" name='start' class="form-control" value="<?php echo date('Y-m-d h:i')?>" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii">
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <div class="input-group">
                      <input type="text" name='end' class="form-control" value="<?php echo date('Y-m-d h:i')?>" id="datetimepicker2" data-date-format="yyyy-mm-dd hh:ii">
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Ambil Data</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- /. ROW  -->
