<?php
//include 'MyDb.php';
class ReportExtcutive extends MyDb {
    public $columns = array('manager_id', 'score_', 'score_val');
    public $table = 'report_executive';
    public $data;
    public $boss_id;

    public function insert_template() {
        $conn = $this -> db();
        $string_q = implode(',', $this -> columns);
        $count = count($this -> columns);
        $values = str_replace(',', ',:', $string_q);
        $values = preg_replace('/^/', ':', $values);
        $v = explode(',', $values);
        $sql = "INSERT INTO " . $this -> table . " ($string_q) VALUES (" . $values . ")";
        $co = 0;
        foreach ($this->data as $d) {
            $i = 0;
            foreach ($d as $dl) {
                $b[$v[$i]] = $dl;
                ++$i;
            }

            $q = $conn -> prepare($sql);
            $q -> execute($b);
            $co += $q -> rowCount();
        }
        echo 'inserted ' . $co . ' rows';
    }

    private function insert() {
        $conn = $this -> db();

        $sql = "INSERT INTO " . $this -> table . " (manager_id, score_id, score_val, boss_id) VALUES (:manager_id, :score_id, :score_val, :boss_id)";

        foreach ($this->data as $key => $d) {
            //array_unshift($d,$key);
            //$this -> p($d);
            $co = 0;
            foreach ($d as $keyin => $in) {
                $q = $conn -> prepare($sql);
                $q -> execute(array(':manager_id' => $key, ':score_id' => $keyin, ':score_val' => $in, ':boss_id' => $this -> boss_id));

            }
            $co += $q -> rowCount();
        }

        return TRUE;
    }

    public function check_report_insert() {
        $m = db();
        $q = 'SELECT id FROM ' . $this -> table . ' WHERE DATE(`date`) = CURDATE() AND boss_id = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($this -> boss_id));
        $count = $t -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            if ($this -> insert()) {
                $this -> send_mail();
            }
            return FALSE;
        }
    }

    public function get_score() {

        $m = db();
        $q = 'SELECT * FROM report_score ORDER BY id';
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public $headers;
    public $to = 'angara99@gmail.com';
    public $from = 'angara77@gmail.com';
    public $subject = 'Отчет руководителя отдела запчастей';
    public $manager;
    public $message;
    public $rolename;

    public function send_mail() {
        include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/insert/class.phpmailer.php');
        $mailto = 'angara99@gmail.com';
        $mailto1 = 'mikoolesya@gmail.com';
        $my_file = "angara.xls";
        //$my_path = __DIR__ . '/price/';
        $my_name = "Angara77";
        $my_mail = "angara77@gmail.com";
        $my_replyto = "angara77@gmail.com";
        $my_subject = 'Отчет ' . $this -> rolename;
        $my_message = "Отчет " . $this -> rolename . ' за ' . date('d-F-Y') . ' отправлен!';
        //mail_attachment($my_file, $my_path, $mailto, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
        //PHPMailer Object
        $mail = new PHPMailer;
        $mail -> CharSet = 'UTF-8';
        //From email address and name
        $mail -> From = "angara77@gmail.com";
        $mail -> FromName = "Angara77";

        //To address and name
        $mail -> addAddress("angara99@gmail.com", "Recepient Name");
        $mail -> addAddress($mailto1);
        //Recipient name is optional

        //Address to which recipient will reply
        $mail -> addReplyTo("angara77@gmail.com", "Reply");

        //CC and BCC
        //$mail->addCC($mail2);
        //$mail->addBCC("bcc@example.com");

        //Send HTML or Plain Text email
        $mail -> isHTML(true);

        $mail -> Subject = $my_subject;
        $mail -> Body = "<i>" . $my_message . "</i>";
        //$mail->AltBody = "This is the plain text version of the email content";
        //$mail -> AddAttachment($my_path . $my_file);

        if (!$mail -> send()) {
            //echo "Mailer Error: " . $mail -> ErrorInfo;
        } else {
            //echo "Message has been sent successfully";
        }
    }

    public function check_isset() {
        $m = db();
        $q = 'SELECT id FROM ' . $this -> table . ' WHERE DATE(`date`) = CURDATE()';
        $t = $m -> prepare($q);
        $t -> execute();
        $count = $t -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

    private function insert_goal() {
        $conn = $this -> db();
        $sql = "INSERT INTO " . $this -> table . " (user_id, goal) VALUES (:user_id, :goal)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':user_id' => $this -> data['user_id'], ':goal' => $this -> data['goal']));
        $co = $q -> rowCount();
        if($co > 0){
        return TRUE;
        }else{
            return FALSE;
        }
    }
    public function goal(){
        
        if(!$this->check_isset()){
            $this->insert_goal();
        }else{
            return FALSE;
        }
    }

}
