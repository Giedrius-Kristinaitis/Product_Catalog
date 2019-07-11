<?php

namespace App\Settings;

use QCod\AppSettings\Setting\AppSettings;

class AppSettingProvider implements SettingProvider
{

    /**
     * Gets an app setting
     *
     * @param string $name Name of the setting
     * @return mixed
     */
    public function getSetting(string $name)
    {
        return AppSettings::get($name);
    }
}