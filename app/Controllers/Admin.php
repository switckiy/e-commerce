<?php

namespace App\Controllers;

use CodeIgniter\Database\MySQLi\Builder;
use App\Models\ShopModel;


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



        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();


        return view('admin/listuser', $data);
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
            return redirect()->to('/admin');
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
}
