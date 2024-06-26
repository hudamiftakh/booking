<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        error_reporting(0);
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
    {
        if (!empty($this->session->userdata['username'])) {
            redirect('./dashboard/booking');
        } else {
            // $this->login();
            $this->load->view('onboard');
        }

    }
    public function login()
    {
        $this->load->view('login');
    }
    public function logout()
    {
        session_destroy();
        redirect('./login');
    }

    public function doLogin()
    {
        try {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            var_dump($password);
            if (!empty($username) and !empty($password)) {
                if ($username = 'admin' and $password = 'admin') {
                    $data = array(
                        'username' => 'admin',
                        'level' => 'admin'
                    );
                    $this->session->set_userdata('username', $data);
                    redirect('./dashboard/booking');
                } else {
                    redirect('./');
                }
            } else {
                redirect('./');
            }
            // if (isset($_GET['code'])) {
            //     $this->googleplus->getAuthenticate();
            //     $resultData = $this->googleplus->getUserInfo();
            //     $checkUser = $this->db->get_where('users',array('email'=>$resultData['email']));
            //     $data = array(
            //         'email' =>  $resultData['email'],
            //         'name'=> $resultData['name'],
            //         'nama'=> $resultData['name'],
            //         'given_name'=> @$resultData['given_name'],
            //         'picture'=> @$resultData['picture'],
            //         'family_name'=> @$resultData['family_name'],
            //         'locale'=> @$resultData['locale'],
            //         'status'=> 'aktif',
            //         'login_at'=> date('Y-m-d H:i:s'),
            //     );
            //     if($checkUser->num_rows()>=1){
            //         $this->db->update('users',array('login_at'=>date('Y-m-d H:i:s')),array('email'=>$resultData['email']));
            //         $this->session->set_userdata('username', $data);
            //         redirect('./dashboard');
            //     }else{
            //         $this->db->insert('users',$data);
            //         $this->session->set_userdata('username', $data);
            //         redirect('./dashboard');
            //     }

            // } 
        } catch (Exception $e) {
            echo "Error " . $e;
            redirect('./login');
        }
    }
    public function checkSession()
    {
        if (empty($this->session->userdata['username'])) {
            redirect('./');
        }
    }
}
?>