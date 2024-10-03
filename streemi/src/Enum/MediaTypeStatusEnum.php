<?php
namespace App\Enum;
enum MediaTypeStatusEnum: string {
    case VALID = 'valid';
    case PENDING = 'pending';
    case BLOCKED = 'blocked';
    case BANNED = 'banned';
    case DELETED = 'deleted';
}
