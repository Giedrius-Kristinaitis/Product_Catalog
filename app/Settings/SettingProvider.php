<?php

namespace App\Settings;

interface SettingProvider
{

    /**
     * Gets a setting
     *
     * @param string $name Name of the setting
     * @return mixed
     */
    public function getSetting(string $name);
}