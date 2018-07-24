<table border="0" align="center">
  <tr>
    <td colspan="5"><h4>Laporan Penjualan Menu</h4></td>
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
      <th>Kategori</th>
      <th>Menu</th>
      <th>Qty</th>
      <th>Harga</th>
      <th>Total</th>
    </tr>
    <?php
    $total=0;
    foreach ($data as $r)
    {
        if($r['nama'] == "")
          echo '<tr bgcolor="#FFFF00">';
        else
          echo "<tr>";

        if($r['nama'] == "")
          echo "<td >".$r['nama_kategori']."</td>";
        else
          echo "<td ></td>";

        echo "<td >",$r['nama']."</td>";
        echo "<td >",$r['qty']."</td>";
        if($r['nama'] != "")
          echo "<td>",$r['harga']."</td>";
        else
          echo "<td ></td>";
        echo "<td>",$r['total']."</td>";
        echo "</tr>";
        if($r['nama'] == "")
          $total= $total+$r['total'];
    }
    ?>
    <tr><td colspan="4">Total</td><td><?php echo $total;?></td></tr>
</table>
