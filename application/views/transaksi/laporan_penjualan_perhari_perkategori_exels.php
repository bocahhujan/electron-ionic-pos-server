<table border="0" align="center">
  <tr>
    <td colspan="3"><h4>Laporan Penjualan </h4></td>
  </tr>
  <tr>
    <td colspan="3"><h4>Per Hari Per Kategori</h4></td>
  </tr>
  <tr>
    <td colspan="3"><?php echo $start ?></td>
  </tr>
  <tr>
    <td colspan="3">S/D</td>
  </tr>
  <tr>
    <td colspan="3"><?php echo $end ?></td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
</table>

<table border="1">
    <tr><th>No</th><th>Kategori</th><th>Penjualan</th></tr>
    <?php
    $no=1;
    $total=0;
    foreach ($data as $r)
    {
        echo "<tr>
            <td width='10'>$no</td>
            <td width='160'>",$r['kategori']."</td>
            <td>",$r['total']."</td>
            </tr>";
        $no++;
        $total= $total+$r['total'];
    }
    ?>
    <tr><td colspan="2">Total</td><td><?php echo $total;?></td></tr>
</table>
