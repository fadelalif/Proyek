<?php
class Proyek_model extends CI_Model
{

    public function get_all_proyek()
    {
        $this->db->select('proyek.*, GROUP_CONCAT(lokasi.nama_lokasi) as lokasi_names');
        $this->db->from('proyek');
        $this->db->join('proyek_lokasi', 'proyek.id = proyek_lokasi.proyek_id', 'left');
        $this->db->join('lokasi', 'proyek_lokasi.lokasi_id = lokasi.id', 'left');
        $this->db->group_by('proyek.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_proyek($data, $lokasi_ids)
    {
        $this->db->insert('proyek', $data);
        $proyek_id = $this->db->insert_id();
        foreach ($lokasi_ids as $lokasi_id) {
            $this->db->insert('proyek_lokasi', ['proyek_id' => $proyek_id, 'lokasi_id' => $lokasi_id]);
        }
        return $proyek_id;
    }

    public function update_proyek($id, $data, $lokasi_ids)
    {
        $this->db->where('id', $id);
        $this->db->update('proyek', $data);
        $this->db->where('proyek_id', $id);
        $this->db->delete('proyek_lokasi');
        foreach ($lokasi_ids as $lokasi_id) {
            $this->db->insert('proyek_lokasi', ['proyek_id' => $id, 'lokasi_id' => $lokasi_id]);
        }
    }

    public function delete_proyek($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('proyek');
    }
}
