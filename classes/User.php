<?php
class User {
        private $id;
        private $nom;
        private $prenom;
        private $email;
        private $password;
    
        public function __construct($id, $nom, $prenom, $email, $password)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->password = $password;
        }
    
        public function getId()
        {
            return $this->id;
        }
    
        public function getNom()
        {
            return $this->nom;
        }
    
        public function setNom($nom)
        {
            $this->nom = $nom;
        }
    
        public function getPrenom()
        {
            return $this->prenom;
        }
    
        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;
        }
    
        public function getEmail()
        {
            return $this->email;
        }
    
        public function setEmail($email)
        {
            $this->email = $email;
        }
    
        public function getPassword()
        {
            return $this->password;
        }
    
        public function setPassword($password)
        {
            $this->password = $password;
        }
    


        public function toAssociativeArray()
        {
            return [
                "id" => $this->id,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "email" => $this->email,
                "password" => $this->password,
            ];
        }
    }
