<?php

namespace App\Utils\Url;

class UrlGenerator implements UrlGeneratorInterface
{
    /**
     * Generates a public URL for the given file
     *
     * @param $file_name
     * @return string
     */
    public function generatePublicUrl($file_name): string
    {
        return asset('storage/' . $file_name);
    }
}