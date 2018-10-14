<?php
class Database{
    private $db_name = 'cue-test';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_host = 'localhost';
    private $_link;

    function __construct(){
        $this ->_link = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
        if ( mysqli_connect_errno() ) {
            printf("Connection failed: %s", mysqli_connect_error());
            exit();
        }
    }

    private function getLink(){
        return $this->_link ;
    }

    function getSkills(){
        $conn = $this->getLink();
        $sql = "SELECT skills.title as skill, skills.id as id, skills.category_id, skill_categories.title as category FROM skills LEFT JOIN skill_categories ON skills.category_id = skill_categories.id";
        $ret = array();
        if($result = $conn->query($sql)){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $ret[$row['category']][] = $row;
                }
                $result->free();
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
        return $ret;
    }

    function getUserDetails($user_id){
        $conn = $this->getLink();
        $user_id = $conn->real_escape_string($user_id);
        $sql = "SELECT * FROM users where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        if($result = $stmt->get_result()){
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $result->free();
            } else{
                echo "<h2> 404 </h2>";
                exit;
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
        $stmt->close();
        return $row;
    }

    function getAllUsers(){
        $conn = $this->getLink();
        $sql = "SELECT * FROM users";
        $ret = array();
        if($result = $conn->query($sql)){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $ret[] = $row;
                }
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
        return $ret;
    }

    function getUserSkills($user_id){
        $conn = $this->getLink();
        $user_id = $conn->real_escape_string($user_id);
        $ret = array();
        $sql = "SELECT skills.title as skill,skills.id as skill_id, user_skills.id as id, skills.category_id, skill_categories.title as category, user_skills.marks FROM user_skills JOIN skills ON user_skills.skill_id = skills.id JOIN skill_categories ON skills.category_id = skill_categories.id WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        if($result = $stmt->get_result()){
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $ret[$row['category']][] = $row;
                }
                $result->free();
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . $conn->error;
        }
        $stmt->close();
        return $ret;
    }

    public function saveUser($data){
        $conn = $this->getLink();
        $sql = "INSERT INTO users (first_name, last_name, email, city, state, zip, phone,  street) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $city = $data['city'];
        $street = $data['street'];
        $zip = $data['zip'];
        $state = $data['state'];
        $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $city, $street, $zip, $state);
        $stmt->execute();
        $stmt->close();
        $user_id = $conn->insert_id;
        if($user_id){
            foreach($data['skills'] as $key=>$skill){
                if($skill['skill']){
                    $user_skill['user_id'] = $user_id;
                    $user_skill['skill_id'] = $skill['skill'];
                    $user_skill['marks'] = $skill['marks'];
                    $this->saveUserSkill($conn, $user_skill);
                }
            }
            return true;
        }
    }
     function saveUserSkill($conn, $data){
        $sql = "INSERT INTO user_skills (user_id, skill_id, marks) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $user_id =  $data['user_id'];
        $skill_id = $data['skill_id'];
        $marks = $data['marks'];
        $stmt->bind_param("iii", $user_id, $skill_id, $marks);
        $stmt->execute();
        $stmt->close();
    }
}
?>