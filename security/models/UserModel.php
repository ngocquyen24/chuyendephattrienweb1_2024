<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {

    public function findUserById($id) {
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $user = $this->select($sql);

        return $user;
    }

    public function findUser($keyword) {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %'.$keyword.'%'. ' OR user_email LIKE %'.$keyword.'%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password) {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "'.$md5Password.'"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        return $this->delete($sql);

    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input) {
        $errors = $this->validateInput($input);
    
        // Nếu có lỗi, trả về mảng lỗi
        if (!empty($errors)) {
            return $errors;
        }
    
        // Nếu không có lỗi, thực hiện cập nhật
        $sql = 'UPDATE users SET 
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
                 password="'. md5($input['password']) .'"
                WHERE id = ' . intval($input['id']); // Chuyển đổi ID thành số nguyên để bảo mật
    
        return $this->update($sql);
    }
    
    private function validateInput($input) {
        $errors = [];
    
        // Validate name
        if (empty($input['name'])) {
            $errors['name'] = "Tên không được để trống."; // Bắt buộc nhập
        } elseif (!preg_match('/^[A-Za-z0-9]{5,15}$/', $input['name'])) {
            $errors['name'] = "Tên phải từ 5 -> 15 kí tự bao gồm A-Z, a-z, 0-9.";
        }
    
        // Validate password
        if (empty($input['password'])) {
            $errors['password'] = "Mật khẩu không được để trống."; // Bắt buộc nhập
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[~!@#$%^&*()])[A-Za-z\d~!@#$%^&*()]{5,10}$/', $input['password'])) {
            $errors['password'] = "Mật khẩu phải từ 5-10 kí tự bao gồm: chữ thường (a-z), chữ HOA (A-Z), số (0-9) và ký tự đặc biệt ~!@#$%^&*()"; // Yêu cầu về mật khẩu
        }
    
        return $errors;
    }
    
    

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input) {
        $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`) VALUES (" .
                "'" . $input['name'] . "', '".md5($input['password'])."')";

        $user = $this->insert($sql);

        return $user;
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    // public function getUsers($params = []) {
    //     //Keyword
    //     if (!empty($params['keyword'])) {
    //         $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';

    //         //Keep this line to use Sql Injection
    //         //Don't change
    //         //Example keyword: abcef%";TRUNCATE banks;##
    //         $users = self::$_connection->multi_query($sql);

    //         //Get data
    //         $users = $this->query($sql);
    //     } else {
    //         $sql = 'SELECT * FROM users';
    //         $users = $this->select($sql);
    //     }

    //     return $users;
    // }
    public function getUsers($params = []) {
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE ?';
            $stmt = self::$_connection->prepare($sql);
            $keyword = '%' . $params['keyword'] . '%';
            $stmt->bind_param('s', $keyword);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $sql = 'SELECT * FROM users';
            return $this->select($sql);
        }
    }

    
}