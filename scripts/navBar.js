// check user nav-bar input

var resultInput = document.getElementById("result-check");
var inputMsg = document.getElementById("home-input-msg");

var checker = /^[0-9]{0,15}$/;

resultInput.addEventListener("input",()=>{

    var inputValue = resultInput.value;
    if(!inputValue.match(checker)&&inputValue!="")
    {
        inputMsg.innerHTML ="only Numbers";
    }
    else
    {   
        inputMsg.innerHTML ="";
    }
    
});



