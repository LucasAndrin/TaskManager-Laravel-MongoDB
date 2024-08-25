<?php

namespace App\Enums;

enum TaskStatus: int
{
    case Pending = 1;
    case Progress = 2;
    case Stopped = 4;
    case Completed = 8;
}
