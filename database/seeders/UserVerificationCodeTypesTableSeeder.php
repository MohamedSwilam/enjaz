<?php

namespace Database\Seeders;

use App\Modules\Authentication\Domain\Models\UserVerificationCodeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserVerificationCodeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types() as $type){
            $codeType = UserVerificationCodeType::where('id', $type['id'])->first();
            if (!$codeType){
                UserVerificationCodeType::create($type);
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
                'type' => 'Verify Email',
            ],
            [
                'id' => 2,
                'type' => 'Reset Password',
            ],
        ];
    }
}
