<?php
    defined('BASEPATH') OR exit("Ação não permitida");

    class User extends CI_Controller {
        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $data = array(
                "users"=>$this->ion_auth->users()->result()
            );

            $this->load->view("layout/header", $data);
            $this->load->view("users/index");
            $this->load->view("layout/footer");

        }
    }
?>