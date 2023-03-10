<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Master\Unit\{ Unit, UnitType };

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::transaction(function() {
            // Dissociate all units from their types
            $units = Unit::get();

            $units->each(function($unit) {
                $unit->type()->dissociate();
            });

            // Truncate Types Unit
            Schema::disableForeignKeyConstraints();
            UnitType::truncate();
            Schema::enableForeignKeyConstraints();

            $this->types()->map(function($type) {
                return UnitType::updateOrCreate(
                    ['name' => $type],
                    ['name' => $type]
                );
            });

            Unit::upsert(
                $this->units(),
                ['name'],
                ['description', 'type_id']
            );
        });
    }

    // Datas
    protected function types(): \Illuminate\Support\Collection
    {
        return collect(['Quantity', 'Length', 'Time', 'Ammount of Substance', 'Electric Current', 'Temperature', 'Luminous Intensity', 'Mass']);
    }

    protected function units(): array
    {
        return [
            [
                'name' => 'meter', 'code' => 'm', 'description' => 'Meter', 'type_id' => UnitType::where('name', 'Length')->first()->id
            ],
            [
                'name' => 'centimeter', 'code' => 'cm', 'description' => 'Centimeter', 'type_id' => UnitType::where('name', 'Length')->first()->id
            ],
            [
                'name' => 'kilogram', 'code' => 'kg', 'description' => 'Kilogram', 'type_id' => UnitType::where('name', 'Mass')->first()->id
            ],
            [
                'name' => 'gram', 'code' => 'g', 'description' => 'Gram', 'type_id' => UnitType::where('name', 'Mass')->first()->id
            ],
            [
                'name' => 'ons', 'code' => 'ons', 'description' => 'Ons', 'type_id' => UnitType::where('name', 'Mass')->first()->id
            ],
            [
                'name' => 'pieces', 'code' => 'pcs', 'description' => 'Pieces', 'type_id' => UnitType::where('name', 'Quantity')->first()->id
            ],
            [
                'name' => 'sack', 'code' => 'sack', 'description' => 'Sack', 'type_id' => UnitType::where('name', 'Quantity')->first()->id
            ],
            [
                'name' => 'rack', 'code' => 'rack', 'description' => 'Rack', 'type_id' => UnitType::where('name', 'Quantity')->first()->id
            ],
            [
                'name' => 'box', 'code' => 'box', 'description' => 'Box', 'type_id' => UnitType::where('name', 'Quantity')->first()->id
            ],
        ];
    }
}
