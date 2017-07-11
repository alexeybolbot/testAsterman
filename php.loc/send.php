<?php
    sleep(2);
    $fio = htmlspecialchars($_POST['fio']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    if($phone == '' || $email == '' || $fio == ''){
        echo 'Заполните поля!!!';
    }
    else {
        $link = mysqli_connect('localhost:3306', 'root', 'root', 'people');
        if(mysqli_connect_errno()){
            echo 'Ошибка в подключении к БД ('.  mysqli_connect_errno().'): '. mysqli_connect_error();
            exit();
        }
        $insert_query = "INSERT INTO people (fio, email, phone) VALUES ('$fio', '$email', '$phone');";
        
        $result = mysqli_query($link, $insert_query);
        
        echo 'Запись добавлена успешно.';
    }
           