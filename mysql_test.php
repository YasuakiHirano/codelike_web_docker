<?php
/**
 * DB接続テスト用
 */
    try
    {
        $database_handler = new PDO('mysql:host=db:3306;dbname=test_db;charset=utf8mb4', 'root', 'password');

        $id = null;
        if ($statement = $database_handler->prepare("SELECT id FROM users")) {
            $statement->execute();

            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
            }
        }

        $id = is_null($id) ? 1 : (int)$id + 1;
        $name = "テスト{$id}";

        if ($statement = $database_handler->prepare("INSERT INTO users (id, name) VALUES(:id, :name)")) {
            $statement->bindParam(":id", $id);
            $statement->bindParam(":name", $name);
            $execute = $statement->execute();

            if ($execute) {
              echo "登録に成功しました。\n"; 
            } else {
              echo "登録に失敗しました。\n"; 
            }
        }

        if ($statement = $database_handler->prepare("SELECT id, name FROM users")) {
            $statement->execute();

            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
                $name = $user['name'];
                echo "id:{$id} name:{$name}\n";
            }
        }
    }
    catch (PDOException $e) 
    {
        echo "DB接続に失敗しました。\n";
        echo $e->getMessage() . "\n";
        exit;
    }

    echo "OK.\n";