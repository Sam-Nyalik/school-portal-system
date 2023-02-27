<!-- Database Connection -->
function db_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASSWORD = '';
    $DATABASE_NAME = '';

    try {
        return new PDO("mysql:host=" .$DATABASE_HOST . "; dbname=" . $DATABASE_NAME . ";charset=utf-8", $DATABASE_USER, $DATABASE_PASSWORD);
    } catch (PDOException $exception){
        <!-- Stop the script and generate an error incase there's a problem -->
        exit("Connection to the database was unsuccessful" . $exception->getMessage());
    }
}