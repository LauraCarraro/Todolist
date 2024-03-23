<?php

require_once __DIR__ . "/../classes/Database.php";
require_once __DIR__ . "/../classes/Task.php";

class taskRepository extends Database
{
    public function create($newTask)
    {
        // Inserting the task
        $request = 'INSERT INTO tdl_task (nomTache, descriptionTache, dateTache, priorite, categorie, userID) VALUES (?, ?, ?, ?, ?, ?)';
        $query = $this->getDb()->prepare($request);
        
        $query->execute([
            $newTask->getnomTache(),
            $newTask->getdescriptionTache(),
            $newTask->getdateTache(),
            $newTask->getpriorite(),
            $newTask->getcategorie(),
            $newTask->getuserID()
        ]);
        
    }


        public function update($task)
        {
            $request = 'UPDATE tdl_task SET TaskID = :TaskID, nomTache = :nomTache, descriptionTache = :descriptionTache, dateTache = :dateTache, priorite , = :priorite , categorie = :categorie  WHERE userID = :userID';

            $query = $this->getDb()->prepare($request);

            $query->execute([
                'TaskID' => $task->getID(),
                'NomTac' => $task->getnomTache(),
                'taskDescription' => $task->getdescriptionTache(),
                'taskDeadline' => $task->getdateTache(),
                'taskPriority ,' => $task->getpriorite(),
                'taskCategory' => $task->getcategorie(),

            ]);
        }
        

        public function delete($taskID)
        {
            $request = 'DELETE FROM tdl_task WHERE taskID = :taskID';

            $query = $this->getDb()->prepare($request);

            $query->execute([
                'taskID' => $taskID
            ]);
        }
    }
