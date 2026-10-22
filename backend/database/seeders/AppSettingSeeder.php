<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'home_carousel_interval' => '5',
            'support_developer_url' => 'https://example.com/support',
            'share_app_url' => 'https://example.com/charghatblood',
            'admin_domain' => 'cblood.cc.cd',
        ];

        foreach ($settings as $key => $value) {
            AppSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
