<?php
class Model_barang extends ci_model{


    function tampil_data()
    {
        $query= "SELECT b.barang_id,b.nama_barang,b.harga,kb.nama_kategori , b.des , b.img , b.jenis
                FROM barang as b,kategori_barang as kb
                WHERE b.kategori_id=kb.kategori_id";
        return $this->db->query($query);
    }

    function cari_barang(){
        $br = $this->input->post('barang');
        $this->db->like('nama_barang' , $br);
        $query = $this->db->get('barang');
        return $query->result_array();
    }

    function detail_barang($id){
      $this->db->like('barang_id' , $id);
      $query = $this->db->get('barang');
      return $query->result_array();
    }


    function post($data)
    {
        $this->db->insert('barang',$data);
        return $this->db->insert_id();
    }

    function get_one($id)
    {
        $param  =   array('barang_id'=>$id);
        return $this->db->get_where('barang',$param);
    }

    function edit($data,$id)
    {
        $this->db->where('barang_id',$id);
        $this->db->update('barang',$data);
    }


    function delete($id)
    {
        $this->db->where('barang_id',$id);
        $this->db->delete('barang');
    }

    function add_stok($id ,  $jumlah){
      $user=  $this->session->userdata('username');
      $id_op=  $this->db->get_where('operator',array('username'=>$user))->row_array();
      $id_op = $id_op['operator_id'];
      $data = array(
            'barang_id' => $id ,
            'nilai_rekam_stok' => $jumlah ,
            'id_operator' => $id_op ,
            'tipe_rekam_stok' => 1
      );

      $this->db->insert('rekam_stok',$data);
    }

    function get_stok_barang($id){
      if(is_numeric($id)){
        $sql = "  SELECT (stok_masuk.total - IFNULL(stok_keluar.total, 0) ) AS jumlah
                  FROM (
                      SELECT SUM(nilai_rekam_stok) AS total , barang_id from rekam_stok WHERE tipe_rekam_stok = 1 AND barang_id = '$id'
                  ) AS stok_masuk left join (
                      SELECT SUM(nilai_rekam_stok) AS total, barang_id from rekam_stok WHERE tipe_rekam_stok = 0 AND barang_id = '$id'
                  ) stok_keluar ON stok_masuk.barang_id = stok_keluar.barang_id ;";
        return $this->db->query($sql);
      }else{
        return FALSE;
      }
    }

    function get_list_stok_barang(){
      $sql = "  select * from (
                select( stok_masuk.total - IFNULL(stok_keluar.total, 0) ) as jumlah , stok_masuk.barang_id as barang_id
                from (
                select sum(nilai_rekam_stok) as total , barang_id from rekam_stok where tipe_rekam_stok = 1 group by barang_id
                ) as stok_masuk left join (
                select sum(nilai_rekam_stok) as total, barang_id from rekam_stok where tipe_rekam_stok = 0 group by barang_id
                ) stok_keluar on stok_masuk.barang_id = stok_keluar.barang_id
                ) as stok_barang left join barang on stok_barang.barang_id = barang.barang_id";
      return $this->db->query($sql);
    }

    function get_barang_by_kategori($id){
      $query= "SELECT b.barang_id,b.nama_barang,b.harga,kb.nama_kategori , b.des , b.img , b.jenis
              FROM barang as b , kategori_barang as kb
              WHERE b.kategori_id=kb.kategori_id
              AND
              b.kategori_id = '$id'
              ";

      return $this->db->query($query);
    }

    function cariBarangApi($s){
      $query= "SELECT b.barang_id,b.nama_barang,b.harga,kb.nama_kategori , b.des , b.img , b.jenis
              FROM barang as b , kategori_barang as kb
              WHERE b.kategori_id=kb.kategori_id
              and
              b.nama_barang like '%$s%'
              ";

      return $this->db->query($query);
    }
}
