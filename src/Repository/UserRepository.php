<?php
namespace App\Repository;

use App\Entity\User;
use App\Utilities\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * @return string
     */
    protected function tableName(): string
    {
        return 'app_user';
    }

    /**
     * @return string
     */
    protected function entityName(): string
    {
        return User::class;
    }
}
