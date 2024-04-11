<?php

namespace App\Service;

use App\Repository\CompanyRepository;
use Carbon\Carbon;
use GuzzleHttp\Client;

class CompanyService
{
    protected $companyRepo;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    public function addCompany($data)
    {
        $file = $data['name'].'.'.$data['logo']->getClientOriginalExtension();
        $data['logo']->storeAs('images', $file, 'public');

        $companyData = [
            'logo' => $file,
            'name' => $data['name'],
            'slug' => strtolower(str_replace(' ', '-', $data['name'])),
            'description' => $data['description'],
            'address' => $data['address'],
        ];

        $this->companyRepo->create($companyData);
    }

    public function fetchPaginatedCompanies($size)
    {
        return $this->companyRepo->paginate($size);
    }

    public function fetchCompany($query)
    {
        return $this->companyRepo->first($query);
    }

    public function fetchStockPricing()
    {
        $client = new Client();

        $date = Carbon::now();
        $startDate = $date->subDay(1);
        $endDate = $startDate->subDay(1);

        $stockResponse = $client->request('GET', 'https://api.polygon.io/v2/aggs/ticker/AMZN/range/1/day/'.$startDate->format('Y-m-d').'/'.$endDate->format('Y-m-d'), [
            'query' => [
                'adjusted' => true,
                'sort' => 'asc',
                'limit' => 120,
                'apiKey' => 'RpNaJLrcITEfrJjJkXWXM7bz5_GozOro'
            ]
        ]);

        return json_decode($stockResponse->getBody(), true);
    }

    public function fetchFinancialStatements()
    {
        $client = new Client();

        $financialResponse = $client->request('GET', 'https://api.polygon.io/vX/reference/financials', [
            'query' => [
                'ticker' => 'AMZN',
                'apiKey' => 'RpNaJLrcITEfrJjJkXWXM7bz5_GozOro'
            ]
        ]);

        return json_decode($financialResponse->getBody(), true);
    }
}
