<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\StorePhoneModel;

class StoreModel extends Model
{
    protected $table      = 'Stores';
    protected $primaryKey = 'store_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['name', 'address', 'email', 'working_hours'];

    public function getStoresWithPhones(): array
    {
        $stores = $this->orderBy('store_id', 'DESC')->findAll();
        foreach ($stores as $key => $value) {
            $storePhoneModel = new StorePhoneModel();

            $stores[$key]['phones'] = [];

            $phonesRecords = $storePhoneModel->where('store_id', $value['store_id'])->find();

            foreach ($phonesRecords as $phone) {
                $stores[$key]['phones'][$phone['phone_id']] = $phone['phone'];
            }
        }
        return $stores;
    }
}

