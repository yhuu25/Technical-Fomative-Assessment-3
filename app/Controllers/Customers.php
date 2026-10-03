<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data['customers'] = $customerModel->findAll();

        return view('customers/index', $data);
    }
    public function new()
{
    return view('customers/form', [
        'title'    => 'Add Customer',
        'customer' => null,
    ]);
}

public function create()
{
    $rules = [
        'full_name' => 'required|max_length[100]',
        'email'     => 'required|valid_email|max_length[100]',
        'phone'     => 'permit_empty|max_length[20]',
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $model = new \App\Models\CustomerModel();

    $model->insert([
        'full_name' => trim((string) $this->request->getPost('full_name')),
        'email'     => trim((string) $this->request->getPost('email')),
        'phone'     => trim((string) $this->request->getPost('phone')),
    ]);

    return redirect()->to('/customers')
        ->with('success', 'Customer added successfully.');
}

public function edit(int $id)
{
    $model    = new \App\Models\CustomerModel();
    $customer = $model->find($id);

    if (! $customer) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('customers/form', [
        'title'    => 'Edit Customer',
        'customer' => $customer,
    ]);
}

public function update(int $id)
{
    $model = new \App\Models\CustomerModel();

    if (! $model->find($id)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $rules = [
        'full_name' => 'required|max_length[100]',
        'email'     => 'required|valid_email|max_length[100]',
        'phone'     => 'permit_empty|max_length[20]',
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $model->update($id, [
        'full_name' => trim((string) $this->request->getPost('full_name')),
        'email'     => trim((string) $this->request->getPost('email')),
        'phone'     => trim((string) $this->request->getPost('phone')),
    ]);

    return redirect()->to('/customers')
        ->with('success', 'Customer updated successfully.');
}
}