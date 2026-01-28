function criar(){
    let box_criacao = document.getElementById("box-criar");
    box_criacao.style = 
    `display:flex; 
    position: absolute; 
    top:50%; left: 50%;
     background-color:red;
     height:100px; width:100px;
     z-index: 10;
    transform: translate(-50%, -50%)`;

    document.body.style.overflow = "hidden";

    let overlay = document.getElementById("overlay");
    overlay.style.cssText = "display:fixed; height: 100%; width: 100%; background-color: rgba(0,0,0,0.5);"
}
let botao_criar = document.getElementById("btn_criar");
botao_criar.addEventListener("click", criar);