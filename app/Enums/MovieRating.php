<?php

namespace App\Enums;

enum MovieRating: string
{
    case G = 'G';
    case PG = 'PG';
    case PG_13 = 'PG-13';
    case R = 'R';
    case TV_G = 'TV-G';
    case TV_PG = 'TV-PG';
    case TV_14 = 'TV-14';
    case TV_MA = 'TV-MA';
}
