<?php

namespace App\Controllers\Admin\Contacts;

use App\Controllers\Admin\AdminController;
use App\Models\StoreModel;
use App\Models\StorePhoneModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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

    public function saveStore() {
        $form = $this->request->getPost();

        $store = $this->storeModel->find($form['store-id']);

        if (!$store) {
            throw PageNotFoundException::forPageNotFound('Store not found');
        }
        
        $store = array_merge($store, [
            'name' => $form['name'],
            'address' => $form['address'],
            'email' => $form['email'],
        ]);

        $this->storeModel->save($store);

        foreach($form['phones'] as $id => $number) {
            $tel = $this->storePhoneModel->find($id);

            $tel['phone'] = $number;
            $this->storePhoneModel->save($tel);
        }

        return redirect()->back();
    }

    public function removeStore(int $id) {
        $store = $this->storeModel->find($id);

        if (!$store) {
            throw PageNotFoundException::forPageNotFound('Store not found');
        }

        $this->storePhoneModel
            ->where('store_id', $store['store_id'] )
            ->delete();
        
        $this->storeModel->delete($store['store_id']);
        
        return redirect()->back();
    }

    public function createPhone()
    {
        $request = $this->request->getJSON();

        $store = $this->storeModel->find($request->storeId);

        if (!$store) {
            throw PageNotFoundException::forPageNotFound('Store not found');
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
            throw PageNotFoundException::forPageNotFound('Phone not found');
        }
        
        $this->storePhoneModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
        ]);
    }

    
}