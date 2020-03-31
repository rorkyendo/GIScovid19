<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

  function __costruct()
   {
       parent::__costruct();
       if($this->session->userdata('LoggedIN') == FALSE )
       {
           redirect('Auth/logout');
       }
   }
   private $title = 'Kategori Peta';

   public function index()
   {
       $data['title'] = $this->title;
       $data['subtitle'] = 'Data';
       $data['content'] = 'backend/kategori_peta/index';
       $data['kategori_peta'] = $this->GeneralModel->get_general('kategori_peta');
       $this->load->view('backend/content',$data);
   }

   public function create($param1='',$param2='')
   {
     if ($param1=='do_create') {
       $data = array(
           'kp_name' => $this->input->post('kp_name'),
       );

       $config['upload_path']          = 'assets/symbol_kategiri_peta/';
       $config['allowed_types']        = 'jpg|png|jpeg';
       $config['file_name']						= $data['kp_name'];

       $this->load->library('upload', $config);

       if ( ! $this->upload->do_upload('dokumen'))
       {

       }
       else {
         $data += array(
           'kp_icon' => $config['upload_path'].$this->upload->data('file_name'),
         );
       }
       $this->GeneralModel->create_general('kategori_peta',$data);
       $this->session->set_flashdata('notif','<div class="alert alert-success">Data kategori peta berhasil disimpan</div>');
       redirect('backend/kategori');
     }else {
       $data['title'] = $this->title;
       $data['subtitle'] = 'Tambah';
       $data['content'] = 'backend/kategori_peta/create';
       $this->load->view('backend/content',$data);
     }
   }

   public function update($param1='',$param2='')
   {
     if ($param1=='do_update') {

       $data = array(
           'kp_name' => $this->input->post('kp_name'),
       );

       $config['upload_path']          = 'assets/marker/';
       $config['allowed_types']        = 'jpg|png|jpeg';
       $config['file_name']						= $data['kp_name'];

       $this->load->library('upload', $config);

       if ( ! $this->upload->do_upload('dokumen'))
       {

       }
       else {
         $data += array(
           'kp_icon' => $config['upload_path'].$this->upload->data('file_name'),
         );
       }

       $this->GeneralModel->update_general('kategori_peta','kp_id',$param2,$data);
       $this->session->set_flashdata('notif','<div class="alert alert-success">Data kategori peta berhasil diupdate</div>');
       redirect('backend/kategori');
     }else {
       $data['title'] = $this->title;
       $data['subtitle'] = 'Update';
       $data['content'] = 'backend/kategori_peta/update';
       $data['kategori_peta'] = $this->GeneralModel->get_by_id_general('kategori_peta','kp_id',$param1);
       $this->load->view('backend/content',$data);
     }
   }

   public function delete($id)
   {
      $this->GeneralModel->delete_general('kategori_peta','kp_id',$id);
      $this->session->set_flashdata('notif','<div class="alert alert-success">Data kategori peta berhasil dihapus</div>');
      redirect('backend/kategori');
   }

}
?>
