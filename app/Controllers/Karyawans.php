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








    // Masih dalam Develop yah !!
    public function data()
    {
        $db = db_connect();

        $query = $db->table('checkoout')
            ->select('checkoout.*, data_chart.*, karyawan.*')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->join('karyawan', 'checkoout.karyawan = karyawan.name')
            ->where('checkoout.user_id', 'data_chart.user_id', false)
            ->where('checkoout.tanggal', 'data_chart.date', false)
            ->get();

        $data = $query->getResult();

        $query = $db->table('checkoout')
            ->select('karyawan, COUNT(*) AS jumlah')
            ->where('karyawan !=', '-')
            ->groupBy('karyawan')
            ->get();

        $datas = $query->getResult();

        $query = $db->table('data_chart')
            ->select('data_chart.name_product, SUM(data_chart.quantity) AS total_quantity')
            ->join('checkoout', 'data_chart.user_id = checkoout.user_id AND data_chart.date = checkoout.tanggal')
            ->groupBy('data_chart.name_product')
            ->where('checkoout.tanggal', 'data_chart.date', false)
            ->get();

        $data2 = $query->getResult();
    }



    public function generatePDF()
    {
        $db = db_connect();
        // Menjalankan query pertama
        $query1 = $db->table('checkoout')
            ->select('checkoout.*, data_chart.*, karyawan.*')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->join('karyawan', 'checkoout.karyawan = karyawan.name')
            ->where('checkoout.user_id', 'data_chart.user_id', false)
            ->where('checkoout.tanggal', 'data_chart.date', false)
            ->get();
        $data = $query1->getResult();

        // Menjalankan query kedua
        $query2 = $db->table('checkoout')
            ->select('karyawan, COUNT(*) AS jumlah')
            ->where('karyawan !=', '-')
            ->groupBy('karyawan')
            ->get();
        $datas = $query2->getResult();

        // Menjalankan query ketiga
        $query3 = $db->table('data_chart')
            ->select('data_chart.name_product, SUM(data_chart.quantity) AS total_quantity')
            ->join('checkoout', 'data_chart.user_id = checkoout.user_id AND data_chart.date = checkoout.tanggal')
            ->groupBy('data_chart.name_product')
            ->where('checkoout.tanggal', 'data_chart.date', false)
            ->get();
        $data2 = $query3->getResult();

        // Membuat objek Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Membuat konten PDF
        $html = view('pdf_view', [
            'data' => $data,
            'datas' => $datas,
            'data2' => $data2
        ]);

        // Memuat konten PDF ke Dompdf
        $dompdf->loadHtml($html);

        // Render konten PDF
        $dompdf->render();

        // Menghasilkan file PDF
        $dompdf->stream('filename.pdf', ['Attachment' => false]);
    }
}
