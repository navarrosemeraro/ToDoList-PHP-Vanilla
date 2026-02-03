function manipular{
    
}

let check_btns = document.querySelectorAll(".checkbox");

check_btns.forEach(btn => {
    btn.addEventListener("click", manipular);
});