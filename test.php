<?php

$count = 0;

if (!empty($_POST['login'])){
  $login = $_POST['login'];
  // echo "1 $login";
  $count++;
};
if (!empty($_POST['password'])){
  $password = $_POST['password'];
  // echo "1 $password";
  $count++;
};
if (!empty($_POST['email'])){
  $email = $_POST['email'];
  // echo "1 $email";
  $count++;
};
if (!empty($_POST['number'])){
  $phone = $_POST['number'];
  // echo "1 $phone";
  $count++;
};
if (!empty($_POST['BirthDay'])){
  $BirthDay = $_POST['BirthDay'];
  // echo "1 $BirthDay";
  $count++;
};

if ($count == 5){

  if ($dh = opendir('json')){
    while (($file = readdir($dh)) !== false) 
    {
        if($file=='.' || $file=='..') continue;
        if(is_file($file)){
          if($file === $login.'.json'){
            continue;
          }else {
            $jsonFile = file_get_contents("json/$login.json");
            $jsonArray = json_decode($jsonFile,true);
          }
        };
    }
    closedir($dh);
  }

  if (is_file("json/$login.json")) {
    echo "<h1>Такой ник уже есть</h1>";
  }elseif ($jsonArray['email'] == $email) {
    echo "<h1>Такой имэйл уже зареган</h1>";
  }else{
    $jsonArr = ['login' => $login,'password' => $password, 'email' => $email, 'phone' => $phone, 'BirthDay' => $BirthDay];

    function putStr($Arr) {
      $jsonString = json_encode($Arr);
      $arrElem = $Arr['login'];
      $fd = fopen("$arrElem.json", 'w+');
      fputs($fd, $jsonString);
      fclose($fd);
      rename("$arrElem.json", "json/$arrElem.json");
    };  
    putStr($jsonArr);

    echo "<h1>Вы успешно зарегистрировались</h1>";
  }
  

}elseif ($count == 2){
  if (is_file("json/$login.json")) {
    $jsonFile = file_get_contents("json/$login.json");
    $jsonArray = json_decode($jsonFile,true);

    if ($jsonArray['password'] == $password){
      foreach ( $jsonArray as $i => &$elem ){
        if ($i == 'password'){
          continue;
        }else {
          setcookie("$i", "$elem");
        };
      };
    }else {
      echo "<h1>Пароль не правильный</h1>";
    };

  }else {
    echo '<h1>Нет такого аккаунта</h1>';
  };
};

?>

