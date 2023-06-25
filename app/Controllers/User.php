<?php

namespace App\Controllers;


use CodeIgniter\Database\MySQLi\Builder;
use App\Models\ChartModel;
use App\Models\CheckoutModel;
use Dompdf\Dompdf;
use App\Models\ProfileModel;
use App\Models\ShopModel;

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

    public function updateProfile()
    {
        // Create an instance of the User model
        $model = new ProfileModel();

        // Get the user's ID from the session or any identifier you use
        $userId = user_id();

        // Get the form input data
        $name = $this->request->getPost('name');

        // Get the current user's data
        $currentUser = $model->find($userId);
        $currentImage = $currentUser['user_image'];

        // Handle file upload if an image is selected
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newImageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/img/', $newImageName);

            // Delete the old image if it exists and it is not "default.svg"
            if ($currentImage && $currentImage !== 'default.svg' && file_exists(ROOTPATH . '/public/img/' . $currentImage)) {
                unlink(ROOTPATH . 'public/img/' . $currentImage);
            }

            // Update the user's image filename in the database or perform any desired actions
            // Replace the following code with your own logic
            $userImage = $newImageName;
        }

        // Prepare the data for update
        $data = [];
        if ($name) {
            $data['username'] = $name;
        }
        if (isset($newImageName)) {
            $data['user_image'] = $newImageName;
        }

        // Update the user's profile in the database
        $model->update($userId, $data);

        // Set flash messages
        session()->setFlashdata('success', 'Profile updated successfully.');

        // Redirect back to the edit profile page
        return redirect()->to('user/edit');
    }

    public function addToChart()
    {
        $user = array(user_id());
        $ChartModel = new ChartModel();
        $shopModel = new ShopModel();

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
                } else {
                    $ChartModel->insert($data);
                }

                // $shopId = $this->request->getPost('page_id');
                // $quantity = $this->request->getPost('quantity');
                // $shopModel->query("UPDATE shop SET quantity = quantity - $quantity WHERE id = $shopId");

                return redirect()->to('home/shop');
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
        $db = \Config\Database::connect();
        $builder = $db->table('data_chart');

        $chartModel = new ChartModel();
        $checkoutModel = new CheckoutModel();
        $user = user_id();
        $data = $chartModel->where('user_id', $user)->select('user_id, name_product, images, quantity, price, total')->findAll();
        $result = $builder->insertBatch($data);


        foreach ($data as $item) {
            if (isset($item['product_id'])) {
                $shopModel = new ShopModel();
                $shopId = $item['product_id'];
                $quantity = $item['quantity'];
                $shopModel->query("UPDATE shop SET quantity = quantity - $quantity WHERE id = $shopId");
            }
        }

        $chartModel->where('user_id', $user)->delete();

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
                    'name' => $this->request->getPost('name')
                ];
                $checkoutModel->insert($data);
                return redirect()->to('/thankyou');
            } else {
                // Tampilkan pesan error validasi
                return redirect()->to('/chart');
            }
        }
    }


    public function history()
    {
        $db = \Config\Database::connect(); // Menghubungkan ke database

        $user_id = array(user_id());

        $query = $db->table('checkoout')
            ->select('checkoout.*, users.username')
            ->join('users', 'users.id = checkoout.user_id')
            ->where('checkoout.user_id', $user_id)
            ->get();

        $data['results'] = $query->getResult();


        $data['title'] = 'History Shop ';
        return view('user/bons', $data);
    }


    public function generatePDF($user_id)
    {
        $db = \Config\Database::connect(); // Menghubungkan ke database
        $query = $db->table('users')
            ->join('checkoout', 'users.id = checkoout.user_id')
            ->join('data_chart', 'checkoout.user_id = data_chart.user_id AND checkoout.tanggal = data_chart.date')
            ->select('checkoout.id as ids, users.*, checkoout.*, data_chart.*')
            ->where('checkoout.id', $user_id, false)
            ->where('checkoout.tanggal', 'data_chart.date', false) // Compare the dates
            ->get();

        $data['results'] = $query->getResult();
        $data['allData'] = $query->getRowArray();
        // Load view into a variable
        $html = view('pdf_template', $data);

        // Initialize Dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('data.pdf', ['Attachment' => false]);
    }
}
