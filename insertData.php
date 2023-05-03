<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
echo "Insert Data";

$httpClient = new Client();
$url = "https://my.api.mockaroo.com/users_composer.json?key=cf1f4fc0";
$response = $httpClient->request('GET', $url, ['verify' => false]);

$users = json_decode($response->getBody());

class User{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $gender;
    private string $ip_address;

    // First Name
    public function getFirstname(): string{
        return $this->first_name;
    }

    public function setFirstname(string $firstname) :void{
        $this->first_name = $firstname;
    }

    //Last Name
    public function getLastname(): string{
        return $this->last_name;
    }

    public function setLastname(string $lastname) :void{
        $this->last_name = $lastname;
    }

    //Email
    public function getEmail(): string{
        return $this->email;
    }

    public function setEmail(string $email) :void{
        $this->email = $email;
    }

    //Gender
    public function getGender(): string{
        return $this->gender;
    }

    public function setGender(string $gender) :void{
        $this->gender = $gender;
    }

    //IP Address

    public function getIpAddress(): string{
        return $this->ip_address;
    }

    public function setIpAddress(string $ipaddress) :void{
        $this->ip_address = $ipaddress;
    }
}

dump($users);

class HandleUsers {

    public function saveUsersFromApi($users){
        $pdo = new PDO("mysql:host=localhost;dbname=composer_users;port=3306;charset=utf8", "admin", "admin");
        
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `gender`, `ip_address`) 
        VALUES (:first_name,:last_name,:email,:gender,:ip_address)";
        $stmt = $pdo->prepare($sql);
        $pdo->beginTransaction();
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
        $pdo->commit();
        
    }
}
$handleUsers = new HandleUsers();
$handleUsers->saveUsersFromApi($users);