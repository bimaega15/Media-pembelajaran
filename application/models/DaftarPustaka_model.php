<?php
class DaftarPustaka_model extends CI_Model
{

    public function get($id_pustaka = null, $materi_id = null)
    {

        $this->db->select('*');
        $this->db->from('daftar_pustaka');
        if ($id_pustaka != null) {
            $this->db->where('id_pustaka', $id_pustaka);
        }
        if ($materi_id != null) {
            $this->db->where('materi_id', $materi_id);
        }
        return $this->db->get();
    }
    public function update($data, $id_pustaka)
    {
        $this->db->where('id_pustaka', $id_pustaka);
        $this->db->update('daftar_pustaka', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('daftar_pustaka', $data);
        return $this->db->insert_id();
    }

    public function delete($id_pustaka)
    {
        $this->db->delete('daftar_pustaka', ['id_pustaka' => $id_pustaka]);
        return $this->db->affected_rows();
    }
}
