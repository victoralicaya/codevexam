<?php

namespace App\Livewire\Company;

use App\Service\CompanyService;
use Livewire\Component;

class ViewCompany extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function getCompany()
    {
        return app(CompanyService::class)->fetchCompany($this->slug);
    }

    public function render()
    {
        $stockPrice = app(CompanyService::class)->fetchStockPricing();

        $financials = app(CompanyService::class)->fetchFinancialStatements();

        return view('livewire.company.view-company', [
            'company' => $this->getCompany(),
            'stockPrice' => $stockPrice,
            'financials' => $financials && $financials['results'] ? $financials['results'][0] : null
        ]);
    }
}
