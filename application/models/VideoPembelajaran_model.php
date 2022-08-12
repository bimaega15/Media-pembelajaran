<?php
class VideoPembelajaran_model extends CI_Model
{

    public function get($id_video = null, $materi_id = null)
    {

        $this->db->select('*');
        $this->db->from('video_materi');
        if ($id_video != null) {
            $this->db->where('id_video', $id_video);
        }
        if ($materi_id != null) {
            $this->db->where('materi_id', $materi_id);
        }
        return $this->db->get();
    }
    public function update($data, $id_video)
    {
        $this->db->where('id_video', $id_video);
        $this->db->update('video_materi', $data);
        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert('video_materi', $data);
        return $this->db->insert_id();
    }

    public function delete($id_video)
    {
        $this->db->delete('video_materi', ['id_video' => $id_video]);
        return $this->db->affected_rows();
    }
}
