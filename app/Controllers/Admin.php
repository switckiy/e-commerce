<?php

namespace App\Controllers;

use CodeIgniter\Database\MySQLi\Builder;
use App\Models\ShopModel;
use App\Models\CheckoutModel;
use App\Models\KaryawanModel;

use Dompdf\Dompdf;


class Admin extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $revenueModel = new ShopModel();
        $data['productData'] = $revenueModel->getRevenueData();



        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();


        return view('admin/index', $data);
    }

    public function listuser()
    {
        $data['title'] = 'User List';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();



        $this->builder->select('users.id as userid, username, email, GROUP_CONCAT(auth_groups.name) as roles');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->groupBy('users.id');
        $this->builder->where('users.id !=', 1); // Exclude data with ID 1
        $query = $this->builder->get();

        $data['users'] = $query->getResult();


        return view('admin/listuser', $data);
    }


    public function roleuser($id = 0)
    {
        $data['title'] = 'role List';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $db = \Config\Database::connect();

        $query = $db->table('auth_groups');
        $query->select('name , id');
        $query->where('id !=', 1); // Exclude data with ID 1
        $data['datas'] = $query->get()->getResult();

        $query2 = $db->table('auth_groups_users');
        $query2->select('group_id , user_id');
        $query2->where('user_id', $id); // Filter the results by user_id
        $data['role'] = $query2->get()->getResult();

        $data['userid'] = $id; // Include the userid in the data array



        return view('admin/roleuser', $data);
    }

    public function updateRole($userId = null)
    {
        if ($this->request->isAJAX() && $userId) {
            $requestData = $this->request->getJSON(true);

            $roleId = $requestData['roleId'];
            $isChecked = $requestData['isChecked'];

            // Save the role data to the database
            $db = db_connect();

            $data = [
                'user_id' => $userId,
                'group_id' => $roleId
            ];

            if ($isChecked) {
                $db->table('auth_groups_users')->insert($data);
            } else {
                $db->table('auth_groups_users')->where($data)->delete();
            }

            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }


    public function detail($id = 0)
    {
        $data['title'] = 'User Detaile';


        $this->builder->select('users.id as userid, username, email, fullname, user_image, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();
        if (empty($data['user'])) {
            return redirect()->to('/admin/detail');
        }

        return view('admin/detail', $data);
    }


    public function shop()
    {
        $data['title'] = 'Shop';


        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $shopModel = new ShopModel();
        $data['shops'] = $shopModel->findAll();

        $data['users'] = $query->getResult();


        return view('admin/Shop', $data);
    }

    public function addItem()
    {
        $shopModel = new ShopModel();

        if ($this->request->getMethod() === 'post') {
            // Validasi input form
            $rules = [
                'name' => 'required',
                'quantity' => 'required|numeric',
                'price' => 'required',
                'deskripsi' => 'required'
            ];

            if ($this->validate($rules)) {
                // Proses unggah file
                $file = $this->request->getFile('images');

                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads', $newName);

                    // Simpan data ke database
                    $data = [
                        'name' => $this->request->getPost('name'),
                        'quantity' => $this->request->getPost('quantity'),
                        'price' => $this->request->getPost('price'),
                        'deskripsi' => $this->request->getPost('deskripsi'),
                        'diskon' => $this->request->getPost('diskon'),
                        'images' => $newName
                    ];

                    $shopModel->insert($data);

                    // Redirect to admin/Shop
                    return redirect()->to('admin/Shop');
                } else {
                    // Tampilkan pesan error
                    return 'Failed to upload file.';
                }
            } else {
                // Tampilkan pesan error validasi
                return 'Validation error: ' . implode('<br>', $this->validator->getErrors());
            }
        }
    }


    public function deleteshop($id)
    {
        $productModel = new ShopModel();

        // Get the product data from the database
        $product = $productModel->find($id);

        if (!$product) {
            // Product not found, handle the error or redirect
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Delete the file from the public/uploads folder
        $filePath = ROOTPATH . 'public/uploads/' . $product['images'];

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Remove the product data from the database
        $productModel->delete($id);


        // Redirect to the product listing page with a success message
        return redirect()->to('admin/Shop')->with('success', 'Product deleted successfully.');
    }

    public function about()
    {
        $data = [];

        // Cek apakah request merupakan POST
        if ($this->request->getMethod() === 'post') {
            // Validasi input
            $validationRules = [
                'title' => 'required',
                'description' => 'required'
            ];

            if ($this->validate($validationRules)) {
                $file = $this->request->getFile('images');

                // Proses upload file
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('img', $newName);

                    $title = $this->request->getPost('title');
                    $description = $this->request->getPost('description');

                    // Simpan data ke database
                    $aboutModel = new \App\Models\AboutModel();
                    $aboutData = [
                        'title' => $title,
                        'deskripsi' => $description
                    ];

                    // Cek apakah ada file gambar yang diunggah
                    if (!empty($newName)) {
                        $aboutData['images'] = $newName;

                        // Hapus gambar lama jika ada
                        $oldImage = $aboutModel->find(1)['images'];
                        if (!empty($oldImage) && file_exists('img/' . $oldImage)) {
                            unlink('img/' . $oldImage);
                        }
                    }

                    $aboutModel->update(1, $aboutData); // Mengupdate data pada id 1, sesuaikan dengan struktur tabel

                    // Tambahkan pesan sukses
                    $data['success'] = 'Data has been updated successfully.';
                } else {
                    // Tambahkan pesan error jika file tidak valid
                    $data['error'] = 'Invalid file.';
                }
            } else {
                // Tambahkan pesan error validasi input
                $data['error'] = 'Invalid input.';
            }
        }

        // Ambil data dari database
        $aboutModel = new \App\Models\AboutModel();
        $aboutData = $aboutModel->find(1); // Mengambil data pada id 1, sesuaikan dengan struktur tabel

        // Set data dari database ke dalam array $data
        if ($aboutData) {
            $data['images'] = $aboutData['images'];
            $data['titles'] = $aboutData['title'];
            $data['description'] = $aboutData['deskripsi'];
        }

        $data['title'] = 'Shop';
        // Tampilkan view
        return view('admin/about', $data);
    }


    public function history()
    {
        $db = \Config\Database::connect(); // Menghubungkan ke database

        $query = $db->table('checkoout')
            ->select('checkoout.*, users.username')
            ->join('users', 'users.id = checkoout.user_id')
            ->get();

        $data['results'] = $query->getResult();


        $data['title'] = 'History Shop ';
        return view('admin/bons', $data);
    }

    public function generatePDF($user_id)
    {
        $db = \Config\Database::connect(); // Menghubungkan ke database
        $query = $db->table('users')
            ->join('checkoout', 'users.id = checkoout.user_id')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->select('checkoout.id as ids, users.*, checkoout.*, data_chart.*')
            ->where('checkoout.id', $user_id)
            ->where('checkoout.tanggal', 'data_chart.date', false) // Compare the dates
            ->get();

        $data['results'] = $query->getResult();

        $data['allData'] = $query->getRowArray();
        // Load view into a variable
        $html = view('pdf_templates', $data);

        // Initialize Dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('data.pdf', ['Attachment' => false]);
    }
    public function status()
    {

        $model = new KaryawanModel();
        $data['karyawan'] = $model->getKaryawan();
        $db = \Config\Database::connect(); // Menghubungkan ke database

        $query = $db->table('checkoout')
            ->select('checkoout.*, users.username ')
            ->join('users', 'users.id = checkoout.user_id')
            ->get();

        $data['results'] = $query->getResult();


        $data['title'] = 'Edit Status ';
        return view('admin/status', $data);
    }

    public function update($id)
    {
        $username = $this->request->getPost('username');
        $karyawan = $this->request->getPost('karyawan');
        $stats = $this->request->getPost('stats');
        $ongkos = $this->request->getPost('ongkos');

        // Lakukan validasi data jika diperlukan

        // Lakukan pembaruan data di database
        $model = new CheckoutModel();
        $model->update($id, [
            'karyawan' => $karyawan,
            'stats' => $stats,
            'ongkos' => $ongkos
        ]);

        return redirect()->to(base_url('admin/status'))->with('success', 'Data berhasil diperbarui');
    }


    public function editItem($id)
    {
        // Cek apakah request merupakan POST
        if ($this->request->getMethod() === 'post') {
            // Inisialisasi objek validasi
            $validation = \Config\Services::validation();

            // Validasi form
            $validation->setRules([
                'name' => 'required',
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'deskripsi' => 'required',
                'diskon' => 'required|numeric'
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Mendapatkan data dari form
                $name = $this->request->getPost('name');
                $quantity = $this->request->getPost('quantity');
                $price = $this->request->getPost('price');
                $deskripsi = $this->request->getPost('deskripsi');
                $diskon = $this->request->getPost('diskon');

                // Update data di database
                $shopModel = new ShopModel();
                $shopModel->update($id, [
                    'name' => $name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'deskripsi' => $deskripsi,
                    'diskon' => $diskon
                ]);

                // Redirect atau tampilkan pesan sukses
                return redirect()->to(base_url('admin'))->with('success', 'Item updated successfully');
            } else {
                // Validasi gagal, tampilkan pesan error
                $errors = $validation->getErrors();
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        }
    }
}
