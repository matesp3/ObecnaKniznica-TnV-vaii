window.onload = (event) => {
    // function higlightLabel(event) {
    //     const authorLabel = document.getElementById("aboutAuthorInputs1").previousElementSibling;
    //     if (authorLabel != null) {
    //         authorLabel.style.color = "white";
    //         authorLabel.style.fontWeight = "bold";
    //         authorLabel.style.backgroundColor = "red";
    //         authorLabel.styles.border = "solid";
    //         authorLabel.styles.borderRadius = "10px";
    //     }
    // }

    function getPosition(precedingChar, identificator) {
        const params = identificator.toString().split(precedingChar);
        const position = params[1];
        if (position != null && position != undefined && position > 0)
            return position;
        return undefined;
    }
    function renameIdsOfDeleteButtonsIfNeeded(startId) {
        if (startId <= 0)
            return;
        const buttons = document.getElementsByClassName('deleteButton');
        const count = buttons?.length;
        if (count == undefined) // undefined in case of buttons var was null
            return;

        for (let i = startId; i < count + 1; i++) {
            let currentBtn = buttons[i - 1]; // need to remember them, before renaming...
            const pos = getPosition("-", currentBtn.id);
            if (pos != undefined) {
                // let currentInputSurname = currentBtn.previousElementSibling;
                let currentInputSurname = document.getElementById(`aSurname-${pos}`);
                let currentInputName = document.getElementById(`aName-${pos}`);
                let currentParentDiv = document.getElementById(`aboutAuthorInputs-${pos}`);
                let currentLabel = currentParentDiv.previousElementSibling;
                let currentBtnIcon = document.getElementById(`iTrash-${pos}`);

                currentBtnIcon.id = `iTrash-${i}`;
                currentBtn.id = `delBtn-${i}`;
                currentInputSurname.id = `aSurname-${i}`;
                currentInputSurname.name = `surname-${i}`;
                currentInputName.id = `aName-${i}`;
                currentInputName.name = `name-${i}`;
                currentParentDiv.id = `aboutAuthorInputs-${i}`;
                currentLabel.htmlFor = `aboutAuthorInputs-${i}`;
            }
        }
    }

    function deleteAuthorInputs(event) {
        if (event == null || event.target == null)
            return;
        const i = event.target.id.toString().split("-")[1];
        if (i == null)
            return;

        const divToDelete = document.getElementById(`aboutAuthorInputs-${i}`);
        const labelToDelete = divToDelete.previousElementSibling;
        labelToDelete.remove();
        divToDelete.remove(); // deletes all child nodes (divs + inputs + button)
        renameIdsOfDeleteButtonsIfNeeded(i);

        // check if there's only one author left -> in that case, you should not delete the last one
        const delButtons = document.getElementsByClassName('deleteButton');
        if (deleteButtons == null)
            return;
        if (deleteButtons.length == 1) {
            delButtons[0].style.display = "none";
        }
    }

    function addAuthorInputs() {
        const delButtons = document.getElementsByClassName('deleteButton');
        if (deleteButtons == null)
            return;
        if (deleteButtons.length == 1) {
            delButtons[0].style.display = "block"; // now, we can display it, because there's going to be at least two authors
        }

        const container = document.getElementById('authorsOfBookContainer');
        const currentNumOfAuthors = (container.children.length / 2) + 1; // divided by to due to labels children
        // create label
        let newLabel = document.createElement('label');
        newLabel.htmlFor = 'aboutAuthorInputs-' + currentNumOfAuthors;
        newLabel.className = "col-form-label col-md-2 mt-3";
        newLabel.innerText = 'Autor';
        container.appendChild(newLabel);
        //create inputsContainer
        let inputsContainer = document.createElement('div');
        inputsContainer.id = "aboutAuthorInputs-" + currentNumOfAuthors;
        inputsContainer.className = "col-md-9 d-flex flex-wrap flex-md-nowrap mt-md-3";
        container.appendChild(inputsContainer);
        // create divForNameInput
        let divForNameInput = document.createElement('div');
        divForNameInput.className = "col-12 col-md-5";
        inputsContainer.appendChild(divForNameInput);
        // create pomDiv
        let pomDiv = document.createElement('div');
        pomDiv.className = "col-12 col-md-1 mt-1 mt-md-0";
        inputsContainer.appendChild(pomDiv);
        // create divForSurnameInput
        let divForSurnameInput = document.createElement('div');
        divForSurnameInput.className = "col-12 col-md-5";
        inputsContainer.appendChild(divForSurnameInput);
        // create inputName
        let inputName = document.createElement('input');
        inputName.id = "aName-" + currentNumOfAuthors;
        inputName.name = "name-" + currentNumOfAuthors;
        inputName.className = "form-control";
        inputName.type = "text";
        inputName.placeholder = "Meno";
        inputName.required = true;
        divForNameInput.appendChild(inputName);
        // create inputSurname
        let inputSurname = document.createElement('input');
        inputSurname.id = "aSurname-" + currentNumOfAuthors;
        inputSurname.name = "surname-" + currentNumOfAuthors;
        inputSurname.className = "form-control";
        inputSurname.type = "text";
        inputSurname.placeholder = "Priezvisko";
        inputSurname.required = true;
        divForSurnameInput.appendChild(inputSurname);
        // create delete button
        let btnDiv = document.createElement('div');
        btnDiv.className = "col-12 col-md-1 mt-1 mt-md-0 d-flex justify-content-end align-items-center";
        inputsContainer.appendChild(btnDiv);
        // create button for deleting
        let deleteBtn = document.createElement('button');
        deleteBtn.type = "button";
        deleteBtn.className = "btn btn-sm btn-outline-danger deleteButton";
        deleteBtn.id = `delBtn-${currentNumOfAuthors}`;
        btnDiv.appendChild(deleteBtn);
        // deleteBtn.innerHTML = `<i class='bi bi-trash' id="delete-${currentNumOfAuthors}"></i>`;
        let iTrash = document.createElement('i');
        iTrash.className = "bi bi-trash";
        iTrash.id = `iTrash-${currentNumOfAuthors}`
        deleteBtn.addEventListener('click', (event) => {
            deleteAuthorInputs(event);
        });
        // deleteBtn.addEventListener('mouseover', (event) => {
        //     higlightLabel(event);
        // });
        // deleteBtn.addEventListener('mouseleave', (event) => {
        //     const authorLabel = document.getElementById("aboutAuthorInputs1").previousElementSibling;
        //     authorLabel.style.backgroundColor = document.documentElement.style.getPropertyValue("--myVar-onHover"); //  https://davidwalsh.name/css-variables-javascript
        // });
        deleteBtn.appendChild(iTrash);
    }

    //--------------- end of function definitions -----------------//

    // ------- initialization of page ------------- //

    let deleteButtons = document.getElementsByClassName('deleteButton');
    if (deleteButtons != null && deleteButtons.length > 0) {
        if (deleteButtons.length == 1)
            deleteButtons[0].style.display = "none"; // if there's only one, the delete button should not be displayed

        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', (e) => { deleteAuthorInputs(e); } );
        }
    }

    let addAuthorBtn = document.getElementById('btnAddAnotherAuthor');
    if (addAuthorBtn != null)
        addAuthorBtn.onclick = () => { addAuthorInputs(); };
}