<?php
    defined('BASEPATH') OR exit("Ação não permitida");

    class User extends CI_Controller {
        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $data = array(
                "styles"=> array (
                    'vendor/datatables/dataTables.bootstrap4.min.css'
                ),
                "scripts"=> array (
                    'vendor/datatables/jquery.dataTables.min.js',
                    'vendor/datatables/app.js'
                ),
                "users"=>$this->ion_auth->users()->result(),
                "title"=>"Lista de Usuários"
            );

            $this->load->view("layout/header", $data);
            $this->load->view("users/index");
            $this->load->view("layout/footer");

        }
    }
?>