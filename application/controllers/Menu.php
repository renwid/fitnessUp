<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Not login yet, forces user to go to the login page, user cannot access /admin
    $this->load->model('Menu_model');
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


  //Menu Functions
  public function edit($id)
  {
    $data['title'] = 'Edit Menu Name';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->Menu_model->getMenuById($id);

    $this->form_validation->set_rules('menu', 'Menu', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/edit', $data);
      $this->load->view('templates/footer');
    }

    else{
      $this->Menu_model->editMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu name has been updated</div>');
      redirect('menu');

    }
  }

  public function delete($id) //taken from url
  {
    $data['title'] = 'Submenu Management';


    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');


    $this->menu->deleteMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu Deleted</div>');
    redirect('menu');
  }


  //Sub Menu Functions
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

  public function deletesm($id)
  {
    $data['title'] = 'Submenu Management';

    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');

    $this->menu->deleteSubMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu Deleted</div>');
    redirect('menu/submenu');
  }


  public function editsm($id) //Got this from url
  {
    $data['title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' =>
    $this->session->userdata('email')])->row_array();


    $data['subMenu'] = $this->Menu_model->getSubMenuById($id); //id retrieved from method parameter
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('icon', 'icon', 'required');

    if($this->form_validation->run() == false){
      //Must be in order
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/editsm', $data);
      $this->load->view('templates/footer');
    }

    else{
      $this->Menu_model->editSubMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu has been updated</div>');
      redirect('menu/submenu');
    }
  }


}
