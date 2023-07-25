<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPosition;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()
            ->count(5)
            ->has(JobPosition::factory()->count(5), 'positions')
            ->create()
        ;

        $this->createTieredDepartment('Human Resource');
        $this->createTieredDepartment('Finance');
        $this->createExecutiveDepartment();
    }

    protected function createTieredDepartment(string $name): void
    {

        $department = Department::firstOrCreate([
            'name' => $name,
        ]);

        // $manager = Employee::query()->inRandomOrder()->first();

        $positions = [
            new JobPosition([
                'department_id' => $department->id,
                'name' => 'Manager',
                'level' => 100,
                // 'employee_id' => $manager->id,
            ]),
            new JobPosition([
                'department_id' => $department->id,
                'name' => 'Supervisor',
                'level' => 50,
            ]),
            new JobPosition([
                'department_id' => $department->id,
                'name' => 'Staff',
                'level' => 10,
            ]),
        ];

        $department->positions->each->delete();
        $department->positions()->saveMany($positions);
    }

    protected function createExecutiveDepartment(): void
    {
        $department = Department::firstOrCreate([
            'name' => 'Executive',
        ]);

        $positions = [
            new JobPosition([
                'department_id' => $department->id,
                'name' => 'Managing Director',
                'level' => 10000,
            ]),
            new JobPosition([
                'department_id' => $department->id,
                'name' => 'Vice Managing Director',
                'level' => 1000,
            ]),
        ];

        $department->positions->each->delete();
        $department->positions()->saveMany($positions);
    }
}
