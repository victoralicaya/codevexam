<?php

namespace Tests\Feature;

use App\Livewire\Company\AddCompany;
use App\Livewire\Company\Company;
use App\Livewire\Company\ViewCompany;
use App\Models\Company as CompanyModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_add_company(): void
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('logo.jpg');

        $data = [
            'logo' => $logo,
            'name' => 'Test Company',
            'slug' => strtolower(str_replace(' ', '-', 'Test Company')),
            'description' => 'This is a test company.',
            'address' => '123 Test Street',
        ];

        Livewire::test(AddCompany::class)
            ->set('logo', $data['logo'])
            ->set('name', $data['name'])
            ->set('slug', $data['slug'])
            ->set('description', $data['description'])
            ->set('address', $data['address'])
            ->call('addCompany');

        $this->assertDatabaseHas('companies', [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'address' => $data['address'],
        ]);

        Storage::disk('public')->assertExists('images/' . $data['name'] . '.' . $logo->getClientOriginalExtension());
    }
    /** @test */
    public function test_view_companies()
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('logo.jpg');

        $companies = collect(range(1, 10))->map(function () use ($logo) {
            return CompanyModel::create([
                'logo' => $logo,
                'name' => 'Test Company',
                'slug' => strtolower(str_replace(' ', '-', 'Test Company')),
                'description' => 'This is a test company.',
                'address' => '123 Test Street',
            ]);
        });

        $view = Livewire::test(Company::class)
            ->call('getCompanies')
            ->viewData('companies');

        $this->assertEquals($companies->pluck('id'), $view->pluck('id'));
    }

    /** @test */
    public function it_retrieves_a_company()
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('logo.jpg');

        $company = CompanyModel::create([
            'logo' => $logo,
            'name' => 'Test Company',
            'slug' => strtolower(str_replace(' ', '-', 'Test Company')),
            'description' => 'This is a test company.',
            'address' => '123 Test Street',
        ]);

        $retrievedCompany = Livewire::test(ViewCompany::class, ['slug' => $company->slug])
            ->call('getCompany')
            ->viewData('company');

        $this->assertEquals($company->id, $retrievedCompany->id);
    }

    /** @test */
    public function test_logs_out_a_user()
    {
        $user = User::factory()->create();
        Auth::login($user);

        Livewire::test(Company::class)
            ->call('logout');

        $this->assertFalse(Auth::check());
    }
}
