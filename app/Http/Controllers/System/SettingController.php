<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\FileUploads\ExistingFile;
use Artisan;

// Models
use App\Models\System\Setting;

class SettingController extends Controller
{
    protected function changeEnvironment($key, $value = null)
    {
        try {
            $path = base_path('.env');

            // Abort if environment file does not exist
            abort_if(!file_exists($path), 503, "Cannot get config file.");

            // Return false if there is no key on environment
            if (!str_contains(file_get_contents($path), $key)) return false;
            
            $file_content = file_get_contents($path);

            // Find environment in .env files
            $current_environment = collect(explode("\n", $file_content))
                ->filter(function($env_key) use($key) {
                    $needle = explode("=", $env_key);
                    
                    $current_key = isset($needle[0]) ? $needle[0] : false;
                    $current_value = isset($needle[1]) ? $needle[1] : false;
                    
                    return $current_key === $key;
                })
                ->map(function($env_key) {
                    $needle = explode("=", $env_key);
                    
                    $current_key = isset($needle[0]) ? $needle[0] : false;
                    $current_value = isset($needle[1]) ? $needle[1] : false;

                    return collect(['key' => $current_key, 'value' => $current_value]);
                })
                ->first();
            
            // If not found the environment, return false
            if (!$current_environment) return false;

            $current_key = $current_environment['key'];
            $current_value = $current_environment['value'];

            // If current environment is same as the setup, return true
            if ($value === str_replace('"', '', $current_value)) return true; 
            
            // Replace the environment value based on key
            file_put_contents($path, str_replace(
                $current_key . '=' . $current_value, $key . '="' . $value .'"', file_get_contents($path)
            ));

            // Call Laravel Artisan optimize to take the effect of changing environment
            Artisan::call('optimize');
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $settings = Setting::select(['key', 'title', 'description', 'has_translation', 'value'])
            ->get()
            ->map(function($setting) {
                if ($setting->value && in_array($setting->key, ['APP_LOGO', 'APP_ICON'])) {
                    $setting->value = ExistingFile::fromDisk('public')->get($setting->value);
                }
                return $setting;
            });
        $prices = collect([]);
        $taxes = collect([]);
        
        return view('system.settings.edit', compact('settings', 'prices', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $settings = Setting::get();

            \DB::transaction(function () use($settings, $request) {
                foreach ($settings as $key => $setting) {
                    $inputValue = $request[$setting->key];
                    
                    if ($request->hasFile($setting->key)) {
                        $file = $request->file($setting->key);
                        if (!$file->isValid()) throw new \Exception("Invalid file entered.");
                        
                        $inputValue = $file->storePublicly(
                            'img/application', 'public'
                        );
            
                        if ($setting->value) {
                            Storage::disk('public')->delete($setting->value);
                        }
                    } elseif (isset($request[$setting->key . '_existing'])) {
                        $inputValue = $setting->value;
                    }

                    $setting->value = $inputValue;
                    $setting->save();

                    $this->changeEnvironment($setting->key, $setting->value);
                }
            });

            return redirect()->route('dashboard.index');
        } catch (\Exception $e) {
            dd($e);
            // return redirect()->route('settings.edit')->with('errors', 'settings-failed');
        }
    }
}
