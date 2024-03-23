<?php

require_once __DIR__ . "/../classes/Database.php";
require_once __DIR__ . "/../classes/Task.php";

class TaskRepository extends Database
{
    public function create($newTask)
    {
        // Inserting the task
        $request = 'INSERT INTO Tdl_Task (nomTache, descriptionTache, dateTache, priorite, categorie, userID) VALUES (?, ?, ?, ?, ?, ?)';
        $query = $this->getDb()->prepare($request);
        // print_r($newTask);
        // die();
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
            $request = 'UPDATE Tdl_Task SET TaskID = :TaskID, getTaskTitle = :getTaskTitle, taskDescription = :taskDescription, taskDeadline = :taskDeadline, taskPriority , = :taskPriority ,taskCategory = :taskCategory  WHERE userID = :userID';

            $query = $this->getDb()->prepare($request);

            $query->execute([
                'taskID' => $task->getTaskID(),
                'getTaskTitle' => $task->getTaskTitle(),
                'taskDescription' => $task->getTaskDescription(),
                'taskDeadline' => $task->getTaskDeadline(),
                'taskPriority ,' => $task->getTaskPriority(),
                'taskCategory' => $task->getTaskCategory(),

            ]);
        }

        public function displayTask()
        {
            $data = $this->getDb()->query('SELECT * FROM todo_task' );

            $tasks = [];

            foreach ($data as $task) {
                $newTask = new Task (
                    $task['getTaskTitle'],
                    $task['taskDescription'],
                    $task['taskDeadline'],
                    $task['taskPriority'],
                    $task['taskCategory'],
                    $task['taskID'],
                );

                $tasks[] = $newTask;

            }

            return $tasks;
             
        }
        

        public function delete($taskID)
        {
            $request = 'DELETE FROM todo_task WHERE taskID = :taskID';

            $query = $this->getDb()->prepare($request);

            $query->execute([
                'taskID' => $taskID
            ]);
        }
    }
