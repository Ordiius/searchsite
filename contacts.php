<!DOCTYPE html>
<html lang="en">
<head>
    <title>Контакти</title>
    <link rel="stylesheet" type="text/css" href="contacts.css">
</head>
<body>
<div class="menu-container" id="menu-container" data-menu>
        <nav>
          <ul class="menu">
            <li class="menu__item">
              <a href="index.html" class="menu__link">Пошук</a>
            </li>
            <li class="menu__item">
              <a href="info.html" class="menu__link">Можливості</a>
            </li>
            <li class="menu__item">
              <a href="pro.html" class="menu__link">Про створення</a>
            </li>
          </ul>
        </nav>
    </div>
<div class="contact" id="contact" data-menu>
    <nav>
      <li class="menu__item">
        <a href="contacts.php" class="menu__link menu__link--current">Напишіть нам!</a>
      </li>
    </nav>
</div>
    <form class="obratnuj-zvonok" autocomplete="off" action='email.php' method='post'>
        <div class="form-zvonok"> 
          <div>
            <label>Ім'я <span>*</span></label>
            <input type='text' name='username' required></div>
          <div>
            <label>Номер телефону (з кодом) <span>*</span></label>
            <input type='text' name='usernumber' required></div>
          <div>
            <label>Повідомлення</label>
            <input type='text' name='question'>
          </div>
          <input class="bot-send-mail" type='submit' value='Відправити'>
        </div>
        </form>
        <?php
        echo "<link rel='stylesheet' type='text/css' href='contacts.css'>";
  $to = "ordiusgd@gmail.com";
  $subject = "Тема повідомлення";
  $message = "Message, повідомлення!";
  $headers = "Content-type: text/plain; charset=utf-8 \r\n";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["username"])){
      $name =trim(strip_tags($_POST["username"]));
    }
    if(isset($_POST["usernumber"]))
    {
      $number   = trim(strip_tags($_POST["usernumber"]));
    }
    if (isset( $_POST["question"])) {
      $question   = trim(strip_tags($question));
    }
      $message  = "<html>";
        $message  .= "<body>";
        $message  .= "Телефон: ".$number;
        $message  .= "<br />";
        $message  .= "Ім'я: ".$name;
        $message  .= "<br />";
        $message  .= "Питання: ".$question;
        $message  .= "</body>";
      $message  .= "</html>";
      mail ($to, $subject, $message, $headers);
}
else
{
  exit;
} 
?>

</script>
</body>
</html>