<?php
class File_model extends CI_Model
{

    public function get($id_file = null, $materi_id = null)
    {

        $this->db->select('*');
        $this->db->from('file');
        if ($id_file != null) {
            $this->db->where('id_file', $id_file);
        }
        if ($materi_id != null) {
            $this->db->where('materi_id', $materi_id);
        }
        return $this->db->get();
    }
    public function update($data, $id_file)
    {
        $this->db->where('id_file', $id_file);
        $this->db->update('file', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('file', $data);
        return $this->db->insert_id();
    }

    public function delete($id_file)
    {
        $this->db->delete('file', ['id_file' => $id_file]);
        return $this->db->affected_rows();
    }
}
