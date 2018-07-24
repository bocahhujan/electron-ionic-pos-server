<html>
<head>
  <meta charset="utf-8">
  <title>Rolag Post Nota</title>
  <style>

  @page{
    margin:2;
  }


  .invoice-box {
        max-width: 270px;
        font-size: 10px;
        font-family: Arial, sans-serif;
        color: #000;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: center;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #000;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(3) {
        font-weight: bold;
    }
  </style>
</head>
</body>
<div class="invoice-box">
    <table align="center">
      <tr>
        <td colspan="5"><h4>Laporan Penjualan Per Hari</h4></td>
      </tr>
      <tr>
        <td colspan="5"><?php echo $start ?></td>
      </tr>
      <tr>
        <td colspan="5">S/D</td>
      </tr>
      <tr>
        <td colspan="5"><?php echo $end ?></td>
      </tr>
      <tr>
        <td colspan="5"></td>
      </tr>
    </table>

    <table>
        <tr>
          <th>No</th>
          <th>Transaksi</th>
          <th>Jam</th>
          <th>Keterangan</th>
          <th>Nilai</th>
        </tr>
        <?php
        $no=1;
        $total = 0;
        foreach ($in_out as $r)
        {
            echo "<tr>
                <td width='5'>$no</td>
                <td>Uang Masuk</td>
                <td>",date( 'H:i' , strtotime($r['in_out_tgl']))."</td>
                <td>Deposite </td>
                <td>",$r['in_out_nilai']."</td>
                </tr>";
            $no++;
            $total += $r['in_out_nilai'];
        }

        foreach ($data as $r)
        {
            echo "<tr>
                <td width='5'>$no</td>
                <td>Penjualan</td>
                <td>",date( 'H:i' , strtotime($r['tgl']))."</td>
                <td> Penjualan ",$r['meja']."</td>
                <td>",$r['total']."</td>
                </tr>";
            $no++;
            $total += $r['total'];
        }
        ?>
        <tr><td colspan="4">Total</td><td><?php echo $total;?></td></tr>
    </table>
    <script>
    window.print();
    </script>
</div>
</body>
</html>
