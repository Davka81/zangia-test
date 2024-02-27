<?php
class Misc extends Session
{
  /*
	* @param string $password
	*/
  function passwordHash($password)
  {
    return password_hash(trim($password), PASSWORD_BCRYPT, ['cost' => 12]);
  }

  function clear_post()
  {
    unset($_POST);
  }

  function get_current_page()
  {
    global $menu;
    foreach ($menu as $i) {
      if ($_SERVER['REQUEST_URI'] == "/page/{$i['url']}") {
        return $i['title'];
      }
    }
  }

  /*
	* @param array $file
  * @param string $type
	*/
  function upload_file(array $file, string $type)
  {
    global $_basedir;
    echo '<pre>';
    print_r($file);
    echo '</pre>';
    $upload_dir = '/public/img/uploads/';
    $upload_file = $_basedir. $upload_dir . basename($file["name"]);
    echo $upload_file;
    $fileType = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

    // Check image
    if ($type === 'image') {
      $check = getimagesize($file["tmp_name"]);
      if ($check === false) {
        return ["error" => 1, "message" => "File is not an image"];
      }

      if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
        return ["error" => 1, "message" => "Sorry, only JPG, JPEG, PNG files are allowed."];
      }
    }

    // Check file exists
    if (file_exists($upload_file)) {
      return ["error" => 1, "message" => "File already exists."];
    }

    // Check file size
    if ($file["size"] > 500000) {
      return ["error" => 1, "message" => "File is too large."];
    }

    // Upload file
    if (move_uploaded_file($file["tmp_name"], $upload_file)) {
      return ["error" => 0, "message" => $file['name']];
    } else {
      return ["error" => 1, "message" => "Sorry, there was an error upload process"];
    }
  }
}
