<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\System\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key' => 'APP_NAME',
                'title' => 'Application Name',
                'description' => 'Set application name.',
                'has_translation' => true,
                'value' => 'Koperasi'
            ],
            [
                'key' => 'APP_LOGO',
                'title' => 'Application Logo',
                'description' => 'Set application logo.',
                'has_translation' => true,
                'value' => null
            ],
            [
                'key' => 'APP_ICON',
                'title' => 'Application Icon',
                'description' => 'Set application icon.',
                'has_translation' => true,
                'value' => null
            ],
            [
                'key' => 'KOPERASI_NAME',
                'title' => 'Name',
                'description' => 'Set koperasi name.',
                'has_translation' => true,
                'value' => "KOPKAMI"
            ],
            [
                'key' => 'KOPERASI_ADDRESS',
                'title' => 'Address',
                'description' => 'Set koperasi address.',
                'has_translation' => true,
                'value' => "Jalan Sekian No. 1"
            ],
            [
                'key' => 'KOPERASI_PHONE',
                'title' => 'Phone',
                'description' => 'Set koperasi phone.',
                'has_translation' => true,
                'value' => null
            ],
            [
                'key' => 'KOPERASI_FAX',
                'title' => 'Fax',
                'description' => 'Set koperasi fax.',
                'has_translation' => true,
                'value' => null
            ],
            [
                'key' => 'PRICE_DEFAULT_CURRENCY',
                'title' => 'Default Currency',
                'description' => 'Set koperasi price currency.',
                'has_translation' => true,
                'value' => "Rp"
            ],
            [
                'key' => 'PRICE_DEFAULT_TAX',
                'title' => 'Default Tax',
                'description' => 'Set koperasi tax.',
                'has_translation' => true,
                'value' => 10
            ],
        ];

        try {
            \DB::transaction(function () use($settings) {
                foreach ($settings as $key => $setting) {
                    if (isset($setting['key'])) {
                        $current_data = Setting::where(['key' => $setting['key']])->first();
                        
                        $data = $current_data ? $current_data : (new Setting);

                        if (!$data->id) $data->key = $setting['key'];

                        $data->fill([
                            'title' => $setting['title'],
                            'description' => $setting['description'],
                            'has_translation' => $setting['has_translation'],
                            'value' => $setting['value']
                        ]);

                        $data->save();
                    }
                }
            });
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
