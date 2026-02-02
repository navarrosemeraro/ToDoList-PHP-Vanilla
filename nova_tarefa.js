function criar(){
    let box_criacao = document.getElementById("box-criar");
    box_criacao.style = 
    `display:flex;
    flex-direction: column;
    z-index: 10;
    pointer-events: auto`;

    document.body.style.overflow = "hidden";

    let overlay = document.getElementById("overlay");
    overlay.style.cssText = "display: flex; z-index: 9;"
}

function fechar(){
    let box_criacao = document.getElementById("box-criar");
    let overlay = document.getElementById("overlay");

    box_criacao.style = "display: none";
    overlay.style = "display: none";
}

// evento para o botão de abrir janela de criação
let botao_criar = document.getElementById("btn_criar");
botao_criar.addEventListener("click", criar);

// evento para o botão de fechar janela de criação
let close_btn = document.getElementsByClassName("btn-close");
close_btn.addEventListener("click", fechar);