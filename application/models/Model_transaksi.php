<?php
class Model_transaksi extends ci_model
{

    function simpan_barang_api(){
      $post = json_decode($this->input->raw_input_stream,TRUE);
      $total = 0;
      foreach ($post['dt'] as $pd) {
        $total += $pd['harga'] * $pd['qty'];
      }

      $tanggal = date('Y-m-d H:i:s');
      $data=array('operator_id'=> $post['user_id'],
                  'tanggal_transaksi'=> $tanggal ,
                  'tgl_update' => $tanggal ,
                  'total' => $total ,
                  'uang_diterima' => 0 ,
                  'ruang' => $post['ruang'] ,
                  'status' => $post['status'] ,
                  'ppn' => $post['ppn'] ,
                  'discount' => $post['discount'] ,
                  'uang_diterima' => $post['bayar'] ,
              );

      $this->db->insert('transaksi',$data);
      $idtransaksi =  $this->db->insert_id();
      $idnum = 0 ;

      foreach ($post['dt'] as $pd) {
        $barang[] = array('barang_id' => $pd['barang_id'],
                      'qty' => $pd['qty'],
                      'harga' => $pd['harga'],
                      'transaksi_id' => $idtransaksi,
                      'status' => '1');

        $dain = array(
                            'barang_id' => $pd['barang_id'] ,
                            'transaksi_id' => $idtransaksi ,
                            'nilai_rekam_stok' => $pd['qty'] ,
                            'id_operator' => 7
                      );

      $this->db->insert('rekam_stok',$dain);

      }

      $this->db->insert_batch('transaksi_detail',$barang);
      return $idtransaksi;
    }

    function simpan_barang()
    {
        $idbarang    =  $this->input->post('barangadd');
        $qty         =  $this->input->post('qtybarang');
        $harga         =  $this->input->post('hargabarangadd');
        $total         =  $this->input->post('total');
        $bayar         =  $this->input->post('bayar');

        $tanggal=date('Y-m-d');
        $user=  $this->session->userdata('username');
        $id_op=  $this->db->get_where('operator',array('username'=>$user))->row_array();
        $data=array('operator_id'=> $id_op['operator_id'],
                    'tanggal_transaksi'=> $tanggal ,
                    'total' => $total ,
                    'uang_diterima' => $bayar
                );


        $this->db->insert('transaksi',$data);
        $idtransaksi =  $this->db->insert_id();
        $idnum = 0 ;
        $data = array();
        foreach( $idbarang as $br ){

          $data[] = array('barang_id' => $br,
                        'qty' => $qty[$idnum],
                        'harga' => $harga[$idnum],
                        'transaksi_id' => $idtransaksi,
                        'status' => '1');

          //$this->db->insert('transaksi_detail',$data);

          $dain = array(
                'barang_id' => $br ,
                'transaksi_id' => $idtransaksi ,
                'nilai_rekam_stok' => $qty[$idnum] ,
                'id_operator' => $id_op['operator_id']
          );

          $this->db->insert('rekam_stok',$dain);

          $idnum++;

        }
        //var_dump($data);
        $this->db->insert_batch('transaksi_detail',$data);



    }

    function tampilkan_detail_transaksi()
    {
        $query  ="SELECT td.t_detail_id,td.qty,td.harga,b.nama_barang
                FROM transaksi_detail as td,barang as b
                WHERE b.barang_id=td.barang_id and td.status='1'";
        return $this->db->query($query);
    }

    function laporan_transaksi_per_kategori(){
        $sql ="SELECT sum(qty) as qty , sum(jumlah) as jumlah ,nama_kategori
               FROM (
                    SELECT qty , qty * harga as jumlah , nama_kategori
                    FROM (
                         SELECT b.barang_id , sum(td.qty) as qty , td.harga , kt.nama_kategori
                         FROM transaksi_detail td
                            left join barang b on td.barang_id = b.barang_id
                            left join kategori_barang kt on b.kategori_id = kt.kategori_id
                         group by b.barang_id
                    ) as box  group by barang_id
                  ) as box1
               group by nama_kategori";
        return $this->db->query($sql);

    }

    function laporan_default()
    {
        $query="SELECT t.tanggal_transaksi,o.nama_lengkap,sum(td.harga*td.qty) as total
                FROM transaksi as t,transaksi_detail as td,operator as o
                WHERE td.transaksi_id=t.transaksi_id and o.operator_id=t.operator_id
                group by t.transaksi_id";
        return $this->db->query($query);
    }

    function laporan_periode($tanggal1,$tanggal2)
    {
        $query="SELECT t.tanggal_transaksi,o.nama_lengkap,sum(td.harga*td.qty) as total
                FROM transaksi as t,transaksi_detail as td,operator as o
                WHERE td.transaksi_id=t.transaksi_id and o.operator_id=t.operator_id
                and t.tanggal_transaksi between '$tanggal1' and '$tanggal2'
                group by t.transaksi_id";
        return $this->db->query($query);
    }

    function get_order($status = 0){
      $query  ="SELECT *
              FROM transaksi
              WHERE status = $status ";
      return $this->db->query($query);
    }

    function list_barang_order($id){
      $this->db->select('* , td.harga as harga');
      $this->db->from('transaksi_detail as td');
      $this->db->join('barang as b' , 'td.barang_id = b.barang_id');
      $this->db->where('transaksi_id' , $id);
      return $this->db->get();
    }

    function deteil_order($id){
      $this->db->where('transaksi_id' , $id);
      return $this->db->get('transaksi');
    }

    function update_status_order($id){
        $arr = array(
            'status' => 1
      );

      $this->db->where('transaksi_id' , $id );
      if($this->db->update('transaksi' , $arr))
        return true;
      else
        return false;
    }

    function meja_belombayar(){
      $this->db->select('ruang , transaksi_id');
      $this->db->where('tanggal_transaksi >=' , date('Y-m-d' , strtotime('-1 day')));
      $this->db->where('status' , 0 );
      return $this->db->get('transaksi')->result_array();
    }

    function update($id , $arr){
      $this->db->where('transaksi_id' , $id );
      if($this->db->update('transaksi' , $arr))
        return true;
      else
        return false;
    }

    function laporan_penjualan_perhari_perkateogir($start ,  $end ){
      $start = date_create($start);
      $start = date_format($start,"Y-m-d H:i:s");
      $end = date_create($end);
      $end = date_format($end,"Y-m-d H:i:s");

      $sql = "select kb.nama_kategori as kategori ,
              		 sum(b.harga) as subtotal ,
              		 if(b.ppn = 1 , b.harga * 0.1 ,0 ) as ppn ,
              		 if(b.ppn = 1 , b.harga * 0.1 ,0 ) + sum(b.harga) as total
              from transaksi t
              left join transaksi_detail td on t.transaksi_id = td.transaksi_id
              left join barang b on td.barang_id = b.barang_id
              left join kategori_barang kb on b.kategori_id = kb.kategori_id
              where t.tanggal_transaksi >= '".$start."' and t.tanggal_transaksi <= '".$end."'
              group by kb.kategori_id ;";

      return $this->db->query($sql)->result_array();
    }

    function laporan_penjualan_perhari($start ,  $end , $user = ''){
      $start = date_create($start);
      $start = date_format($start,"Y-m-d H:i:s");
      $end = date_create($end);
      $end = date_format($end,"Y-m-d H:i:s");
      if($user == ""){
        $sql = "select ruang as meja , tanggal_transaksi as tgl , (total + ppn) as total from transaksi t
                where tanggal_transaksi between '".$start."' and  '".$end."' ";
      }else{
        $sql = "select ruang as meja , tanggal_transaksi as tgl , (total + ppn) as total from transaksi t
                where operator_id = '$user' and tanggal_transaksi >= '".$start."' and tanggal_transaksi <=  '".$end."' ";
      }
      //var_dump($start);
      //var_dump($end);
      //echo $sql ;
      return $this->db->query($sql)->result_array();
    }

    function laporan_penjualan_perprodak_perhari($start ,  $end){

      $start = date_create($start);
      $start = date_format($start,"Y-m-d H:i:s");
      $end = date_create($end);
      $end = date_format($end,"Y-m-d H:i:s");

      $sql = "select b.nama_barang as nama , sum(td.qty) as jumlah from transaksi t
              left join transaksi_detail td on t.transaksi_id = td.transaksi_id
              left join barang b on td.barang_id = b.barang_id
              where t.tanggal_transaksi >= '".$start."' and t.tanggal_transaksi <= '".$end."'
              group by b.barang_id;";
      //echo $sql ;
      return $this->db->query($sql)->result_array();
    }

    function laporan_penjualan_detail_perhari($start ,  $end){
      $start = date_create($start);
      $start = date_format($start,"Y-m-d H:i:s");
      $end = date_create($end);
      $end = date_format($end,"Y-m-d H:i:s");

      $out = array();
      $sql = "select kategori_id , nama_kategori, '' as nama , '' as qty , '' as harga  , sum(subtotal) as total  from (
                	select kb.kategori_id , kb.nama_kategori ,b.harga * sum(td.qty) as subtotal  from transaksi t
                	left join transaksi_detail td on t.transaksi_id = td.transaksi_id
                	left join barang b on td.barang_id = b.barang_id
                	left join kategori_barang kb on b.kategori_id = kb.kategori_id
                  where t.tanggal_transaksi >= '".$start ."' and t.tanggal_transaksi <= '".$end."'
                	group by  b.barang_id ) br group by kategori_id";
      $dt_ = $this->db->query($sql)->result_array();

      foreach ($dt_ as $key) {
        $out[] = $key ;
        $sql = "select kb.kategori_id , kb.nama_kategori , b.nama_barang as nama , sum(td.qty) as qty , b.harga as harga , b.harga * sum(td.qty) as total  from transaksi t
                left join transaksi_detail td on t.transaksi_id = td.transaksi_id
                left join barang b on td.barang_id = b.barang_id
                left join kategori_barang kb on b.kategori_id = kb.kategori_id
                where t.tanggal_transaksi >= '".$start."' and t.tanggal_transaksi <= '".$end."'
                      and kb.kategori_id = '".$key['kategori_id']."'
                group by  b.barang_id";

        $dt_2  = $this->db->query($sql)->result_array();
        foreach ($dt_2 as $k) {
          $out[] = $k ;
        }
      }

      return $out;

    }

    function update_transaksi_api(){
      $post = json_decode($this->input->raw_input_stream,TRUE);
      $total = 0;
      $idtransaksi =  $post['order_id'];
      $idnum = 0 ;
      $order_d = $this->deteil_order($idtransaksi)->row_array();
      $barang_list = $this->list_barang_order($idtransaksi)->result_array();
      $barang = array();

      foreach ($post['dt'] as $pd) {
        $arr_barang = '';
        $arr_barang  = array_search($pd['barang_id'], array_column($barang_list, 'barang_id'));

        if($arr_barang === ""){
          $barang[] = array('barang_id' => $pd['barang_id'],
                        'qty' => $pd['qty'],
                        'harga' => $pd['harga'],
                        'transaksi_id' => $idtransaksi,
                        'status' => '1');

        }else{
          $barang_up = $barang_list[$arr_barang];
          $barang_up_in = array(
                    'qty' => $pd['qty'] + $barang_up['qty']
          );
          $t_detail_id = $barang_list[$arr_barang]['t_detail_id'];
          //var_dump($barang_up_in);
          $this->db->update( 'transaksi_detail'  , $barang_up_in , "t_detail_id = $t_detail_id");
        }

        $dain = array('barang_id' => $pd['barang_id'] ,
                      'transaksi_id' => $idtransaksi ,
                      'nilai_rekam_stok' => $pd['qty'] ,
                      'id_operator' => 7);

        $total += $pd['harga'] * $pd['qty'] ;


        $this->db->insert('rekam_stok',$dain);
      }

      $order_up = array(
              'total' => $order_d['total'] + $total ,
              'ppn' => ($order_d['total'] + $total) * 0.1
      );

      $this->update( $idtransaksi , $order_up);
      if(count($barang) >= 1 )
        $this->db->insert_batch('transaksi_detail',$barang);
      return true;
    }

    function get_transsaksi_list(){

      $this->db->where('tanggal_transaksi >=' , date('Y-m-d' , strtotime('-1 day')));
      return $this->db->get('transaksi')->result_array();

    }

    function add_in_out($dt){
      $dain = array(
                          'operator_id' => $dt['id'] ,
                          'in_out_type' => $dt['type'] ,
                          'in_out_nilai' => $dt['nilai'] ,
                          'in_out_tgl' => date('Y-m-d H:i:s') ,
                          'in_out_ket' => $dt['ket']
                    );

    $this->db->insert('in_out',$dain);
    }

    function get_in_out($start , $end , $type = 1 , $user = ''){
      $start = date_create($start);
      $start = date_format($start,"Y-m-d H:i:s");
      $end = date_create($end);
      $end = date_format($end,"Y-m-d H:i:s");

      //$this->db->where('in_out_type' , $type);
      $this->db->where('in_out_tgl >=' , $start);
      $this->db->where('in_out_tgl <=' , $end);

      if($user != '')
        $this->db->where('operator_id' , $user);

      return $this->db->get('in_out')->result_array();
    }

    function refund_barang( $barang_id , $order_id , $qty = 1){
      $this->load->model('model_barang');
      $barang = $this->model_barang->get_one($barang_id)->row_array();
      $order = $this->deteil_order($order_id)->row_array();
      $harga = $barang['harga'] ;
      $order_total = $order['total'] - $harga;
      $ppn = $order_total * 0.1;

      $dt_up = array( 'total' => $order_total , 'ppn' => $ppn );


      $ba = array('barang_id' => $barang_id,
                    'qty' => $qty ,
                    'harga' => 0 - $harga ,
                    'transaksi_id' => $order_id,
                    'status' => '1');

      $this->db->insert('transaksi_detail' , $ba);

      $this->update($order_id , $dt_up );
    }

    function refund_transaksi($order_id){
      $order_d = $this->deteil_order($order_id)->row_array();
      $tanggal = date('Y-m-d H:i:s');
      $data = array('operator_id'=> $order_d['operator_id'],
                  'tanggal_transaksi'=> $tanggal ,
                  'tgl_update' => $tanggal ,
                  'total' => 0 - $order_d['total'] ,
                  'ruang' => $order_d['ruang'] ,
                  'status' => 1 ,
                  'ppn' => 0 - $order_d['ppn'] ,
                  'discount' => $order_d['discount'] ,
                  'uang_diterima' => 0 ,
                  'refund_id' => $order_id
              );

      $this->db->insert('transaksi' , $data);
      $aar_in = array( 'status' => 1  );
      $this->update($order_id , $aar_in);
    }
}
