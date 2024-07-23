<?php

namespace Database\Factories;

use App\Models\AddressDetails;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\PhysicalCompany;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail(),
            'company_type' => 'App\Models\PhysicalCompany',
            'company_id' => PhysicalCompany::factory(),
            'company_type_id' => (CompanyType::where('key', 'physical')->first('id'))->id,
            'ipn' => $this->faker->numerify('##########'),
            'address_id' => AddressDetails::factory(),
            'bank' => $this->faker->text(50),
            'iban' => $this->faker->text(29),
            'mfo' => $this->faker->numerify('#####'),
            'about' => $this->faker->text(),
            'currency'=> $this->faker->text(5),
            'workspace_id' => Workspace::factory()
        ];
    }
}
