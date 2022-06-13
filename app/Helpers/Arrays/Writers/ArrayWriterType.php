<?php

namespace App\Helpers\Arrays\Writers;

enum ArrayWriterType: string
{
    case ToFile = 'ArrayToFile';
    case ToMYSQL = 'MysqlWriter';
}
