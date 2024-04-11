<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Service\CompanyService;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCompany extends Component
{
    use WithFileUploads;

    public $logo, $name, $description, $address;

    public function addCompany()
    {
        $this->validate([
            'logo' => 'required|mimes:png,jpg,jpeg|max:1024',
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);

        app(CompanyService::class)->addCompany([
            'logo' => $this->logo,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Company added successfully!');

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.company.add-company');
    }
}
