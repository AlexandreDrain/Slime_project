<?php
namespace App\Utilities;

/**
 * Cette classe utilise PDO afin d'effectuer des opérations sur la BDD
 */
class Database
{
    /**
     * Instance de PDO
     * @var \PDO
     */
    private $pdo;

    /**
     * On crée un constructeur pour initialiser PDO automatiquement
     */
    public function __construct(string $dbName, string $dbUser, string $dbHost, ?string $dbPass = null)
    {
        // Connexion a la BDD
        $this->connect($dbName, $dbUser, $dbHost, $dbPass);
    }

    /**
     * Créer une instance de PDO
     */
    public function connect(string $dbName, string $dbUser, string $dbHost, ?string $dbPass = null): void
    {
        // Connexion à MySQL
        $this->pdo = new \PDO(
            'mysql:host=' . $dbHost . ';dbname=' . $dbName . ';charset=utf8mb4',
            $dbUser,
            $dbPass,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    /**
     * Exécute la requête SQL fournie et retourne un éventuel tableau
     * @param string $sql
     * @param string $className
     * @return array|null
     */
    public function query(string $sql, string $className): ?array
    {
        // Execution de la requête
        $result = $this->pdo->query($sql);
        // Récupération des résultats
        return $result->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $className);
    }

    /**
     * Prépare et exécute une requête préparé, protège contre les ingéction sql
     * @param  string      $sql       Requête SQL
     * @param  array       $params    Paramètres de la requête SQL
     * @param  string|null $className La classe servant à stocker les résultats
     * @return [type]                 Les données récupérées (ou rien du tout)
     */
    public function queryPrepared(string $sql, array $params, ?string $className = null): ?array
    {
        // Préparation de la requête SQL
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête SQL
        $statement->execute($params);
        // Retour des résultats
        return $statement->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, $className);
    }

    /**
     * Execute une requête SQL pour :
     * - La création (INSERT INTO)
     * - La modification (UPDATE)
     * - La suppression (DELETE, DROP)
     * @param string $sql
     * @return mixed
     */
    public function exec(string $sql)
    {
        return $this->pdo->exec($sql);
    }
}
