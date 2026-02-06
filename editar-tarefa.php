<?php

    require_once "db_conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["id"])){
        
        $id = json_decode($_POST["id"]);

        if($id && count($id) > 0){
            
            $id_seguros = array_map('intval', $id);

            $id_para_sql = implode(",", $id_seguros);

            // ENTRAVE AQUI!!!!!


            $update = $conn->prepare("UPDATE tarefas SET  WHERE id IN ($lista_para_sql)");
            
            if($delete->execute() == TRUE){
                echo "Tarefas Excluídas com Sucesso!";
            }
            else{
                echo "Erro ao excluir: " . $conn->error;
            }
        }
    }
    else{
        echo "Nenhum ID válido foi recebido.";
    }

    }

?>