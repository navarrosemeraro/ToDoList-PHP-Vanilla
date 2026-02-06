// Manipular a visibilidade dos Botões de Finalizar, Editar e Excluir

const containerTarefas = document.getElementById("lista-tarefas");
const opcoesManipular = document.getElementById("box_manipula_tarefa");

containerTarefas.addEventListener("change", (event) => {
    // Verifico se o que mudou foi realmente um checkbox
    // 'event' é um relatório automático que o JS cria
    // 'event.target' diz EXATAMENTE quem foi clicado
    if (event.target.classList.contains("checkbox")) {
        atualizarVisibilidadeBotoes();
    }
});

function atualizarVisibilidadeBotoes(){
    
    const marcados = document.querySelectorAll(".checkbox:checked").length;

    const btnEdita = document.getElementById("btn-edita");

    if(marcados > 0){
        opcoesManipular.style.display = "flex";
        btnEdita.style.display = "flex";
        
        if(marcados > 1){
            btnEdita.style.display = "none";
        }
    }
    else{
        opcoesManipular.style.display = "none";
    }
}


// Aplicar a manipulação das tarefas por CRUD

const botaoExcluir = document.getElementById("btn-exclui");

// declaro a função dentro do escutador
botaoExcluir.addEventListener("click", function() {

    // CAPTURA DOS DADOS

    const tarefasMarcadas = document.querySelectorAll(".checkbox:checked");

    let idsMarcados = [];

    tarefasMarcadas.forEach(function(checkbox) {
        idsMarcados.push(checkbox.value);
    });

    // TRANSMISSÃO de dados para o PHP

    if(idsMarcados.length <= 0){
        alert("Por favor, selecione ao menos uma tarefa!");
        return;
    }


    /* OBS DOS ESTUDOS: Pense em "dados" objeto de class "URLSearchParams" como um envelope vazio. 
    O método .append() é o ato de colocar algo dentro desse envelope e, o mais importante, colocar uma etiqueta nele.*/

    let dados = new URLSearchParams(); //URLSearchParams transforma nossa lista de IDs em um formato que o PHP entende como um $_POST
    dados.append("ids", JSON.stringify(idsMarcados)); // ids é o identificador para o PHP e o segundo parâmetro transforma os ids em strings legíveis 

    fetch("excluir_tarefa.php", {
        method: "POST", // Método de envio
        body: dados    // O conteúdo (que são os ids)
    })
    .then(function(resp_serv){
        // Resposta do Servidor (do PHP)
        return resp_serv.text();
    })
    .then(function(mensagem){
        // Mensagem deixada para o Usuário
        alert(mensagem);
        location.reload(); // Recarrega a página para sumir com as tarefas excluídas
    })
});