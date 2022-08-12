<?php
class Kompetensi_model extends CI_Model
{

    public function get($id_kompetensi = null)
    {

        $this->db->select('*');
        $this->db->from('kompetensi');
        if ($id_kompetensi != null) {
            $this->db->where('id_kompetensi', $id_kompetensi);
        }

        return $this->db->get();
    }
    public function update($data, $id_kompetensi)
    {
        $this->db->where('id_kompetensi', $id_kompetensi);
        $this->db->update('kompetensi', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('kompetensi', $data);
        return $this->db->insert_id();
    }

    public function delete($id_kompetensi)
    {
        $this->db->delete('kompetensi', ['id_kompetensi' => $id_kompetensi]);
        return $this->db->affected_rows();
    }
}
