<?php

namespace App\Settings;

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
        return setting($name);
    }
}