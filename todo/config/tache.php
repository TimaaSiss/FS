<?php

class Task {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }


    public function createTask($user_id, $task_name,) {
        try {
            $stmt = $this->db->prepare("INSERT INTO taches (user_id, task_name) VALUES (?, ?)");
            $stmt->execute([$user_id, $task_name,]);
            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la création de la tâche : ' . $e->getMessage());
        }
    }
    public function getTaskById($taskId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM taches WHERE id = :task_id");
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération de la tâche : ' . $e->getMessage());
        }
    }


    public function getTaskByIdAndUser($taskId, $userId) {
        try {
            // Récupérer la tâche de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT * FROM taches WHERE id = :task_id AND user_id = :user_id");
            $stmt->bindParam(':task_id', $taskId);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération de la tâche : ' . $e->getMessage());
        }
    }

    public function getTasks($userId) {
        try {
            // Récupérer les tâches de l'utilisateur depuis la base de données
            $stmt = $this->db->prepare("SELECT * FROM taches WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des tâches : ' . $e->getMessage());
        }
    }
    

    public function updateTaskName($taskId, $taskName, $newstatus = "") {
        try {
            if (!empty($newstatus)) {

                  // Mettre à jour le statut de la tache de l'utilisateur dans la base de données
                  $stmt = $this->db->prepare("UPDATE taches SET task_name = :taskname,  status = :status WHERE id = :id");
                  $stmt->bindParam(':status', $newstatus);
             
        } else {
            // Si aucune tache n'a été fourni, mettre à jour uniquement le nom de la tache 
            $stmt = $this->db->prepare("UPDATE taches SET task_name = :taskname WHERE id = :id");
        }            
            $stmt->bindParam(':taskname', $taskName);
            $stmt->bindParam(':id', $taskId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour de la tâche : ' . $e->getMessage());
        }
    }

   
    

    public function getLastTask($userId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM taches WHERE user_id = :user_id ORDER BY id DESC LIMIT 1");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $lastTask = $stmt->fetch();

            return $lastTask ? $lastTask : null;
        } catch (PDOException $e) {
            die('Erreur lors de la récupération de la dernière tâche de l\'utilisateur : ' . $e->getMessage());
        }
    }
    public function updateTaskStatus($taskId, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE taches SET status = :status WHERE id = :task_id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':task_id', $taskId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du statut de la tâche : ' . $e->getMessage());
        }
    }

    public function deleteTask($taskId) {
        try {
            // Supprimer la tâche de la base de données
            $stmt = $this->db->prepare("DELETE FROM taches WHERE id = :task_id");
            $stmt->bindParam(':task_id', $taskId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la suppression de la tâche : ' . $e->getMessage());
        }
    }

    public function markTaskAsCompleted($taskId) {
        try {
            $stmt = $this->db->prepare("UPDATE taches SET status = 'completed' WHERE id = :task_id");
            $stmt->bindParam(':task_id', $taskId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du statut de la tâche : ' . $e->getMessage());
        }
    }

  
  

    public function getCompletedTasks($user_id) {
        try {
            // Compter le nombre de tâches terminées pour l'utilisateur spécifié
            $stmt = $this->db->prepare("SELECT COUNT(*) AS completed_tasks FROM taches WHERE user_id = ? AND status = 'completed'");
            $stmt->execute([$user_id]);
            $completed_tasks = $stmt->fetchColumn();

            return $completed_tasks;
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des tâches terminées : ' . $e->getMessage());
        }
    }

    public function getRecentTasks($id, $limit = 5) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM taches WHERE user_id = :user_id ORDER BY id DESC LIMIT :limit");
            $stmt->bindParam(':user_id', $id);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des tâches récentes : ' . $e->getMessage());
        }
    }

     public function getAllTasks() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM taches");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des tâches : ' . $e->getMessage());
        }
    }
    


}

?>
