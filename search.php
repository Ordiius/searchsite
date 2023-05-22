<!DOCTYPE html>
<html lang="en">
<head>
    <title>Пошуковий</title>
</head>
<body>


    <?php
  echo "<link rel='stylesheet' type='text/css' href='search.css'>";
  $button = $_GET['submit'];
  $search = $_GET['search'];
  

  $server = "127.0.0.1";
  $username = "root";
  $password = "";
  $database = "search";
  $conn = mysqli_connect($server, $username, $password, $database);
  

  $sql = "SELECT *, MATCH(name, description, url) AGAINST ('%" . $search . "%') AS relevance FROM something WHERE MATCH(name, description, url) AGAINST ('%" . $search . "%')";
  
  $run = mysqli_query($conn, $sql);
  if (!$run) {
      die('Query execution failed: ' . mysqli_error($conn));
  }
  $foundnum = mysqli_num_rows($run);
  
  if ($foundnum == 0) {

      $similarSql = "SELECT *, MATCH(name, description, url) AGAINST ('" . $search . "') AS relevance FROM something WHERE SOUNDEX(name) = SOUNDEX('" . $search . "') OR SOUNDEX(description) = SOUNDEX('" . $search . "') OR SOUNDEX(url) = SOUNDEX('" . $search . "')";
      $similarRun = mysqli_query($conn, $similarSql);
      $similarNum = mysqli_num_rows($similarRun);
  
      if ($similarNum > 0) {
          echo "<p class='good-text'><h1><strong>Нічого не знайдено з терміном '<b>$search</b>'. Можливо.. ви мали на увазі:</strong></h1></p>";
          while ($similarRows = mysqli_fetch_array($similarRun)) {
              echo "<h5 class='card-title1'>" . $similarRows["name"] . "</h5>";
              echo "<h5 class='card-title2'>" . $similarRows["description"] . "</h5>";
              echo "<h5 class='card-title3'><a href='" . $similarRows["url"] . "'>" . $similarRows["url"] . "</a></h5>";
          }
      } else {
          echo "<p class='error-text'>Ми не можемо знайти нічого зв'язаного з терміном '<b>$search</b>'!</p>";
      }
  } else {
      echo "<p class='good-text'><h1><strong>$foundnum результат знайдено для \"" . $search . "\"</strong></h1></p>";
  
      while ($runrows = mysqli_fetch_array($run)) {
        echo "<h5 class='card-title1'>" . $runrows["name"] . "</h5>";
        echo "<h5 class='card-title2'>" . $runrows["description"] . "</h5>";
        echo "<h5 class='card-title3'><a class='normal-link' href='" . $runrows["url"] . "'>Посилання на сайт  :)</a></h5>";
    }
 }
    mysqli_close($conn)
    ?>
    <button onclick="goBack()">Назад</button>

<script>
function goBack() {
  window.history.back();
}
</script>
<div class="contact" id="contact" data-menu>
    <nav>
      <li class="menu__item">
        <a href="contacts.php" class="menu__link menu__link--current">Напишіть нам!</a>
      </li>
    </nav>
</div>
</body>
</html>