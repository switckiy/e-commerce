<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Karyawans extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $model = new KaryawanModel();
        $data['karyawan'] = $model->getKaryawan();

        $query = $db->table('checkoout')
            ->select('karyawan, COUNT(*) AS jumlah')
            ->where('karyawan !=', '-')
            ->groupBy('karyawan')
            ->get();

        $datas = $query->getResult();

        $data['title'] = 'Karyawan';
        // Tampilkan view
        return view('karyawan/index', array_merge($data, ['datas' => $datas]));
    }

    public function addKaryawan()
    {
        $model = new KaryawanModel();

        $name = $this->request->getPost('name');

        $data = [
            'name' => $name
        ];

        $model->addKaryawan($data);

        return redirect()->to('/karyawans');
    }


    public function deleteKaryawan($id)
    {
        $model = new KaryawanModel();

        // Get the product data from the database
        $product = $model->find($id);


        // Remove the product data from the database
        $model->delete($id);


        // Redirect to the product listing page with a success message
        return redirect()->to('/karyawans');
    }



    public function generatePDF($karyawanId)
    {
        $db = db_connect();

        // Menjalankan query pertama
        $query1 = $db->table('checkoout')
            ->select('checkoout.*, data_chart.*, karyawan.*')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->join('karyawan', 'checkoout.karyawan = karyawan.name')
            ->where('checkoout.user_id', 'data_chart.user_id', false)
            ->where('checkoout.tanggal', 'data_chart.date', false)
            ->where('karyawan.id', $karyawanId) // Menambahkan kondisi WHERE berdasarkan ID karyawan
            ->get();
        $data = $query1->getResult();

        $query2 = $db->table('karyawan')
            ->select('karyawan.id AS id_kry, karyawan.name, COUNT(checkoout.karyawan) AS jumlah_nama_karyawan')
            ->join('checkoout', 'karyawan.name = checkoout.karyawan')
            ->where('karyawan.id', $karyawanId)
            ->groupBy('karyawan.id, karyawan.name')
            ->get();

        $data1 = $query2->getResult();


        // Membuat objek Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Membuat konten PDF
        $html = view('pdf_view', [
            'data' => $data,
            'data1' => $data1
        ]);

        // Memuat konten PDF ke Dompdf
        $dompdf->loadHtml($html);

        // Render konten PDF
        $dompdf->render();

        // Menghasilkan file PDF
        $dompdf->stream('filename.pdf', ['Attachment' => false]);
    }
}
