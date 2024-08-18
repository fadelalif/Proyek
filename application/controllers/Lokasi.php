<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
    private $api_url = "http://localhost:8080/api/lokasi";

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $response = $this->call_api($this->api_url);
        $data['lokasi'] = $response;

        $this->load->view('lokasi_list', $data);
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
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        }
        curl_close($curl);
        return json_decode($response, true);
    }

    public function create()
    {
        if ($this->input->post('submit')) {
            $data = [
                'namaLokasi' => $this->input->post('namaLokasi'),
                'negara' => $this->input->post('negara'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'createdAt' => date('Y-m-d H:i:s')
            ];

            $this->call_api($this->api_url, 'POST', $data);
            redirect('lokasi');
        } else {
            $this->load->view('lokasi_create');
        }
    }

    public function edit($id)
    {
        if ($this->input->post('submit')) {
            $data = [
                'namaLokasi' => $this->input->post('namaLokasi'),
                'negara' => $this->input->post('negara'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota')
            ];

            $this->call_api($this->api_url . '/' . $id, 'PUT', $data);
            redirect('lokasi');
        } else {
            // GET single Lokasi data by ID
            $response = $this->call_api($this->api_url . '/' . $id);
            $data['lokasi'] = $response;

            $this->load->view('lokasi_edit', $data);
        }
    }

    public function delete($id)
    {
        // DELETE request ke REST API
        $this->call_api($this->api_url . '/' . $id, 'DELETE');
        redirect('lokasi');
    }
}
