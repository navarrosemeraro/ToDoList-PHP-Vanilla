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
    <div id="box-criar" class="container">
        <div id="box-criar-titulo" style="position: relative; width: 100%; height:20%; border-bottom: solid black 1px; display: flex; align-items: center; padding-left: 10px; gap: 80px">
            <h1>Criar Nova Tarefa</h1>
            <button type="button" id="btn-close" class="btn-close" aria-label="Close"></button>
        </div> 
        <div id="box-criar-formulario">
            <form action="criar-tarefa.php" method="post">
            <label for="nomeTarefa"><b>Nome da Tarefa:</b></label>
            <input type="text" class="form-control" name="nomeTarefa" id="nomeTarefa" placeholder="ex: limpar a pia" required>
            <br>
            <label for="descricao"><b>Descrição da Tarefa:</b></label>
            <textarea class="form-control" name="descricao" id="descricao" placeholder="Ex: Usar panos, desinfetante, esponja, etc... "></textarea><br>
            <label for="prazoFinal"><b>Prazo Final:</b></label>
            <input type="date" class="form-control" name="prazoFinal" id="prazoFinal" required><br><br>
            <button id="btn_criar_tarefa" class="form-control btn btn-primary">Criar Tarefa</button>
            </form>
        </div>
    </div>
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

                    // 2. Exibe escapando TUDO na saída para evitar XSS
                        echo "<div class='input-group mb-3 box-tarefa'>";
                        echo "  <div class='input-group-text box-botao' style='background-color:transparent; border:none;'>";
                        echo "    <input class='form-check-input mt-0 checkbox' type='checkbox' value='' aria-label='Checkbox' style='width: 50px; height:50px;'>";
                        echo "  </div>";
                        echo "  <div id='box-tarefa-filha'>";
        
                    // Usamos htmlspecialchars por ser o padrão moderno mais comum
                    echo "    <h1>Tarefa: " . htmlspecialchars($nome_tarefa, ENT_QUOTES, 'UTF-8') . "</h1><br>";
                    echo "    <h3>Comentário: " . htmlspecialchars($espec, ENT_QUOTES, 'UTF-8') . "</h3>";
                    echo "    <h4>Data Inicial: " . htmlspecialchars($data_inicio, ENT_QUOTES, 'UTF-8') . "</h4>";
        
                    echo "  </div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
    <div id="manipula_tarefa" style="gap: 10px">
        <button type="button" class="btn btn-secondary">Finalizar Tarefa</button>
        <button type="button" class="btn btn-secondary">Editar Tarefa</button>
        <button type="button" class="btn btn-secondary">Excluir</button>
    </div>
</body>

<script src="nova_tarefa.js"></script>
</html>