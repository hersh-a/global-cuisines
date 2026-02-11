<?php
class Crud_model extends CI_Model {
    function __construct() {
    // Call the Model constructor
    parent::__construct();
    }
    function get_cuisine_detail($id){
        $this->db->select('ci_cuisines.*, users.username'); 
        $this->db->from('ci_cuisines');
        $this->db->join('users', 'ci_cuisines.author_id = users.id', 'left');
        $this->db->where('ci_cuisines.cuisine_id', $id);
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }

    function get_cuisines() {
        $query = $this->db->get('ci_cuisines');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function insert_cuisine($data){
    $this->db->insert('ci_cuisines', $data);
    }

    function edit_cuisine($data,$id){
    $this->db->where('cuisine_id', $id);
    $this->db->update('ci_cuisines', $data);
    }

    function delete_cuisine($id){
    $this->db->where('cuisine_id', $id);
    $this->db->delete('ci_cuisines');
    }

    public function get_all_cuisines() {
    $query = $this->db->get('ci_cuisines'); // replace 'cuisines' with your table name
    return $query->result();
    }

    public function check_owner($cuisine_id, $user_id){
    $this->db->select('author_id');
    $this->db->from('ci_cuisines');
    $this->db->where('cuisine_id', $cuisine_id);
    $query = $this->db->get();

    if ($query->num_rows() === 0) {
        return FALSE;
    }

    $row = $query->row();
    return ($row->author_id == $user_id);
    }


}

