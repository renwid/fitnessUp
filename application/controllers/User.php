<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Not login yet, forces user to go to the login page, user cannot access /admin
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    //Must be in order
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
  }

  public function progress()
  {
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    if($this->form_validation->run() == false)
    {
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/progress', $data);
      $this->load->view('templates/footer');
    }



  }



  public function edit()
  {
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/footer');
    }
    else
    {
      $name = $this->input->post('name');
      $email = $this->input->post('email');


      //Check if new image is uploaded by user
      $upload_image = $_FILES['image']['name'];

      //Check image specifications
      if($upload_image){
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        //If image is successfully uploaded
        if($this->upload->do_upload('image')){

          //Old image is deleted if new one is uploaded (but default image stays)
          $old_image = $data['user']['image'];
          if($old_image != 'default.jpg'){
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
          }

          $new_image = $this->upload->data('file_name');
          $this->db->set('image', $new_image);
        }
        //If fail to upload
        else {
          echo $this->upload->display_errors();
        }
      }

      //Change user table where email is:
      $this->db->set('name', $name);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated</div>');
      redirect('user');
    }
  }

  public function changePassword()
  {
    $data['title'] = 'Change Password';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

    if ($this->form_validation->run() == false) {
              $this->load->view('templates/header', $data);
              $this->load->view('templates/sidebar', $data);
              $this->load->view('templates/topbar', $data);
              $this->load->view('user/changepassword', $data);
              $this->load->view('templates/footer');
    }
    //If password is successfull
    //first check if password entered is the same with the one in database
    else
    {
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');

      //If password the user inputs is not the same with the one in database
      if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
      }
      //If password is the same with the one in database
      else
      {
        if($current_password == $new_password){
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
          redirect('user/changepassword');
        }
        else
        {
          //Password ok, hash password
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          //Give success message
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
          redirect('user/changepassword');
        }
      }
    }
  }

  public function KCal()
  {

    $data['title'] = 'Food List';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->model('Food_model', 'food');

    // $data['subMenu'] = $this->menu->getSubMenu();
    $data['food'] = $this->db->get('food')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('icon', 'icon', 'required');

    if($this->form_validation->run() == false)
    {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/kcal', $data);
      $this->load->view('templates/footer');
    }else{
      $data = [
        'foodName' => $this->input->post('foodName'),
        'foodCategoryID' => $this->input->post('foodCategoryID'),
        'foodGI' => $this->input->post('foodGI'),
        'foodGL' => $this->input->post('foodGL'),
        'foodProtein' => $this->input->post('foodProtein'),
        'foodCarbs' => $this->input->post('foodCarbs'),
        'foodFat' => $this->input->post('foodFat'),
        'foodCalorie' => $this ->input ->post('foodCalorie'),

      ];
      $this->db->insert('food', $data );
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
      redirect('user/kcal');
    }

  }







}
