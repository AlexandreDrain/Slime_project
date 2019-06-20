<?php
namespace App\Utilities;

use App\Utilities\Database;

abstract class AbstractRepository
{
    /**
     * @var Database
     */
    protected $database;

    /**
     * @var string
     */
    const TABLE_NAME = '';

    /**
     * @var string
     */
    const ENTITY_NAME = '';

    function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Récupère tous les enregistrements
     * ... de la table de produit
     * @return array
     */
    public function findAll(): array
    {
        // Requête SQL
        $query = "SELECT * FROM " . $this::TABLE_NAME;
        // Exécution de ka requête SQL et récupération des produits
        return $this->database->query($query, $this::ENTITY_NAME);
    }
}
