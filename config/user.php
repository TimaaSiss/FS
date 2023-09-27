<?php

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($username, $email, $password)
    {
        try {
            // Vérifier si l'utilisateur existe déjà dans la base de données
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR mail = :email");
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


    public function authenticateUser($email, $password)
    {
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
    public function getUserbyId($user)
    {
        try {
            // Récupérer les informations de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT `id`,`username`,`mail`,`Roles`,`dateinscription` FROM user WHERE id = :username");
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

    public function getUserbyEmail($email)
    {
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

    public function deleteUser($userId)
    {
        try {
            // Préparez la requête SQL pour supprimer l'utilisateur
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

            // Exécutez la requête
            $stmt->execute();

            // Vérifiez si la suppression a réussi (rowCount renvoie le nombre de lignes affectées)
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Gérez les erreurs éventuelles lors de la suppression de l'utilisateur
            die('Erreur lors de la suppression de l\'utilisateur : ' . $e->getMessage());
        }
    }
    public function getTaskStatus($id)
    {
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




    public function updatePassword($userId, $hashedPassword)
    {
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

    public function getAllUsers()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des utilisateurs : ' . $e->getMessage());
        }
    }

    // Méthode pour récupérer tous les utilisateurs sauf l'administrateur
    public function getAllUsersExceptAdmin()
    {
        $query = "SELECT * FROM user WHERE id != :adminId";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':adminId', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function updateUser($userId, $newUsername, $newEmail, $newPassword = "")
    {
        try {
            // Vérifier si un nouveau mot de passe a été fourni
            if (!empty($newPassword)) {
                // Hasher le nouveau mot de passe
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Mettre à jour le mot de passe de l'utilisateur dans la base de données
                $stmt = $this->db->prepare("UPDATE user SET username = :username, mail = :email, motdepasse = :password WHERE id = :id");
                $stmt->bindParam(':password', $hashedPassword);
            } else {
                // Si aucun nouveau mot de passe n'a été fourni, mettre à jour uniquement le nom d'utilisateur et l'adresse e-mail
                $stmt = $this->db->prepare("UPDATE user SET username = :username, mail = :email WHERE id = :id");
            }

            // Liaison des paramètres
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':email', $newEmail);

            // Exécution de la requête
            $stmt->execute();

            // Vérifiez si la mise à jour a réussi (rowCount renvoie le nombre de lignes affectées)
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Gérer les erreurs éventuelles lors de la mise à jour de l'utilisateur
            die('Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
        }
    }

    public function updateUserRole($userId, $role)
    {
        try {
            // Vérifier que le rôle est valide (admin ou user)
            if ($role !== 'admin' && $role !== 'user') {
                throw new Exception('Rôle invalide.');
            }

            // Mettre à jour le rôle de l'utilisateur dans la base de données
            $stmt = $this->db->prepare("UPDATE user SET Roles = :role WHERE id = :user_id");
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            return 'true';
        } catch (Exception $e) {
            return ('Erreur : ' . $e->getMessage());
        }
    }
}
