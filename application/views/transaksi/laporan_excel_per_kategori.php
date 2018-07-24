
<table border="1">
    <tr><th>No</th><th>Nama Kategori</th><th>Qty</th><th>Jumlah</th></tr>
    <?php
    $no=1;
    $total=0;
    foreach ($data->result() as $r)
    {
        echo "<tr>
            <td width='10'>$no</td>
            <td width='160'>$r->nama_kategori</td>
            <td>$r->qty</td>
            <td>$r->jumlah</td>
            </tr>";
        $no++;
        $total=$total+$r->jumlah;
    }
    ?>
    <tr><td colspan="3">Total</td><td><?php echo $total;?></td></tr>
</table>
