<?php
class Petunjuk_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('petunjuk');
        if ($id != null) {
            $this->db->where('id_petunjuk', $id);
        }
        return $this->db->get();
    }
    public function update($data, $id_petunjuk)
    {
        $this->db->where('id_petunjuk', $id_petunjuk);
        $this->db->update('petunjuk', $data);
        return $this->db->affected_rows();
    }
    public function insert($data)
    {
        $this->db->insert('petunjuk', $data);
        return $this->db->affected_rows();
    }
    public function delete($id_petunjuk)
    {
        $this->db->delete('petunjuk', ['id_petunjuk' => $id_petunjuk]);
        return $this->db->affected_rows();
    }
}
