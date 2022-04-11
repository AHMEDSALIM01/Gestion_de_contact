const title = document.querySelector(".formTilte");
const modal = document.querySelector(".mdl");
const add = document.querySelector(".add");
const save = document.querySelector(".save");
const exit = document.querySelector(".cancel");
const edit = document.querySelector(".edit");
const delet = document.querySelector(".delete");
const confirmation = document.querySelector(".confirmation");
const form = document.querySelector(".form");
const Yes = document.querySelector(".Yes");
const No = document.querySelector(".No");


add.addEventListener("click", ()=>{
    modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
    save.value="Add";
    title.textContent="Add Contact";
});

exit.addEventListener("click", ()=>{
    modal.setAttribute("style","display:none;");
});

edit.addEventListener("click",()=>{
    modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
    save.value="Update";
    title.textContent="Update Contact";
});

delet.addEventListener("click",()=>{
    modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
    confirmation.setAttribute("style","display:flex");
    form.setAttribute("style","display:none;");
});

No.addEventListener("click",()=>{
    modal.setAttribute("style","display:none;");
    form.setAttribute("style","display:flex;");
    confirmation.setAttribute("style","display:none;");
})