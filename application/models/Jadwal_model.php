<?php
class Jadwal_model extends CI_Model
{

    public function get($id_jadwal = null)
    {

        $this->db->select('*');
        $this->db->from('jadwal');
        if ($id_jadwal != null) {
            $this->db->where('id_jadwal', $id_jadwal);
        }

        return $this->db->get();
    }
    public function update($data, $id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('jadwal', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('jadwal', $data);
        return $this->db->insert_id();
    }
    public function delete($id_jadwal)
    {
        $this->db->delete('jadwal', ['id_jadwal' => $id_jadwal]);
        return $this->db->affected_rows();
    }
}
