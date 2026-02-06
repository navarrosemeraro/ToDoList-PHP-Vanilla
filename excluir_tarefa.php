<?php
    require_once "db_conn.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["ids"])){
        
        $array_ids = json_decode($_POST["ids"]);

        if($array_ids && count($array_ids) > 0){
            
            // SEGURANÇA: Garanto que todos os itens sejam números inteiros
            // array_map passa a função 'intval' em cada item da lista
            $ids_seguros = array_map('intval', $array_ids);

            // Transformo o array [1, 5] na string "1,5" para o SQL
            $lista_para_sql = implode(",", $ids_seguros);

            $delete = $conn->prepare("DELETE FROM tarefas WHERE id IN ($lista_para_sql)");
            
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