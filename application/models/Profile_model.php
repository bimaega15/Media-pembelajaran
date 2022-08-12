<?php
class Profile_model extends CI_Model
{
    public function update($data, $users_id)
    {
        $this->db->update('profile', $data, [
            'users_id' => $users_id
        ]);
        return $this->db->affected_rows();
    }
    public function insert($data)
    {
        $this->db->insert('profile', $data);
        return $this->db->insert_id();
    }
}
