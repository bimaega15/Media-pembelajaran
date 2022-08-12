<?php
class Quiz_model extends CI_Model
{

    public function get($id_quiz = null, $materi_id = null)
    {

        $this->db->select('*');
        $this->db->from('quiz');
        if ($id_quiz != null) {
            $this->db->where('id_quiz', $id_quiz);
        }
        if ($materi_id != null) {
            $this->db->where('materi_id', $materi_id);
        }
        return $this->db->get();
    }
    public function update($data, $id_quiz)
    {
        $this->db->where('id_quiz', $id_quiz);
        $this->db->update('quiz', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('quiz', $data);
        return $this->db->insert_id();
    }

    public function delete($id_quiz)
    {
        $this->db->delete('quiz', ['id_quiz' => $id_quiz]);
        return $this->db->affected_rows();
    }
}
