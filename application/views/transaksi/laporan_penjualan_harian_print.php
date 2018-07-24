<html>
<head>
  <style>
  @page{
    margin:0;
  }
  </style>
</head>
</body>
<table border="0" align="center">
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

<table border="1">
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
</body>
</html>
