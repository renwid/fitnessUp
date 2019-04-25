<?php

function is_logged_in()
{
  //Check if they are logged in,
  //Check their privilege (admin or user)
  //Calling codeigniter
  $ci = get_instance();

  //If not login
  if(!$ci->session->userdata('email'))
  {
    redirect('auth');
  }

  //If logged in
  else
  {
    $role_id = $ci->session->userdata('role_id');
    //Get URL by segment
    $menu = $ci->uri->segment(1);

    //We need the menu id to determine if role can access page (can user access menu 1?)
    $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

    $menu_id = $queryMenu['id'];

    //query user access
    $userAccess = $ci->db->get_where('user_access_menu', [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ]);

    if($userAccess->num_rows() < 1){
      redirect('auth/blocked');
    }
  }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
