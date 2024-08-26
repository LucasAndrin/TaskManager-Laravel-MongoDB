<?php

namespace App\Enums;

enum TaskStatus: int
{
    case Pending = 1;
    case Progress = 2;
    case Stopped = 4;
    case Completed = 8;

    public function isPending(): bool
    {
        return $this === TaskStatus::Pending;
    }

    public function isProgress(): bool
    {
        return $this === TaskStatus::Progress;
    }

    public function isStopped(): bool
    {
        return $this === TaskStatus::Stopped;
    }

    public function isCompleted(): bool
    {
        return $this === TaskStatus::Completed;
    }
}
