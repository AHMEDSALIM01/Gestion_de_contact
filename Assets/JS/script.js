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
let ADD = "";
const UPD = document.querySelector("#Update");
const msg1 = document.querySelector("#errorNp");
const msg2 = document.querySelector("#errorPhone");
const msg3 = document.querySelector("#errorEmail");
const msg4 = document.querySelector("#errorAddress");
const Regexnam = /^[A-Z a-z]{3,24}$/;
const Regexemail =/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
const Regexphone =/^\+((?:9[679]|8[035789]|6[789]|5[90]|42|3[578]|2[1-689])|9[0-58]|8[1246]|6[0-6]|5[1-8]|4[013-9]|3[0-469]|2[70]|7|1)(?:\W*\d){0,13}\d$/;

iName.addEventListener("input", ()=>{
    if(!Regexnam.test(iName.value)){
        iName.setAttribute("style","border: solid 1.5px red;")
        msg1.innerText = "Invalid Name! (Examle Example).";
        save.setAttribute("disabled","disabled");
    }else{
        iName.removeAttribute("style","border: solid 1.5px red;")
        msg1.innerText = "";
        save.removeAttribute("disabled","disabled");
    }
});

iEmail.addEventListener("input", ()=>{
    if(!Regexemail.test(iEmail.value)){
        iEmail.setAttribute("style","border: solid 1.5px red;")
        msg3.innerText = "Invalid Email! (Examle@email.com).";
        save.setAttribute("disabled","disabled");
    }else{
        iEmail.removeAttribute("style","border: solid 1.5px red;")
        msg3.innerText = "";
        save.removeAttribute("disabled","disabled");
    }
});

iPhone.addEventListener("input", ()=>{
    if(!Regexphone.test(iPhone.value)){
        iPhone.setAttribute("style","border: solid 1.5px red;")
        msg2.innerText = "Invalid phone number! (+2120000000000)";
        save.setAttribute("disabled","disabled");
    }else{
        iPhone.removeAttribute("style","border: solid 1.5px red;")
        msg2.innerText = "";
        save.removeAttribute("disabled","disabled");
    }
});

add.addEventListener("click", ()=>{
    modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
    save.value="Add";
    save.name="Add";
    title.textContent="Add Contact";
    save.id="Add";
    ADD = document.querySelector("#Add");
});


save.addEventListener("click", (a)=>{
    if(save.value==="Add"){
        if(iName.value==="" && iEmail.value==="" && iPhone.value==="" && iAddress.value===""){
            a.preventDefault();
            msg1.innerText = (iName.value==="") ? "Name should not be blank" : "";
            msg2.innerText = (iPhone.value==="") ? "Phone should not be blank" : "";
            msg3.innerText = (iEmail.value==="") ? "Email should not be blank" : "";
        }
        if(!Regexnam.test(iName.value) && !Regexemail.test(iEmail.value) && !Regexphone.test(iPhone.value)){
            a.preventDefault();
        }
    }
});

exit.addEventListener("click", ()=>{
    modal.setAttribute("style","display:none;");
    iName.removeAttribute("style","border: solid 1.5px red;")
    msg1.innerText = "";
    save.removeAttribute("disabled","disabled");
    iEmail.removeAttribute("style","border: solid 1.5px red;")
    msg3.innerText = "";
    save.removeAttribute("disabled","disabled");
    iPhone.removeAttribute("style","border: solid 1.5px red;")
    msg2.innerText = "";
    save.removeAttribute("disabled","disabled");
});

for(let i=0 ; i<edit.length ; i++){
    edit[i].addEventListener("click",(up)=>{
        const tdN = TDN[i].getAttribute('data-target');
        const tdE = TDE[i].getAttribute('data-target');
        const tdP= TDP[i].getAttribute('data-target');
        const tdA = TDA[i].getAttribute('data-target');
        const tdI = TDI[i].getAttribute('data-id');
        modal.setAttribute("style","display:flex; position:absolute; z-index:1040; background-color:rgba(0,0,0,0.5); width:100%; height:100%;");
        save.value="Update";
        save.name="Update";
        save.id="Update";
        title.textContent="Update Contact";
        iName.value=tdN;
        iEmail.value=tdE;
        iPhone.value=tdP;
        iAddress.value=tdA;
        IDd.value=tdI;

        if(iName.value==="" && iEmail.value==="" && iPhone.value==="" && iAddress.value===""){
            up.preventDefault();
        }
    });
}

No.addEventListener("click",()=>{
   
    modal.setAttribute("style","display:none;");
    form.setAttribute("style","display:flex;");
    confirmation.setAttribute("style","display:none;");
})


