<?php

namespace App\Controllers\Admin\Contacts;

use App\Controllers\Admin\AdminController;
use App\Models\StoreModel;
use App\Models\StorePhoneModel;
use Exception;

class ContactsController extends AdminController
{
    protected StoreModel $storeModel;
    protected StorePhoneModel $storePhoneModel;

    public function __construct()
    {
        $this->storeModel = new StoreModel();
        $this->storePhoneModel = new StorePhoneModel();
    }

    public function index()
    {
        $stores = $this->storeModel->getStoresWithPhones();

        $data = [
            'stores' => $stores,
        ];
        
        return view('Admin/Pages/Contacts', $data);
    }

    public function createStore()
    {
        $data = [
            'name' => null,
            'address' => null,
            'email' => null,
            'working_hours' => null
        ];

        $this->storeModel->save($data);

        return redirect()->to('admin/contacts');
    }

    public function createPhone()
    {
        $request = $this->request->getJSON();

        $store = $this->storeModel->find($request->storeId);

        if (!$store) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Store not found');
        }
    
        $phoneData = [
            'store_id' => $store['store_id'],
            'phone' => null,
        ];

        $phone = $this->storePhoneModel->save($phoneData);

        if (!$phone) {
            $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to save phone data'
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'success' => true,
            'phoneId' => $this->storePhoneModel->insertID(),
        ]);
    }

    public function removePhone(int $id)
    {
        if (!$this->storePhoneModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Phone not found');
        }
        
        $this->storePhoneModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
        ]);
    }

    public function editPhone()
    {
        
    }
}