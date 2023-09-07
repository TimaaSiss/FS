<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser($username, $email, $password) {
        try {
            // Vérifier si l'utilisateur existe déjà dans la base de données
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // L'utilisateur existe déjà
                return false;
            }

            // Hasher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insérer le nouvel utilisateur dans la base de données
            $stmt = $this->db->prepare("INSERT INTO user (username, mail, motdepasse) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
        }
    }


    public function authenticateUser($email, $password) {
        try {
            // Récupérer les informations de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT * FROM user WHERE mail = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['motdepasse'])) {
                // Le mot de passe est correct
                return true;
            } else {
                // L'utilisateur n'existe pas ou le mot de passe est incorrect
                return false;
            }
        } catch (PDOException $e) {
            die('Erreur lors de l\'authentification de l\'utilisateur : ' . $e->getMessage());
        }
    }
     public function getUserbyId($user) {
        try {
            // Récupérer les informations de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id = :username");
            $stmt->bindParam(':username', $user);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // L'utilisateur existe
                return $user;
            } else {
                // L'utilisateur n'existe pas
                return false;
            }
        } catch (PDOException $e) {
            die('Erreur lors de l\'authentification de l\'utilisateur : ' . $e->getMessage());
        }
    }

     public function getUserbyEmail($email) {
        try {
            // Récupérer les informations de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT * FROM user WHERE mail = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // L'utilisateur existe
                return $user;
            } else {
                // L'utilisateur n'existe pas
                return false;
            }
        } catch (PDOException $e) {
            die('Erreur lors de l\'authentification de l\'utilisateur : ' . $e->getMessage());
        }
    }
    public function getTaskStatus($id) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) AS total_tasks FROM taches WHERE user_id = ?");
            $stmt->execute([$id]);
            $total_tasks = $stmt->fetchColumn();

            $stmt = $this->db->prepare("SELECT COUNT(*) AS completed_tasks FROM taches WHERE user_id = ? AND status = 'completed'");
            $stmt->execute([$id]);
            $completed_tasks = $stmt->fetchColumn();

            $stmt = $this->db->prepare("SELECT COUNT(*) AS in_progress_tasks FROM taches WHERE user_id = ? AND status = 'in_progress'");
            $stmt->execute([$id]);
            $in_progress_tasks = $stmt->fetchColumn();

            return array(
                'total_tasks' => $total_tasks,
                'completed_tasks' => $completed_tasks,
                'in_progress_tasks' => $in_progress_tasks
            );
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des statistiques des tâches : ' . $e->getMessage());
        }
    }
    



    public function updatePassword($userId, $hashedPassword) {
        try {
            // Mettre à jour le mot de passe de l'utilisateur dans la base de données
            $stmt = $this->db->prepare("UPDATE user SET motdepasse = :hashed_password WHERE id = :user_id");
            $stmt->bindParam(':hashed_password', $hashedPassword);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du mot de passe de l\'utilisateur : ' . $e->getMessage());
        }
    }

    public function getAllUsers() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des utilisateurs : ' . $e->getMessage());
        }
    }

   



}

?>
