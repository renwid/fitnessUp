<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Not login yet, forces user to go to the login page, user cannot access /admin
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    }

    //If successfull, add the new menu
    //Insert to table user_menu, data: menu->user input menu
    else{
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
      redirect('menu');
    }
  }


  public function deleteMenu()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    }

    //If successfull, add the new menu
    //Insert to table user_menu, data: menu->user input menu
    else{
      $this->db->delete('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Successful</div>');
      redirect('menu');
    }
  }

  public function deleteSubMenu()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['title'] = $this->db->get('user_sub_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    }

    //If successfull, add the new menu
    //Insert to table user_menu, data: menu->user input menu
    else{
      $this->db->delete('user_sub_menu', ['title' => $this->input->post('title')]);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Successful</div>');
      redirect('menu/submenu');
    }
  }


  public function editMenu()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();

    $data['menu'] = $this->db->get('user_menu')->result_array();
    $data['id'] = $this->db->get('user_menu')->result_array();


    $this->form_validation->set_rules('menu', 'Menu', 'required');
    $this->form_validation->set_rules('id', 'Id', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    }

    else
    {
      $menu = $this->input->post('menu');
      $id = $this->input->post('id');

      //UPDATE `user_menu` SET `menu` = 'd' WHERE `user_menu`.`id` = 6

      // $this->db->set('menu', $menu);
      // $this->db->where('user_menu'. '.' .'id', $id);
      // $this->db->update('user_menu');

      $data = array('menu' => $menu);

      $where = "id = 6";

      $str = $this->db->update_string('user_menu', $data, $where);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">updated</div>');
      redirect('menu');
    }
  }


  public function subMenu()
  {
    $data['title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');

    $data['subMenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('icon', 'icon', 'required');

    if($this->form_validation->run() == false)
    {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('templates/footer');
    }else{
      $data = [
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active'),

      ];
      $this->db->insert('user_sub_menu', $data );
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
      redirect('menu/submenu');
    }

  }


}
