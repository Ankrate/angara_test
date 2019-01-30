<?php
class InterviewClass extends MyDb {

    public $table;

    public function get_interview() {
        $m = $this -> db();
        $q = "SELECT m.*,s.id as sid, s.score  FROM " . $this -> table . " as m
        LEFT JOIN admin_interview_score as s
        ON m.interview_score = s.id
         WHERE m.status = '0' 
         ORDER BY invite_date DESC";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }
    
    public function get_interview_archive() {
        $m = $this -> db();
        $q = "SELECT * FROM " . $this -> table . " WHERE status = '1' ";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    public function get_interview_men($people_id) {
        $m = $this -> db();
        $q = "SELECT * FROM " . $this -> table . " WHERE id = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($people_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    public function get_tasks($people_id) {
        $m = $this -> db();
        $q = "SELECT t.*,s.id as status_id, s.task_name, p.name FROM admin_interview_tasks as t
        LEFT JOIN admin_task_status as s
        ON t.status_id=s.id
        LEFT JOIN admin_interviews_people as p
        ON t.people_id = p.id
        WHERE people_id = ? AND is_done <> 1";
        $t = $m -> prepare($q);
        $t -> execute(array($people_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }
    
    //Выибираю опции задач
    
    public function get_status() {
        $m = $this -> db();
        $q = "SELECT * FROM admin_task_status";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }
    //Выбираем оцнку кандидата
    public function get_score() {
        $m = $this -> db();
        $q = "SELECT * FROM admin_interview_score ORDER BY id DESC";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    public function get_tasks_schedule($start, $end) {
        $m = $this -> db();
        $q = "SELECT t.*,s.id as status_id, s.task_name FROM admin_interview_tasks as t
        LEFT JOIN admin_task_status as s
        ON t.status_id=s.id
        WHERE is_done <> 1 AND task_timestamp BETWEEN :start AND :end";
        $t = $m -> prepare($q);
        $t -> execute(array(':start' => $start, ':end' => $end));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    //считаем просроченные задачи для бокового меню

    public function get_tasks_expired() {
        $m = $this -> db();
        $q = "SELECT t.*,s.id as status_id, s.task_name FROM admin_interview_tasks as t
        LEFT JOIN admin_task_status as s
        ON t.status_id=s.id
        WHERE is_done <> 1 AND task_timestamp < NOW() ";
        $t = $m -> prepare($q);
        $t -> execute(array());
        //$data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $data = $t -> rowCount();
        //p( $data);
        return $data;
    }

    //Получаем все просроченные задачи
    public function get_tasks_expired2() {
        $m = $this -> db();
        $q = "SELECT a.*, b.name, b.id as man_id, s.id as status_id, s.task_name FROM admin_interview_tasks as a
        LEFT JOIN admin_interviews_people as b
        ON a.people_id = b.id
        LEFT JOIN admin_task_status as s
        ON a.status_id = s.id      
        WHERE a.is_done <> '1' AND a.task_timestamp < NOW() ";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    //Получаем все не просроченные задачи
    public function get_tasks_not_expired() {
        $m = $this -> db();
        $q = "SELECT a.*, b.name, b.id as man_id, s.id as status_id, s.task_name FROM admin_interview_tasks as a
        LEFT JOIN admin_interviews_people as b
        ON a.people_id = b.id
        LEFT JOIN admin_task_status as s
        ON a.status_id = s.id        
        WHERE a.is_done <> '1' AND a.task_timestamp > NOW() ";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    public function edit_form_select($id) {
        $m = $this -> db();
        $q = "SELECT a.*, b.name, b.id as man_id, s.id as status_id, s.task_name FROM admin_interview_tasks as a
        LEFT JOIN admin_interviews_people as b
        ON a.people_id = b.id
        LEFT JOIN admin_task_status as s
        ON a.status_id = s.id         
        WHERE a.id= ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data[0];
    }

    public function task_insert($array) {
        $m = $this -> db();
        if (!isset($array['is_done'])) {
            $array['is_done'] = 0;
        } else {
            $array['is_done'] = 1;
        }
        $q = "INSERT INTO " . $this -> table . "
        (
        id,
        people_id,
        status_id,
        task_decsription,
        task_timestamp,
        is_done
        ) VALUES (
        :id,
        :people_id,
        :status_id,
        :task_decsription,
        :task_timestamp,
        :is_done
        )
        ON DUPLICATE KEY UPDATE
        id = :id,
        people_id = :people_id,
        status_id = :status_id,
        task_decsription = :task_decsription,
        task_timestamp = :task_timestamp,
        is_done = :is_done
        ";
        $t = $m -> prepare($q);
        if ($t -> execute(array(':id' =>(int)$array['task_id'], ':people_id' => $array['people_id'], ':status_id' => $array['task_name'], ':task_decsription' => $array['task_description'], ':task_timestamp' => date('Y-m-d H:i', strtotime($array['task_timestamp'])), ':is_done' => $array['is_done'])))
            return true;
    }

    public function task_update($array) {
        $m = $this -> db();
        if (!isset($array['is_done'])) {
            $array['is_done'] = 0;
        } else {
            $array['is_done'] = 1;
        }
        $q = "UPDATE " . $this -> table . "
        SET
        people_id = :people_id,
        status_id = :status_id,
        task_decsription = :task_decsription,
        task_timestamp = :task_timestamp,
        is_done = :is_done
        WHERE id = :id
        ";
        $t = $m -> prepare($q);
        if ($t -> execute(array(':people_id' => $array['people_id'], ':status_id' => $array['task_name'], ':task_decsription' => $array['task_description'], ':task_timestamp' => date('Y-m-d H:i', strtotime($array['task_timestamp'])), ':is_done' => $array['is_done'], ':id' => $array['task_id'])))
            return true;
    }

    //Проверяем если тип задачи отказ то убираем человека из списка
    private function check_task($id) {
        $m = $this -> db();
        $q = "SELECT status_id FROM admin_interview_tasks WHERE people_id = ? AND  status_id=4 LIMIT 1";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        // p( $data);
        return $data;
    }

    public function task_update_done($array) {
        $m = $this -> db();
        if ($this -> check_task($array['people_id'])) {
            echo 'works';
            $this -> task_update_done_people($array['people_id']);
        }

        $q = "UPDATE " . $this -> table . "
        SET
        is_done = :is_done
        WHERE id = :id
        ";
        $t = $m -> prepare($q);
        if ($t -> execute(array(':is_done' => $array['is_done'], ':id' => $array['task_id'])))
            return true;
    }

    public function task_update_done_people($id) {
        $m = $this -> db();

        $q = "UPDATE admin_interviews_people
        SET
        status = 1
        WHERE id = :id
        ";
        $t = $m -> prepare($q);
        if ($t -> execute(array(':id' => $id)))
            return true;
    }

    public function insert_people($array) {
        $m = $this -> db();
        p($array['people_tel']);
        $array['people_tel'] = preg_replace('/[^0-9]/','',$array['people_tel']);
        $array['people_tel'] = preg_replace('/^8/','7',$array['people_tel']);
        
        $q = "INSERT INTO `admin_interviews_people`
        (
        `id`,
        `name`,
        `vacancy`,
        `tel`,
        `email`,
        `interview_score`,
        `interview_desc`,
        `interview_conclusion`,
        `responsible_id`,
        `file_resume`,
        `status`,
        `resume_sourse`
         ) 
         VALUES
         (
        :id,
        :name,
        :vacancy,
        :tel,
        :email,
        :interview_score,
        :interview_desc,
        :interview_conclusion,
        :responsible_id,
        :file_resume,
        :status,
        :resume_sourse
         )
         ON DUPLICATE KEY UPDATE
         `id` = :id,
        `name` = :name,
        `vacancy` = :vacancy,
        `tel` = :tel,
        `email` = :email,
        `interview_score` = :interview_score,
        `interview_desc` = :interview_desc,
        `interview_conclusion` = :interview_conclusion,
        `responsible_id` = :responsible_id,
        `file_resume` = :file_resume,
        `status` = :status,
        `resume_sourse` = :resume_sourse
         ";

         $t = $m -> prepare($q);
         $status = $t -> execute(array(
        ':id' => $array['people_id'],
        ':name' => $array['people_name'],
        ':vacancy' => $array['vacancy'],
        ':tel' => $array['people_tel'],
        ':email' => $array['people_email'],
        ':interview_score' => $array['people_score'],
        ':interview_desc' => $array['people_desc'],
        ':interview_conclusion' => $array['people_conclusion'],
        ':responsible_id' => $array['manager_id'],
        ':file_resume' => $array['people_resume'],
        ':status' => $array['people_status'],
        ':resume_sourse' => $array['resume_sourse']));
        if($status){
            return true;
        }
    }
    public function search_phone($search) {
        $m = $this -> db();
        $q = "SELECT id, invite_date, name, tel, interview_score, interview_conclusion FROM " . $this -> table . " WHERE tel LIKE ? ";
        $t = $m -> prepare($q);
        $t -> execute(array('%' . $search . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }
    
    public function search_main($search) {
        $m = $this -> db();
        $q = "SELECT m.id, m.invite_date, m.name, m.tel, m.interview_score, m.interview_conclusion, m.status, s.score, s.id as sid FROM " . $this -> table . " as m
        LEFT JOIN admin_interview_score as s
        ON m.interview_score = s.id
        WHERE tel LIKE :search OR name LIKE :search ";
        $t = $m -> prepare($q);
        $t -> execute(array(':search'=> '%' . $search . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

public function count_resume() {
        $m = $this -> db();
        $q = "SELECT COUNT(id) as rows  FROM " . $this -> table ;
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data[0];
    }

}
