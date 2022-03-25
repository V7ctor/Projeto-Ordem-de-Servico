<?php
    defined('BASEPATH') OR exit("Ação não permitida");

    class Core_Model extends CI_Model {

        public function listAll($table = null, $params = null) {
            if ($table) {
                if (is_array($params)) {
                    $this->db->where($params);
                }
                return $this->db->get($table)->result();
            } else {
                return false;
            }
        }

        public function getById($table = null, $params = null) {
            if ($table && is_array($params)) {
                $this->db->where($params);
                $this->db->limit(1);
                return $this->db->get($table)->row();
            } else {
                return false;
            }
        }

        public function insert($table = null, $data = null, $getLastId = null) {
            if ($table && is_array($data)) {
                $this->db->insert($table, $data);

                if ($getLastId) {
                    $this->session->set_userdata('last_id', $this->db->insert_id());
                }

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata("success", "Dados salvos com sucesso");
                } else {
                    $this->session->set_flashdata("error", "Erro ao salvar dados");
                }
            } else {
                return false;
            }
        }

        public function update($table = null, $data = null, $condition) {
            if ($table && is_array($data) && is_array($condition)) {
                if($this->db->update($table, $data, $condition)) {
                    $this->session->set_flashdata("success", "Dados alterados com sucesso");
                } else {
                    $this->session->set_flashdata("error", "erro ao alterar informações");
                }
            } else {
                return false;
            }
        }

        public function delete($table = null, $condition = null) {
            $this->db->db_debug(false);

            if ($table && is_array($condition)) {
                $status = $this->db->delete($table, $condition);
                $error = $this->db->error();

                if (!$status) { 
                    foreach($error as $code) {
                        if ($code == 1451) {
                            $this->session->set_flashdata("error", "Esse registro não poderá ser excluído pois está vínculado a outros registros de outras tabelas");
                        }
                    }
                } else {
                    $this->session->set_flashdata("success", "registro excluído com sucesso.");
                }
                $this->db->db_debug(true);
            } else {
                return false;
            }
        }
    }
    
?>