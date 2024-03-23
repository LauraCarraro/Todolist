<?php
    
    require_once __DIR__ . "/../Classes/Database.php";
    require_once __DIR__ . "/../Classes/User.php";

    class userRepository extends Database
    {
        public function create($newUser)
        {
            $request = 'INSERT INTO tdl_user (userID, nom, prenom, email, motdepasse)
             VALUES (:userID, :nom, :prenom, :email, :motdepasse)';
            $query = $this->getDb()->prepare($request);

            $query->execute([
                'userID' => $newUser->getID(),
                'nom' => $newUser->getNom(),
                'prenom' => $newUser->getPrenom(),
                'email' => $newUser->getEmail(),
                'motdepasse' => $newUser->getMotdepasse(),
            ]);
        }
  
        public function update($user)
        {
            $request = 'UPDATE tdl_user SET nom = :nom, prenom = :prenom, email = :email, motdepasse = :motdepasse  WHERE userID = :userID';

            $query = $this->getDb()->prepare($request);

            $query->execute([
                'userID'=>$user->getUserID(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'motdepasse' => $user->getMotdepasse(),

            ]);
        }

        public function delete($userID)
{
    // Assuming $_SESSION['user'] holds the userID
    $request = 'DELETE FROM tdl_user WHERE userID = :userID';

    $query = $this->getDB()->prepare($request);

    $query->execute([
        'userID' => $_SESSION['user'] 
    ]);
}

    }