<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');

  }

  public function index()
  {
    if($this->session->userdata('email')){
      redirect('user');
    }

    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if($this->form_validation->run() == false){
      $data['title'] = 'Login Page';
      $this->load->view('templates/auth_header1');
      $this->load->view('auth/login1');
      $this->load->view('templates/auth_footer1');
    }

    else{
      //Valid / success -> run Login
      $this->_login();
    }

  }

  private function _login(){
    $email = $this->input->post('email'); //Get data from user input
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array(); //Check Database if email exists

    // jika usernya ada
            if ($user) {
                // jika usernya aktif
                if ($user['is_active'] == 1) {
                    // cek password
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 1) {
                            redirect('admin');
                        } else {
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                redirect('auth');
            }
        }


  public function registration()
  {
    if($this->session->userdata('email')){
      redirect('user');
    }

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
         'is_unique' => 'This email has already registered!'
     ]);
     $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
        'matches' => 'Password dont match!',
        'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if($this->form_validation->run() == false){
      $this->load->library('form_validation');
      $data['title'] = 'WPU User Registration';
      $this->load->view('templates/auth_header1', $data);
      $this->load->view('auth/login1');
      $this->load->view('templates/auth_footer1');
    }
    else{
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2, //2-member
        'is_active' => 0, //email active is 0 (not active when first registered)
        'date_created' => time()
      ];

      //Get token ready
      //We want to translate the bytes characters, so sql can recognize it with base 64
      $token = base64_encode(random_bytes(32)); //in Bytes
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time() //when the token is created, we can make this token expire
      ];

      $this->db->insert('user', $data);
      $this->db->insert('user_token', $user_token);

      //Send email to user who just registered
      $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div style="margin-top:40px;margin-bottom:-50px;text-align:center;color:green">Your account has been created! Please activate your account </div>');
      redirect('auth');

    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol' => 'smtp', //simple mail transfer protocol
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'boshi2pan@gmail.com',
      'smtp_pass' => '72626744&p',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    //Load codeigniter library
    $this->email->initialize($config);

    //Get email ready
    $this->email->from('boshi2pan@gmail.com', 'boshipan');

    //Send to registered email
    $this->email->to($this->input->post('email'));

    //If for email verification (user registration)
    if ($type == 'verify') {
        $this->email->subject('Account Verification');
        $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } else if ($type == 'forgot') {
        $this->email->subject('Reset Password');
        $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }

    //Finally send the email
    if ($this->email->send()) {
        return true;
    } else {
        echo $this->email->print_debugger();
        die;
    }

  }


  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    //Make sure email is valid
    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if($user)
    {
      //Check if token exists
      $user_token = $this->db->get_where('user_token', ['token' => $token])
      ->row_array();

      if ($user_token) {
                  if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                      $this->db->set('is_active', 1);
                      $this->db->where('email', $email);
                      $this->db->update('user');
                      $this->db->delete('user_token', ['email' => $email]);
                      $this->session->set_flashdata('message', '<div style="margin-top:40px;margin-bottom:-50px;text-align:center;color:green">' . $email . ' has been activated! Please login.</div>');
                      redirect('auth');
                  } else {
                      $this->db->delete('user', ['email' => $email]);
                      $this->db->delete('user_token', ['email' => $email]);
                      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                      redirect('auth');
                  }
              } else {
                  $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                  redirect('auth');
              }
          } else {
              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
              redirect('auth');
          }
      }



  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div style="margin-top:40px;margin-bottom:-50px;text-align:center;color:green"" role="alert">You have been logged out</div>');
    redirect('auth');

  }

  //If logged in as user and try to access admin from url (cannot)
  public function blocked()
  {
    //Call the 404 page
    $this->load->view('auth/blocked');
  }

}
