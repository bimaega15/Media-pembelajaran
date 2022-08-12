<?php
class Users_model extends CI_Model
{
    public function get($id_users = null)
    {

        $this->db->select('*');
        $this->db->from('users');
        if ($id_users != null) {
            $this->db->where('id_users', $id_users);
        }
        return $this->db->get();
    }
    public function login($username, $password)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));

        return $this->db->get();
    }
    public function getCookie($cookie)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('cookie', $cookie);
        return $this->db->get();
    }
    public function joinProfile($id_users = null, $not_id_users = null, $level = null)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('profile', 'profile.users_id = users.id_users');
        if ($id_users != null) {
            $this->db->where('users.id_users', $id_users);
        }
        if ($not_id_users != null) {
            $this->db->where('users.id_users <> ', $not_id_users);
        }
        if ($level != null) {
            $this->db->where('users.level', $level);
        }
        return $this->db->get();
    }
    public function update($data, $id_users)
    {
        $this->db->where('id_users', $id_users);
        $this->db->update('users', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function delete($id_users)
    {
        $this->db->delete('users', ['id_users' => $id_users]);
        return $this->db->affected_rows();
    }
}
