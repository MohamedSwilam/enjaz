<?php
namespace Database\Seeders;

use App\Modules\Authentication\Domain\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types() as $type){
            $userType = UserType::where('id', $type['id'])->first();
            if (!$userType){
                UserType::create($type);
            }
        }
    }

    /**
     * The default admin users.
     *
     * @return array
     */
    private function types(): array
    {
        return [
            [
                'id' => 1,
                'type' => 'Normal',
                'discount_percentage' => 2,
            ],
            [
                'id' => 2,
                'type' => 'Silver',
                'discount_percentage' => 5,
            ],
            [
                'id' => 3,
                'type' => 'Gold',
                'discount_percentage' => 10,
            ],
        ];
    }
}
