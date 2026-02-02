<?php
    require_once "db_conn.php";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $nome_tarefa = $_POST["nomeTarefa"];
        $descricao = $_POST["descricao"];
        $prazoFinal = $_POST["prazoFinal"];

        if($nome_tarefa){

        $insert = $conn->prepare("INSERT INTO tarefas (nome_tarefa, espec, prazo_final)
                                VALUES (?, ?, ?)");
        $insert->bind_param("sss", $nome_tarefa, $descricao, $prazoFinal);
        $insert->execute();

        header("Location: index.php");
        exit();
        }
    }
?>