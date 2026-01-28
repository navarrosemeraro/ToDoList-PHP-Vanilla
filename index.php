<?php require_once "db_conn.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <title>To-do List</title>
</head>

<body>
    <div id="overlay"></div>
    <div id="box-criar"></div>
    <div id="lista-pai" class="position-absolute start-50 translate-middle">
        <div id="lista-titulo">
            <h1 class="text">Minhas tarefas</h1>
            <button id="btn_criar">Criar Nova Tarefa</button>
        </div>
        <div id="lista-tarefas">
            <?php
            $stmt = $conn->prepare("SELECT nome_tarefa, espec, data_inicio FROM tarefas WHERE status = 'pendente';");
            $stmt->execute();
            $result = $stmt->get_result(); //retorna uma tabela como resultado e atribui a $result

            /*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
            if($result && $result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $nome_tarefa = $row["nome_tarefa"];
                    $espec = $row["espec"];
                    $data_inicio = $row["data_inicio"];

                    echo ("<div class='input-group mb-3 box-tarefa'>
                                <div class='input-group-text box-botao' style='background-color:transparent; border: none;'>
                                <input class='form-check-input mt-0' type='checkbox' value='' aria-label='Checkbox for following text input' style='height: 50px; width:50px; border: solid black 1px'>
                                </div>
                                <div id='box-tarefa-filha'> 
                                    <h1>Tarefa: $nome_tarefa</h1><br> 
                                    <h3>Comentário: $espec </h3> 
                                    <h4> Data Inicial: $data_inicio </h4>
                                </div>
                            </div>");
                }
            }
            ?>
        </div>
    </div>
</body>

<script src="nova_tarefa.js"></script>
</html>