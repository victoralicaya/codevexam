<?php

namespace App\Livewire\Company;

use App\Service\CompanyService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Company extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function getCompanies()
    {
        return app(CompanyService::class)->fetchPaginatedCompanies(10);
    }

    public function render()
    {
        return view('livewire.company.company', [
            'companies' => $this->getCompanies()
        ]);
    }
}
