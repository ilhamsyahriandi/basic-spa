<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model|TModel>
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(),
            'work_mobile' => '62' . $this->faker->randomElement(['812', '823', '834']) . $this->faker->numberBetween(0, 99999999),
            'work_phone' => '62' . $this->faker->randomElement(['21', '31', '41']) . $this->faker->numberBetween(0, 9999999),
            'email' => $this->faker->text(10) . '@gmail.com',
        ];
    }
}
