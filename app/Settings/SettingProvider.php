<?php

namespace App\Settings;

use phpDocumentor\Reflection\Types\Mixed_;

interface SettingProvider
{

    /**
     * Gets a setting
     *
     * @param string $name Name of the setting
     * @return Mixed_
     */
    public function getSetting(string $name): Mixed_;
}