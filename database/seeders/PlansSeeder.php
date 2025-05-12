<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

use function Pest\Laravel\json;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->mock() as $item) {
            $item['features'] = json_encode($item['features']);
            $item['is_active'] = true;
            Plan::factory()->create($item);
        }
    }

    public function mock(): array {
        $mock = <<<HE
            [
                {
                    "plan_name": "Basic",
                    "price": 10,
                    "features": {
                        "Storage": "10GB",
                        "Users": "1 User"
                    }
                },
                {
                    "plan_name": "Standard",
                    "price": 25,
                    "features": {
                        "Storage": "50GB",
                        "Support": "Email & Chat Support",
                        "Users": "Up to 5 Users"
                    }
                },
                {
                    "plan_name": "Premium",
                    "price": 50,
                    "features": {
                        "Storage": "200GB",
                        "Support": "Priority Support",
                        "Reports": "Daily",
                        "Users": "Unlimited Users"
                    }
                }
            ]
        HE;

        return json_decode($mock, true);
    }
}



