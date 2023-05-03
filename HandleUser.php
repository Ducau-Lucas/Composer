<?php
require_once "User.php";


class HandleUsers {

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=composer_users;port=3306;charset=utf8", "admin", "admin");
        
    }
    
    /**
     * enregistre les données en bdd
     * @param array $users
     * @return void
     */

    public function saveUsersFromApi($users){
        
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `gender`, `ip_address`) 
        VALUES (:first_name,:last_name,:email,:gender,:ip_address)";
        $stmt = $this->pdo->prepare($sql);
        $this->pdo->beginTransaction();
        foreach ($users as $user) {
            $userInstance = new User();
            $userInstance->setFirstname($user->first_name);
            $userInstance->setLastname($user->last_name);
            $userInstance->setEmail($user->email);
            $userInstance->setGender($user->gender);
            $userInstance->setIpAddress($user->ip_address);
            $stmt->execute([
                ":first_name" => $userInstance->getFirstname(),
                ":last_name" => $userInstance->getLastname(),
                ":email" => $userInstance->getEmail(),
                ":gender" => $userInstance->getGender(),
                ":ip_address" => $userInstance->getIpAddress()
            ]);
        }
        $this->pdo->commit();
        
    }
}