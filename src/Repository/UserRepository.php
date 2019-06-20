<?php
namespace App\Repository;

use App\Entity\User;
use App\Utilities\Database;
use App\Utilities\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public const TABLE_NAME = 'app_user';
    public const ENTITY_NAME = User::class;
}
