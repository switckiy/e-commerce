<?php

namespace App\Controllers;


use CodeIgniter\Database\MySQLi\Builder;
use App\Models\ChartModel;
use App\Models\CheckoutModel;

class User extends BaseController
{
    public function index()
    {
        $data['title'] = 'My Profile ';
        return view('user/index', $data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile ';
        return view('user/edit', $data);
    }

    public function addToChart()
    {
        $user = array(user_id());
        $ChartModel = new ChartModel();

        if ($this->request->getMethod() === 'post') {
            // Validasi input form
            $rules = [
                'name_product' => 'required',
                'images' => 'required',
                'quantity' => 'required|numeric',
                'price' => 'required'
            ];

            if ($this->validate($rules)) {
                // Proses unggah file
                $data = [
                    'product_id' => $this->request->getPost('page_id'),
                    'user_id' => $user,
                    'name_product' => $this->request->getPost('name_product'),
                    'images' => $this->request->getPost('images'),
                    'quantity' => $this->request->getPost('quantity'),
                    'price' => $this->request->getPost('price'),
                    'total' => $this->request->getPost('quantity') * $this->request->getPost('price')
                ];

                // Mencegah Duplikat Data \\
                $query = $ChartModel->where('user_id', $user)->where('product_id', $data['product_id'])->select("count(product_id) as validationChart")->first();

                if ($query['validationChart'] > 0) {
                    $ChartModel->query("UPDATE chart SET quantity =$data[quantity] WHERE product_id=$data[product_id] AND user_id=" . implode(" ", $user));

                    // Di sini Pasang Update Buat Ngubah Quantity aja
                } else {
                    $ChartModel->insert($data);
                    # code...
                }
                // ======= End ====== \\

                return redirect()->to('home/detile/' . $this->request->getPost('page_id'));
            } else {
                // Tampilkan pesan error validasi
                return 'Validation error: ' . implode('<br>', $this->validator->getErrors());
            }
        }
    }

    public function updateChart()
    {
        $user = array(user_id());
        $ChartModel = new ChartModel();
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('price');
        $ChartModel->query("UPDATE chart SET quantity =$quantity, total=$price*$quantity WHERE user_id=" . implode(" ", $user));
        return redirect()->to('chart')->with('success', 'Product deleted successfully.');
    }

    public function deleteChart($id, $user_id)
    {
        $productModel = new ChartModel();

        // Remove the product data from the database
        $productModel->query("DELETE FROM chart WHERE product_id=$id and user_id='$user_id'");


        // Redirect to the product listing page with a success message
        return redirect()->to('chart')->with('success', 'Product deleted successfully.');
    }

    public function chekout()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_chart');

        $ChartModel = new ChartModel();
        $CheckoutModel = new CheckoutModel();
        $user = array(user_id());
        $data = $ChartModel->where('user_id', $user)->select('user_id,name_product,images,quantity,price,total')->findAll();
        $result = $builder->insertBatch($data);
        var_dump($data);


        $ChartModel->query("DELETE FROM chart WHERE user_id=" . implode(" ", $user));
        // $ChartModel->query("UPDATE chart SET stats ='not active' WHERE user_id=". implode(" ",$user)); 

        if ($this->request->getMethod() === 'post') {
            // Validasi input form
            $rules = [
                'c_country' => 'required',
                'c_address' => 'required',
                'c_state_country' => 'required',
                'c_postal_zip' => 'required',
                'c_phone' => 'required',
                'total' => 'required'
            ];

            if ($this->validate($rules)) {
                // Proses unggah file
                $data = [
                    'user_id' => $user,
                    'negara' => $this->request->getPost('c_country'),
                    'alamat' => $this->request->getPost('c_address'),
                    'kota' => $this->request->getPost('c_state_country'),
                    'kode_pos' => $this->request->getPost('c_postal_zip'),
                    'telp' => $this->request->getPost('c_phone'),
                    'catatan' => $this->request->getPost('c_order_notes'),
                    'order_total' => $this->request->getPost('total'),
                ];
                $CheckoutModel->insert($data);
                return redirect()->to('/thankyou');
            } else {
                // Tampilkan pesan error validasi
                return 'Validation error: ' . implode('<br>', $this->validator->getErrors());
            }
        }
    }

    public function history()
    {
        $db = \Config\Database::connect(); // Menghubungkan ke database

        $query = $db->table('users')
            ->join('checkoout', 'users.id = checkoout.user_id')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->get();

        $data['results'] = $query->getResult(); // Mengambil hasil query



        $data['title'] = 'History Shop ';
        return view('user/bons', $data);
    }
}
