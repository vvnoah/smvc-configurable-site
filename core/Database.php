<?php

/**
 * sMVC database class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */

namespace core;
use \PDO;
/**
 * Description of Database
 *
 * @author seger
 */
class Database {
    public \PDO $pdo;
    protected string $migrationPath;
    
    public function __construct($dbConfig = [])
    {
        $this->migrationPath = (Application::$ROOT_DIR . '\database\migrations\\');
        $dbDsn = 'mysql:host='.$dbConfig['host'].';port=3306;dbname='.$dbConfig['name'];
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';
        try{
            $this->pdo = new \PDO($dbDsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (\PDOException $e){
            echo "connection to the database could not be established" ;
            exit;
        }
    }
    
    public function migrate()
    {
        $this->createMigrationsTable();
        $migrated = $this->getExecutedMigrations();
        
        $newMigrations = [];
        $allMigrations = array_slice(scandir($this->migrationPath),2);
        $toMigrate = array_diff($allMigrations, $migrated);
        if (!empty($toMigrate)) {
            foreach ($toMigrate as $migration) {
                require_once $this->migrationPath.$migration;
                $filename = pathinfo($migration, PATHINFO_FILENAME);
                $classname = $this->getClassname($filename);
                $instance = new $classname();
                $this->showMessage("migrating $migration");
                $sql = $instance->up();
                try{
                    $this->pdo->exec($sql);
                    $this->showMessage("migrated $migration");

                    $this->saveMigrations($migration);

                }catch(PDOException $error) { 
                    $this->showMessage("There is an error in your migration code: ".$error->getMessage()); 
                }    

            }

        } else {
            $this->showMessage("There are no migrations to execute");
        }
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    protected function getExecutedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(string $newMigration)
    {
        //create string to insert
        //"('migration_file_name1'),('migration_file_name2'), ..."
        //$str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $str = "('".$newMigration."')";
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }
    
    protected function getClassname(string $functionname)
    {
        $parts = explode('_', $functionname);
        $classname = "";
        for ($partnum = 4;$partnum < count($parts);$partnum++ ){
            $classname .= ucfirst($parts[$partnum]);
        }
        return $classname;
    }
    
    protected function showMessage($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
    
   /**
     * Create a new migration in the database/migrations folder.
     *
     * @param  string  $migrationName
     * @return boolean
     *
     * @throws \InvalidArgumentException
     */
    public function createNewMigration($migrationName){
        $migrationClassName = $this->createMigrationClassName($migrationName);
        if($this->migrationAlreadyExist($migrationClassName)){
            return false;
        }
        $fileName = $this->getDatePrefix()."_".$migrationName.".php";
        $data = $this->migrationClassData($migrationClassName);
        file_put_contents($this->migrationPath.$fileName, $data);
        return $fileName;
    }
    /**
     * Ensure that a migration with the given name doesn't already exist.
     *
     * @param  string  $name
     * @param  string  $migrationPath
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function migrationAlreadyExist($migrationName)
    {
        if (! empty($this->migrationPath)) {
            $migrationFiles = array_slice(scandir($this->migrationPath),2);
            foreach ($migrationFiles as $migrationFile) {
                require_once($this->migrationPath.$migrationFile);
            }
        }
        
        if (class_exists($migrationName)) {
            return true;
        }
        return false;
    }
    
    /**
     * Get the date prefix for the migration.
     *
     * @return string
     */
    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }
    
    /**
     * creates UperCamelCase ClassName based on the migrations name.
     *
     * @return string
     */
    protected function createMigrationClassName($migrationName)
    {
        $migrationClassName = "";
        $migrationNameParts = explode("_",$migrationName);
        foreach($migrationNameParts as $part){
            $migrationClassName .= ucfirst($part);
        }
        return $migrationClassName;
    }    
    
    protected function migrationClassData($classname){
        $data = <<<EOF
        <?php

        /**
         * Description of $classname
         *
         */
        class $classname {
            public function up()
            {

            }
            public function down() {

            }
        }
        EOF;
        return $data;
    }
}
