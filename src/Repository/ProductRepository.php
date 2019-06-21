<?php
namespace App\Repository;

use App\Entity\Produit;
use App\Utilities\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    /**
     * @return string
     */
    protected function tableName(): string
    {
        return 'produit';
    }

    /**
     * @return string
     */
    protected function entityName(): string
    {
        return Produit::class;
    }
}
