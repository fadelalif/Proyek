<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{
    private $api_url = "http://localhost:8080/api/proyek";
    public function index()
    {
        $response = $this->curl->simple_get($this->api_url);
        $data['proyek'] = json_decode($response, true);
        $this->load->view('proyek_list', $data);
    }
    function call_api($url, $method = 'GET', $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function create()
    {
        if ($this->input->post('submit')) {
            $data = [
                'namaProyek' => $this->input->post('namaProyek'),
                'client' => $this->input->post('client'),
                'tglMulai' => $this->input->post('tglMulai'),
                'tglSelesai' => $this->input->post('tglSelesai'),
                'pimpinanProyek' => $this->input->post('pimpinanProyek'),
                'keterangan' => $this->input->post('keterangan'),
                'createdAt' => date('Y-m-d H:i:s'),
                'lokasiId' => $this->input->post('lokasiId') 
            ];

            $this->curl->simple_post($this->api_url, $data);
            redirect('proyek');
        } else {
            $lokasi_response = $this->curl->simple_get("http://localhost:8080/api/lokasi");
            $data['lokasi'] = json_decode($lokasi_response, true);

            $this->load->view('proyek_create', $data);
        }
    }

    public function edit($id)
    {
        if ($this->input->post('submit')) {
            $data = [
                'namaProyek' => $this->input->post('namaProyek'),
                'client' => $this->input->post('client'),
                'tglMulai' => $this->input->post('tglMulai'),
                'tglSelesai' => $this->input->post('tglSelesai'),
                'pimpinanProyek' => $this->input->post('pimpinanProyek'),
                'keterangan' => $this->input->post('keterangan'),
                'lokasiId' => $this->input->post('lokasiId')
            ];

            $this->curl->simple_put($this->api_url . '/' . $id, $data);
            redirect('proyek');
        } else {
            $response = $this->curl->simple_get($this->api_url . '/' . $id);
            $data['proyek'] = json_decode($response, true);

            $lokasi_response = $this->curl->simple_get("http://localhost:8080/api/lokasi");
            $data['lokasi'] = json_decode($lokasi_response, true);

            $this->load->view('proyek_edit', $data);
        }
    }

    public function delete($id)
    {
        $this->curl->simple_delete($this->api_url . '/' . $id);
        redirect('proyek');
    }
}
