<?php

namespace App\Utils\Url;

interface UrlGeneratorInterface
{
    /**
     * Generates a public URL for the given file
     *
     * @param $file_name
     * @return string
     */
    public function generatePublicUrl($file_name): string;
}