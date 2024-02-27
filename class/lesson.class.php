<?php
class Lesson extends Misc
{
  private $db;
  public $error = false;

  function __construct()
  {
    global $db;
    $this->db = $db;
  }

  function create()
  {
    $this->session_clear();
    $this->error = false;

    if (!empty($_POST)) {
      $name = $this->db->real_escape_string(trim($_POST['name']));

      $row = $this->db->query_select("lesson", "*", "name = '{$name}'");

      if ($row) {
        $this->error = true;
        $this->session_write('show_modal', 1);
        $this->session_write("title", "Error");
        $this->session_write("description", "A lesson with this name has been registered. Please choose name");

        return;
      }

      $res = $this->upload_file($_FILES['image'], 'image');

      if ($res['error'] == 1) {
        $this->error = true;
        $this->session_write('show_modal', 1);
        $this->session_write("title", "Error");
        $this->session_write("description", $res["message"]);

        return;
      }

      $data["name"] = trim($_POST['name']);
      $data["image"] = $res['message'];
      $data['owner'] = $this->session_read('user')['id'];

      $user = $this->db->query_insert("lesson", $data);
      if ($user) {
        $this->session_write('show_modal', 1);
        $this->session_write("title", "Success");
        $this->session_write("description", "Lesson Registration Complete");
        $this->session_write("click", "urlChange('/page/lessons.php')");

        return;
      }

      return;
    }
  }

  function read()
  {
    return $this->db->query_select('lesson', "*");
  }

  /*
	* @param int $id lesson id
	*/
  function get($id)
  {
    return $this->db->query_select('lesson', "*", "id='{$id}'");
  }

  function register()
  {
    $this->session_clear();
    $this->error = false;
    if (!empty($_POST)) {
      $email = trim($_POST['email']);
      $row = $this->db->query_select("users", "*", "email = '{$email}'");

      if ($row) {
        $this->error = true;
        $this->session_write("title", "Error");
        $this->session_write("description", "Your {$email} already registered. Please choose another email or reset you password using current email");

        return;
      }

      $phone = trim($_POST['phone']);
      $row = $this->db->query_select("users", "*", "phone = '{$phone}'");

      if ($row) {
        $this->error = true;
        $this->session_write("title", "Error");
        $this->session_write("description", "Your {$phone} already registered. Please choose another phone number or reset you password.");

        return;
      }

      if (trim($_POST["password"]) != trim($_POST["password-repeat"])) {
        $this->error = true;
        $this->session_write("title", "Error");
        $this->session_write("description", "Your password is not same");

        return;
      }

      unset($_POST["password-repeat"]);
      $_POST["role"] = 2;
      $user = $this->db->query_insert("users", $_POST);
      if ($user) {
        $this->session_write("title", "Success");
        $this->session_write("description", "Your Registration Complete");
        $this->session_write("click", "urlChange('/')");

        return;
      }

      $this->error = true;
      $this->session_write("title", "Error");
      $this->session_write("description", "We can not register you. Please try again later");
      $this->session_write("click", "urlChange('/')");

      return;
    }

    return;
  }

  function forget()
  {
    $this->session_clear();
    if (!empty($_POST)) {
    }
  }

  /*
	* @param bool $is_admin check page permission
	*/
  function check_login_permission(bool $is_admin = false)
  {
    $this->session_clear();
    $logged_user = $this->session_read('user');
    if (!$logged_user) {
      header("Location: /");
    }

    if ($is_admin && $logged_user['role'] != 1) {
      $this->error = true;
      $this->session_write('title', 'Access Deniad');
      $this->session_write('description', 'You do not have permission');
      $this->session_write('click', 'urlChange(\'/page/dashboard.php\')');
    }
  }
}
