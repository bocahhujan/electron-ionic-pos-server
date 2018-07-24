<table border="0" align="center">
  <tr>
    <td colspan="3"><h4>Fast Moving Menu</h4></td>
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
    <tr><th>No</th><th>Menu</th><th>Jumlah</th></tr>
    <?php
    $no=1;
    $total=0;
    foreach ($data as $r)
    {
        echo "<tr>
            <td width='2'>$no</td>
            <td width='160'>",$r['nama']."</td>
            <td>",number_format($r['jumlah'])."</td>
            </tr>";
        $no++;
        $total= $total+$r['jumlah'];
    }
    ?>
    <tr><td colspan="2">Total</td><td><?php echo number_format($total);?></td></tr>
</table>
