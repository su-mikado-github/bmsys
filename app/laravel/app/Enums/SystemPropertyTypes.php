<?php
namespace App\Enums;

enum SystemPropertyTypes : int {
    case STRING = 0;
    case TEXT = 1;

    case INTEGER = 2;

    case DOUBLE = 3;

    case DATE = 4;

    case JSON = 5;
}

