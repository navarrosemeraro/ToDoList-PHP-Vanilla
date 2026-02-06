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


/*----- Aplicar a manipulação das tarefas por CRUD ----- */

/*----- DELETAR TAREFAS ------ */

const botaoExcluir = document.getElementById("btn-exclui");

// declaro uma função dentro do escutador
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



/*----- EDITAR TAREFA ------ */

// click do botão de edição inicial
const botaoEditar = document.getElementById("btn-edita");

// declaro uma função dentro do escutador
botaoEditar.addEventListener("click", function(){

    let box_edicao = document.getElementById("box-editar");
    box_edicao.style = 
    `display:flex;
    flex-direction: column;
    z-index: 10;
    pointer-events: auto`;

    document.body.style.overflow = "hidden";

    let overlay = document.getElementById("overlay");
    overlay.style.cssText = "display: flex; z-index: 9;"

    const checkbox = document.querySelector(".checkbox:checked");

    if (checkbox){
        // Acha a linha da tabela correspondente
        const boxTarefa = checkbox.closest(".box-tarefa");

        // Pega os textos que estão na tela
        const textoTitulo = boxTarefa.querySelector("h4").innerText;
        const textoComentario = boxTarefa.querySelector("p").innerText;
        
        // Pega o ID do checkbox
        const idTarefa = checkbox.value;

        // Limpeza dos textos
        // Remove o "Tarefa:" e "Comentário:" que vem junto no innerText
        const nomeLimpo = textoTitulo.replace("Tarefa:", "").trim();
        const especLimpa = textoComentario.replace("Comentário:", "").trim();

        // Injeção de dados no Formulário (A Mágica)
        
        // Preenche o ID escondido (Fundamental para o UPDATE funcionar)
        document.getElementById("id_tarefa_edit").value = idTarefa;
        
        // Preenche os campos visíveis para o usuário editar
        document.getElementById("nomeTarefa_edit").value = nomeLimpo; 
        document.getElementById("descricao_edit").value = especLimpa;
    }
    
})

// click do botão de finalizar edição

const btnFinalizaEdicao = document.getElementById("btn_finaliza_edicao");

btnFinalizaEdicao.addEventListener("click", function(){

    // CAPTURA DOS DADOS

    const checkbox = document.querySelector(".checkbox:checked");
    const id_tarefaMarcada = checkbox.value;

    let dados = new URLSearchParams;
    dados.append(("id", JSON.stringify(id_tarefaMarcada)));

    fetch("editar-tarefa.php", {
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

})


// Fechamento da box de edição
function fechar(){
    let box_edicao = document.getElementById("box-editar");
    let overlay = document.getElementById("overlay");

    box_edicao.style = "display: none";
    overlay.style = "display: none";
}

document.getElementById("btn-close-edit").addEventListener("click", fechar);
