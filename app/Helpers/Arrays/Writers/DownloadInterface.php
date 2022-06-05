<?php

namespace App\Helpers\Arrays\Writers;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface DownloadInterface
{
    public function download(): StreamedResponse;
}
