var cardInput = document.getElementById("studentCardNumber");

var firstNameInput = document.getElementById("studentFirstName");

var lastNameInput = document.getElementById("studentLastName");

// checkers
var checkCard = /^[0-9]{0,15}$/; 

var checkNames = /^[a-zA-Z\s]+$/;


// check for card
cardInput.addEventListener("input",()=>{

    var inputValue = cardInput.value;

    if(!inputValue.match(checkCard)&&inputValue!="")
    {
        invalide(cardInput);
    }
    else if(inputValue=="")
    {
        defaultForm(cardInput);
    }
    else
    {   
        valid(cardInput);
    }
    
});

// check for firstName

firstNameInput.addEventListener("input",()=>{

    var inputValue = firstNameInput.value;

    if(!inputValue.match(checkNames)&&inputValue!="")
    {
        invalide(firstNameInput);
    }
    else if(inputValue=="")
    {
        defaultForm(firstNameInput);
    }
    else
    {   
        valid(firstNameInput);
    }
    
});

// check for lastName

lastNameInput.addEventListener("input",()=>{

    var inputValue = lastNameInput.value;

    if(!inputValue.match(checkNames)&&inputValue!="")
    {
        invalide(lastNameInput);
    }
    else if(inputValue=="")
    {
        defaultForm(lastNameInput);
    }
    else
    {   
        valid(lastNameInput);
    }
    
});


// function for checking user inputs
function valid(input)
{
    input.style.cssText = "border-color: green;"
}

function invalide(input)
{
    input.style.cssText = "border-color: rgb(237, 105, 101);"
}

function defaultForm(input)
{
    input.style.cssText = " border-color: rgb(146, 181, 249);"
}