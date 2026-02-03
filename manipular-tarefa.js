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

    if(marcados > 0 ){
        opcoesManipular.style.display = "flex";
    }
    else{
        opcoesManipular.style.display = "none";
    }
}