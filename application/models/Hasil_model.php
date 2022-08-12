<?php
class Hasil_model extends CI_Model
{

    public function get($id_hasil = null, $quiz_id = null)
    {

        $this->db->select('*');
        $this->db->from('hasil');
        if ($id_hasil != null) {
            $this->db->where('id_hasil', $id_hasil);
        }
        if ($quiz_id != null) {
            $this->db->where('quiz_id', $quiz_id);
        }
        return $this->db->get();
    }
    public function getDetail($id_hasil = null)
    {

        $this->db->select('*');
        $this->db->from('hasil_detail');

        if ($id_hasil != null) {
            $this->db->where('hasil_id', $id_hasil);
        }

        return $this->db->get();
    }
    public function update($data, $id_hasil)
    {
        $this->db->where('id_hasil', $id_hasil);
        $this->db->update('hasil', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('hasil', $data);
        return $this->db->insert_id();
    }

    public function insertBatch($data)
    {
        $this->db->insert_batch('hasil_detail', $data);
        return $this->db->affected_rows();
    }

    public function delete($id_hasil)
    {
        $this->db->delete('hasil', ['id_hasil' => $id_hasil]);
        return $this->db->affected_rows();
    }
}
