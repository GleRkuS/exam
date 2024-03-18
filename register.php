<?php
$servername = "examenus";
$username = "root";
$password = "";
$dbname = "ZondbeDabalutoriya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$username = $_POST['user_login'];
$password = $_POST['user_passwod'];
$confirm_password = $_POST['confirm_passwod'];

// Проверка на существующий username
$check_query = "SELECT * FROM users WHERE user_login = '$username'";
$result = $conn->query($check_query);

if ($result->num_rows > 0) {
    echo "Пользователь с таким именем уже существует.";
} else {
    if ($password === $confirm_passwod) {
        $sql = "INSERT INTO users (user_login, user_passwod) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Пользователь успешно зарегистрирован.";
            echo '<script>setTimeout(function(){ alert("Регистрация успешна!"); window.location.href = "a.html"; }, 2000);</script>';
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Пароли не совпадают.";
    }
}

$conn->close();
