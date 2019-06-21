<?php
namespace App\Utilities;

use App\Utilities\Database;

abstract class AbstractRepository
{
    /**
     * @var Database
     */
    protected $database;

    function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @var string
     */
    abstract protected function tableName();

    /**
     * @var string
     */
    abstract protected function entityName();

    /**
     * Récupère tous les enregistrements
     * ... de la table de produit
     * @return array
     */
    public function findAll(): array
    {
        // Requête SQL
        $query = "SELECT * FROM " . $this->tableName();
        // Exécution de ka requête SQL et récupération des produits
        return $this->database->query($query, $this->entityName());
    }

     /**
     * Prépare et exécute une requête préparée avec les paramètres fournis
     * @param array $params
     * @return array
     */
    public function findBy(array $params): array
    {
        $query = "SELECT * FROM ". $this->tableName();
        foreach ($params as $key => $param) {
            if ($key === \array_key_first($params)) {
                $query .= " WHERE " . $key . " = ?";
            } else {
                $query .= " AND " . $key . " = ?";
            }
        }
        return $this->database->queryPrepared($query, array_values($params), $this->entityName());
    }
}
