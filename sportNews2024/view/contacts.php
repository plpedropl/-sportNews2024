<?php
    ob_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Форма для отправки сообщения</title>
<style>
  /* Стили для формы */
  body {
    background-color: #424C57 !important;
  }

  form {
    max-width: 500px;
    margin: auto;
    margin-top: 50px;
    color: #fff; /* Добавленный стиль */
  }
  .form-group {
    margin-bottom: 20px;
  }

  h1 {
    margin-top: -200px;
    color: #F5F5F5;
    font-family: Rubik Mono One;
    font-size: 48px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-align: center;
  }

  label {
    font-weight: bold;
  }
  input[type="text"],
  input[type="email"],
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    color: #000; /* Чтобы текст был виден, изменяем цвет на черный */
    background-color: #fff; /* Цвет фона на белый */
  }
  textarea {
    resize: vertical;
  }
  button[type="submit"] {
    background-color: #2588FC;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background-color: #2588FC;
  }
</style>


</head>
<body>
    
<h1>Форма для <span style="color:#2588FC;">отправки сообщения</span></h1>
<br>


<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class="form-group">
    <label for="name">Имя:</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="message">Сообщение:</label>
    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>

<?php
// Обработка отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    // Здесь можно добавить код для отправки сообщения на почту или сохранения его в базе данных
    // Например:
    // mail("адрес_получателя", "Тема сообщения", $message, "From: $name <$email>");
    
    // После обработки формы, например, перенаправление на другую страницу
    // header("Location: thank_you.php");
    // exit();
}
?>

</body>
</html>


<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>

