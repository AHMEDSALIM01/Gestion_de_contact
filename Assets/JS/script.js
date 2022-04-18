const title = document.querySelector(".formTilte");
const modal = document.querySelector(".mdl");
const add = document.querySelector(".add");
const save = document.querySelector(".save");
const exit = document.querySelector(".cancel");
const edit = document.querySelectorAll(".edit");
const delet = document.querySelectorAll(".delete");
const confirmation = document.querySelector(".confirmation");
const form = document.querySelector(".form");
const Yes = document.querySelector(".Yes");
const No = document.querySelector(".No");
const TDN = document.querySelectorAll('.tdN');
const TDE = document.querySelectorAll('.tdE');
const TDP = document.querySelectorAll('.tdP');
const TDA = document.querySelectorAll('.tdA');
const TDI = document.querySelectorAll('.idd');
const td = document.querySelectorAll(".nme");
const iName = document.querySelector("#Name");
const iEmail = document.querySelector("#Email");
const iPhone = document.querySelector("#Phone");
const iAddress = document.querySelector("#Address");
const IDd = document.querySelector("#id");


add.addEventListener("click", ()=>{
    modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
    save.value="Add";
    title.textContent="Add Contact";
});

exit.addEventListener("click", ()=>{
    modal.setAttribute("style","display:none;");
});

for(let i=0 ; i<edit.length ; i++){
    edit[i].addEventListener("click",()=>{
        const tdN = TDN[i].getAttribute('data-target');
        const tdE = TDE[i].getAttribute('data-target');
        const tdP= TDP[i].getAttribute('data-target');
        const tdA = TDA[i].getAttribute('data-target');
        const tdI = TDI[i].getAttribute('data-id');
        modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
        save.value="Update";
        save.name="Update";
        title.textContent="Update Contact";
        iName.value=tdN;
        iEmail.value=tdE;
        iPhone.value=tdP;
        iAddress.value=tdA;
        IDd.value=tdI;
    });
}

No.addEventListener("click",()=>{
   
    modal.setAttribute("style","display:none;");
    form.setAttribute("style","display:flex;");
    confirmation.setAttribute("style","display:none;");
})


