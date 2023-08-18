<?php

namespace App\Models\Enums;

enum CommentStatus: string
{
    case AWAITING_MODERATION = 'AWAITING_MODERATION';
    case APPROVED = 'APPROVED';
    case DENIED = 'DENIED';
}
