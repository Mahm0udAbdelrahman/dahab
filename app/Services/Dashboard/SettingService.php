<?php
namespace App\Services\Dashboard;

use App\Models\Setting;
use App\Traits\HasImage;

class SettingService
{
    use HasImage;
    public function setting()
    {
        return Setting::first();
    }

    public function update($data)
    {
        $setting = Setting::first();
        if (! $setting) {
            $setting = Setting::create($data);
        } else {

            $setting->update($data);
        }

        if (isset($data['logo'])) {
            $path          = $this->saveImage($data['logo'], 'setting/logo');
            $setting->logo = $path;
            $setting->save();
        }

        if (isset($data['favicon'])) {
            $path             = $this->saveImage($data['favicon'], 'setting/favicon');
            $setting->favicon = $path;
            $setting->save();
        }

        return $setting;
    }
}
