<?php
require_once("db.php");
$login = $_POST['login'];
$pass = $_POST['password'];
$repeatpass = $_POST['repeatpass'];
$email = $_POST['email'];

if (empty($login) || empty($pass) || empty($repeatpass) || empty($email)) {
    echo "Заполните все поля";
} else {
    if ($pass != $repeatpass) {
        echo "Пароли не совпадают";
    } else {
        $sql = "INSERT INTO `users` (login, password, email) VALUES ('$login', '$pass', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Успешная регистрация";
        } else {
            echo "Ошибка..." . $conn->error;
        }
    }
}
?>
<script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Зупинити стандартну подію submit

      // Отримати дані форми
      let formData = new FormData(this);

      // Тут можна додати код для відправки даних форми на сервер, наприклад, за допомогою AJAX.

      // Після успішної обробки форми, перенаправити користувача на іншу сторінку
      window.location.href = "http://localhost/kirill.php"; // Змініть шлях на URL сторінки, куди потрібно перенаправити користувача.
    });
  </script>
</body>
</html>
