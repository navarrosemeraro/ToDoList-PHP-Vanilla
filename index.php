<?php require_once "db_conn.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <title>To-do List</title>
</head>

<body>
    <div id="overlay"></div>
    <div id="box-criar" class="container">
        <div id="box-criar-titulo"
            style="position: relative; width: 100%; height:20%; border-bottom: solid black 1px; display: flex; align-items: center; padding-left: 10px; gap: 80px">
            <h1>Criar Nova Tarefa</h1>
            <button type="button" id="btn-close" class="btn-close" aria-label="Close"></button>
        </div>
        <div id="box-criar-formulario">
            <form action="criar-tarefa.php" method="post">
                <label for="nomeTarefa"><b>Nome da Tarefa:</b></label>
                <input type="text" class="form-control" name="nomeTarefa" id="nomeTarefa" placeholder="ex: limpar a pia"
                    required>
                <br>
                <label for="descricao"><b>Descrição da Tarefa:</b></label>
                <textarea class="form-control" name="descricao" id="descricao"
                    placeholder="Ex: Usar panos, desinfetante, esponja, etc... "></textarea><br>
                <label for="prazoFinal"><b>Prazo Final:</b></label>
                <input type="date" class="form-control" name="prazoFinal" id="prazoFinal" required><br><br>
                <button id="btn_criar_tarefa" class="form-control btn btn-primary">Criar Tarefa</button>
            </form>
        </div>
    </div>
    <div id="box-editar" class="container">
        <input type="hidden" id="id_tarefa_edit" name="id">
        <div id="box-editar-titulo"
            style="position: relative; width: 100%; height:20%; border-bottom: solid black 1px; display: flex; align-items: center; padding-left: 10px; gap: 80px">
            <h1>Editar Tarefa</h1>
            <button type="button" id="btn-close-edit" class="btn-close" aria-label="Close"></button>
        </div>
        <div id="box-editar-formulario">
            <form action="criar-tarefa.php" method="post">
                <label for="nomeTarefa"><b>Nome da Tarefa:</b></label>
                <input type="text" class="form-control" name="nomeTarefa" id="nomeTarefa_edit" placeholder="ex: limpar a pia"
                    required>
                <br>
                <label for="descricao"><b>Descrição da Tarefa:</b></label>
                <textarea class="form-control" name="descricao" id="descricao_edit"
                    placeholder="Ex: Usar panos, desinfetante, esponja, etc... "></textarea><br>
                <label for="prazoFinal"><b>Prazo Final:</b></label>
                <input type="date" class="form-control" name="prazoFinal" id="prazoFinal" required><br><br>
                <button id="btn_finaliza_edicao" class="form-control btn btn-primary">Finalizar Edição</button>
            </form>
        </div>
    </div>

    <div class="main-wrapper">
        <div id="lista-pai">
            <div id="lista-titulo">
                <h1 class="text">Minhas tarefas</h1>
                <button id="btn_criar">Criar Nova Tarefa</button>
            </div>
            <div id="lista-tarefas">
                <?php
            $stmt = $conn->prepare("SELECT id, nome_tarefa, espec, data_inicio, prazo_final FROM tarefas WHERE status = 'pendente';");
            $stmt->execute();
            $result = $stmt->get_result(); //retorna uma tabela como resultado e atribui a $result

            /*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
            if($result && $result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $id = $row["id"];
                    $nome_tarefa = $row["nome_tarefa"];
                    $espec = $row["espec"];
                    $data_inicio = $row["data_inicio"];
                    $prazo_final = $row["prazo_final"];

                    echo "<div class='input-group mb-3 box-tarefa'>";
                    echo "  <div class='input-group-text box-botao' style='background-color:transparent; border:none;'>";
                    echo "    <input class='form-check-input mt-0 checkbox' type='checkbox' value='$id' style='width: 30px; height:30px;'>";
                    echo "  </div>";

                    echo "  <div id='box-tarefa-filha' class='d-flex flex-column align-items-start p-3'>";
        
                    // SEGURANÇA de XSS: htmlspecialchars
                    echo "    <h4 class='mb-1'><b>Tarefa:</b> " . htmlspecialchars($nome_tarefa, ENT_QUOTES, 'UTF-8') . "</h4>";
                    echo "    <p class='mb-1 text-muted'><b>Comentário:</b> " . htmlspecialchars($espec, ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "    <small><b>Início:</b> " . htmlspecialchars($data_inicio, ENT_QUOTES, 'UTF-8') . "</small>";
                    echo "    <p><b>Prazo Final:</b> " . htmlspecialchars($prazo_final, ENT_QUOTES, 'UTF-8') . "</p>";

                    echo "  </div>";
                    echo "</div>";
                }
            }
            ?>
            </div>
        </div>
        <div id="box_manipula_tarefa" class="mt-3">
            <button id="btn-finaliza" type="button" class="btn btn-secondary">Finalizar Tarefa</button>
            <button id="btn-edita" type="button" class="btn btn-secondary">Editar Tarefa</button>
            <button id="btn-exclui" type="button" class="btn btn-secondary">Excluir</button>
        </div>
    </div>
</body>

<script src="nova_tarefa.js"></script>
<script src="manipular-tarefa.js"></script>

</html>