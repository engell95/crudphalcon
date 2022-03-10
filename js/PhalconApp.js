//funtion components

function SearchTable(){

    const tableReg = document.getElementById('@datatable');
    const searchText = document.getElementById('@InpSearch').value.toLowerCase();
    let total = 0;

    for (let i = 1; i < tableReg.rows.length; i++) {

        if (tableReg.rows[i].id != '@ObjResult') {   

            let found = false;
            const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

            for (let j = 0; j < cellsOfRow.length && !found; j++) {

                const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {

                    found = true;
                    total++;

                }

            }

            if (found) {

                tableReg.rows[i].style.display = '';

            } else {

                tableReg.rows[i].style.display = 'none';

            }
        }

        continue

    }

    const lastTR = tableReg.rows[tableReg.rows.length-1];
    const td = lastTR.querySelector("td");
    lastTR.classList.remove("visually-hidden","cdanger","text-center");

    if (searchText == "") {
        lastTR.classList.add("visually-hidden");
    } else if (total) {
        td.innerHTML="Has been found <strong>"+total+"</strong> coincidence"+((total>1)?"s":"");
    } else {
        lastTR.classList.add("cdanger","text-center");
        td.innerHTML="No matches found Sorry :(";
    }

}

function PrintForm(title,form,action){
    
    const ModalTemplateTitle = document.getElementById('@ModalTemplateTitle');
    ModalTemplateTitle.innerHTML = title

    var formInput = '';
    const ModalTemplateBody = document.getElementById('@ModalTemplateBody');
    if(form != '')
    {
        formInput = document.getElementById(''+form+'').innerHTML;
    }

    ModalTemplateBody.innerHTML = ''+formInput+'';

    const ModalTemplateBtn = document.getElementById('@ModalTemplateBtn');
    if(action != '')
    {
        ModalTemplateBtn.classList.remove("visually-hidden");
        ModalTemplateBtn.innerHTML = action;
    }
    else{
        ModalTemplateBtn.classList.add("visually-hidden");   
    }

}

async function StoreForm(event,name,url){
    event.preventDefault();

    var form = document.getElementById(''+name+'');
  
    //const datax = new URLSearchParams(form);
    var Response = Eventfetch('Index/Store','POST',form);

    if (Response.status) {
        console.log('success')
    }
    else{
        console.log('error')
    }
    /*
    await fetch('Index/Store', {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        body: new FormData(form)
    })
    .then( response => {
        if (!response.ok) {
          return response.text().then(text => {
            throw new Error(text)
          });
        }
        return response; //we only get here if there is no error
      })
      .then( json => {
        console.log(json)
      })
      .catch( err => {
        console.log(err.message)
      });*/
    
    
}

async function Eventfetch(url,method,data){

    await fetch(url, {
        method: method, 
        body: new FormData(data)
    })
    .then( json => {
        return json;
    })
    .catch( err => {
        return err;
    });

}

/* helpers */

/*
print message
[id_alert]    [alert]
1       error
2       success
3       warning
4       information
*/
function Message(alert,message){

}