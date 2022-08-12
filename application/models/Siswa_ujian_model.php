<?php
class Siswa_ujian_model extends CI_Model
{
    public function get($id_siswa_ujian = null)
    {

        $this->db->select('*');
        $this->db->from('siswa_ujian');
        if ($id_siswa_ujian != null) {
            $this->db->where('id_siswa_ujian', $id_siswa_ujian);
        }
        return $this->db->get();
    }
    public function insert($data)
    {
        $this->db->insert('siswa_ujian', $data);
        return $this->db->insert_id();
    }
    public function update($data, $id_siswa_ujian)
    {
        $this->db->update('siswa_ujian', $data, [
            'id_siswa_ujian' => $id_siswa_ujian
        ]);
        return $this->db->affected_rows();
    }

    public function delete($id_siswa_ujian)
    {
        $this->db->delete('siswa_ujian', ['id_siswa_ujian' => $id_siswa_ujian]);
        return $this->db->affected_rows();
    }
}
