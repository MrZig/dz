
<html>
  <h2>Введите номер теста.</h2>
  <form action="test.php" method="GET" >
    <input type="text" name="number" />
    <input type="submit" value="Отправить" />
  </form>

<?php   
 $dir = 'tests';
 $list = scandir($dir);
 foreach ($list as $i => $value) {
    if ($i > 1){
    $fileadr = "$dir/$value";
    $filejs1 = file_get_contents("$fileadr");
    $filejs = json_decode($filejs1, 'true');
          if ($_GET["number"] == $filejs[0]["number"]) {
          $true = $filejs[0]["answerthree"];
          $ques = $filejs[0]["question"];
          $answ1 = $filejs[0]["answerone"];
          $answ2 = $filejs[0]["answertwo"];
          $answ3 = $filejs[0]["answerthree"][0];
          echo "<div> <h2>Тест</h2>
              <p>$ques</p>
              <form action='test.php' method='Post'>
                <select multiple name='answer'>
                  <option value='$answ1'>$answ1</option>
                  <option value='$answ2'>$answ2</option>
                  <option value='$true'>$answ3</option>
                </select>
                 <br/>
                 <form action='test.php' method='Post'>
                 <label> Введите имя
                 <input type = 'text' name='login'>
                 </label>
                 <input type='submit' value='Отправить' />
              </form> 
            </div>";
           
          }
    } 
}  
  if ($_GET["number"] > $filejs[0]["number"]){
                  http_response_code(404);
                  echo 'Ошибка 404' . '<br/>' . 'Тест не найден';
                  exit();
  }               
  if ($_POST['answer'] == 'Array') {
    echo 'Верно';
  }

  elseif (is_string($_POST['answer'])){
      echo 'Неверно';
  }
?>
  <p><a href="list.php">К списку тестов</a></p>
  <p><a href="form.php">Выйти</a></p>
</html>