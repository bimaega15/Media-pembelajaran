<?php
class Materi_model extends CI_Model
{

    public function get($id_materi = null)
    {

        $this->db->select('*');
        $this->db->from('materi');
        if ($id_materi != null) {
            $this->db->where('id_materi', $id_materi);
        }
        return $this->db->get();
    }
    public function update($data, $id_materi)
    {
        $this->db->where('id_materi', $id_materi);
        $this->db->update('materi', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('materi', $data);
        return $this->db->insert_id();
    }

    public function delete($id_materi)
    {
        $this->db->delete('materi', ['id_materi' => $id_materi]);
        return $this->db->affected_rows();
    }
}
