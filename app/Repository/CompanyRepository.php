<?php

namespace App\Repository;

use App\Models\Company;

class CompanyRepository
{
    public function create(array $data)
    {
        return Company::create($data);
    }

    public function paginate($size)
    {
        return Company::paginate($size);
    }

    public function first($query)
    {
        return Company::where('slug', $query)->first();
    }
}
