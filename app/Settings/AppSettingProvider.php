<?php

namespace App\Settings;

use phpDocumentor\Reflection\Types\Mixed_;
use QCod\AppSettings\Setting\AppSettings;

class AppSettingProvider implements SettingProvider
{

    /**
     * Gets an app setting
     *
     * @param string $name Name of the setting
     * @return Mixed_
     */
    public function getSetting(string $name): Mixed_
    {
        return AppSettings::get($name);
    }
}