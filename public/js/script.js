window.onload = (event) => {

    document.getElementById('skusobne').onclick = () => {

        const container =document.getElementById('authorsOfBookContainer');
        const currentNumOfAuthors = (container.children.length / 2) + 1;
        // create label
        let newLabel = document.createElement('label');
        newLabel.htmlFor = 'aboutAuthorInputs' + currentNumOfAuthors;
        newLabel.className = "col-form-label col-md-2 mt-md-3";
        newLabel.innerText = 'Autor ' + currentNumOfAuthors;
        container.appendChild(newLabel);
        //create inputsContainer
        let inputsContainer = document.createElement('div');
        inputsContainer.id = "aboutAuthorInputs" + currentNumOfAuthors;
        inputsContainer.className = "col-md-9 d-flex flex-wrap flex-md-nowrap mt-md-3";
        container.appendChild(inputsContainer);
        // create divForNameInput
        let divForNameInput = document.createElement('div');
        divForNameInput.className = "col-12 col-md-5";
        inputsContainer.appendChild(divForNameInput);
        // create pomDiv
        let pomDiv = document.createElement('div');
        pomDiv.className = "col-md-2";
        inputsContainer.appendChild(pomDiv);
        // create divForSurnameInput
        let divForSurnameInput = document.createElement('div');
        divForSurnameInput.className = "col-12 col-md-5";
        inputsContainer.appendChild(divForSurnameInput);
        // create inputName
        let inputName = document.createElement('input');
        inputName.id = "author" + currentNumOfAuthors + "Name";
        inputName.name = "name" + currentNumOfAuthors;
        inputName.className = "form-control";
        inputName.type = "text";
        inputName.placeholder = "Meno";
        inputName.required = true;
        divForNameInput.appendChild(inputName);
        // create inputSurname
        let inputSurname = document.createElement('input');
        inputSurname.id = "author" + currentNumOfAuthors + "Surname";
        inputSurname.name = "surname" + currentNumOfAuthors;
        inputSurname.className = "form-control";
        inputSurname.type = "text";
        inputSurname.placeholder = "Priezvisko";
        inputSurname.required = true;
        divForSurnameInput.appendChild(inputSurname);
    }
}