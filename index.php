<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    form {
      max-width: 300px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="password"] {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 3px;
      background-color: #333;
      color: #fff;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #00FF00;
    }

    
    form > * {
      margin-bottom: 10px;
    }

    
    ::placeholder {
      color: #999;
    }

  </style>
</head>
<body>
  <form id="registrationForm" action="register.php" method="post">
    <input type="text" placeholder="Логин" name="login">
    <input type="password" placeholder="Пароль" name="password">
    <input type="password" placeholder="Повторите пароль" name="repeatpass">
    <input type="text" placeholder="Email" name="email">
    <button type="submit">Зареєструватись</button>
  </form>

  <script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Зупинити стандартну подію submit

      
      let formData = new FormData(this);

      // Отримати URL, на який потрібно відправити дані
      let formAction = this.getAttribute("action");

      // Використати AJAX для відправки даних на сервер
      fetch(formAction, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          // Після успішної обробки форми, перенаправити користувача на іншу сторінку
          window.location.href = "http://localhost/kirill.php";
        } else {
          throw new Error('Помилка відправки форми');
        }
      })
      .catch(error => {
        console.error('Помилка:', error);
      });
    });
  </script>
</body>
</html>
