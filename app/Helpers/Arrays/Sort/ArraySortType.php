<?php

namespace App\Helpers\Arrays\Sort;

enum ArraySortType: string
{
    case Vertical = 'Vertical';
    case Horizontal = 'Horizontal';
    case Diagonal = 'Diagonal';
    case Snake = 'Snake';
    case Snail = 'Snail';
}
