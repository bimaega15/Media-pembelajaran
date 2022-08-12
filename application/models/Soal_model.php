<?php
class Soal_model extends CI_Model
{

    public function get($id_soal = null, $quiz_id = null)
    {

        $this->db->select('*');
        $this->db->from('soal');
        if ($id_soal != null) {
            $this->db->where('id_soal', $id_soal);
        }
        if ($quiz_id != null) {
            $this->db->where('quiz_id', $quiz_id);
        }
        $this->db->order_by('id_soal', 'asc');
        return $this->db->get();
    }
    public function update($data, $id_soal)
    {
        $this->db->where('id_soal', $id_soal);
        $this->db->update('soal', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('soal', $data);
        return $this->db->insert_id();
    }

    public function insertBatch($data)
    {
        $this->db->insert_batch('soal_detail', $data);
        return $this->db->affected_rows();
    }

    public function updateSoalDetail($data, $id_soal_detail)
    {
        $this->db->where('id_soal_detail', $id_soal_detail);
        $this->db->update('soal_detail', $data);
        return $this->db->affected_rows();
    }
    public function delete($id_soal)
    {
        $this->db->delete('soal', ['id_soal' => $id_soal]);
        return $this->db->affected_rows();
    }

    // ujian
    public function getUjian($id_soal = null, $quiz_id = null, $type = null, $soal_id = null)
    {

        $this->db->select('*');
        $this->db->from('soal');
        if ($id_soal != null) {
            $this->db->where('id_soal', $id_soal);
        }
        if ($quiz_id != null) {
            $this->db->where('quiz_id', $quiz_id);
        }
        if ($type == 'next') {
            $this->db->where('id_soal >', $soal_id);
            $this->db->order_by('id_soal', 'asc');
        }
        if ($type == 'back') {
            $this->db->where('id_soal <', $soal_id);
            $this->db->order_by('id_soal', 'desc');
        }
        $this->db->limit(1, 0);
        return $this->db->get();
    }
}
