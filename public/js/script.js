window.onload = (event) => {

    document.getElementById('btnAddAnotherAuthor').onclick = () => {
        const container =document.getElementById('authorsOfBookContainer');
        const currentNumOfAuthors = container.children.length + 1;
        // create rowDiv
        let rowDiv = document.createElement('div');
        rowDiv.className = "row mt-3"
        container.appendChild(rowDiv);
        // create label
        let newLabel = document.createElement('label');
        newLabel.htmlFor = 'aboutAuthorInputs' + currentNumOfAuthors;
        newLabel.className = "col-form-label col-md-2";
        newLabel.innerText = 'Autor ' + currentNumOfAuthors;
        rowDiv.appendChild(newLabel);
        //create containerDiv
        let containerDiv = document.createElement('div');
        containerDiv.id = "aboutAuthorInputs" + currentNumOfAuthors;
        containerDiv.className = "col-md-8";
        rowDiv.appendChild(containerDiv);
        // create rowDiv
        let innerRowDiv = document.createElement('div');
        innerRowDiv.className = "row";
        containerDiv.appendChild(innerRowDiv);
        // create divForNameInput
        let divForNameInput = document.createElement('div');
        divForNameInput.className = "col-md-5 me-lg-5";
        innerRowDiv.appendChild(divForNameInput);
        // create divForSurnameInput
        let divForSurnameInput = document.createElement('div');
        divForSurnameInput.className = "col-md-5 me-lg-5";
        innerRowDiv.appendChild(divForSurnameInput);
        // create inputName
        let inputName = document.createElement('input');
        inputName.id = "author" + currentNumOfAuthors + "Name";
        inputName.name = "name[]";
        inputName.className = "form-control";
        inputName.type = "text";
        inputName.placeholder = "Meno";
        inputName.required = true;
        divForNameInput.appendChild(inputName);
        // create inputSurname
        let inputSurname = document.createElement('input');
        inputSurname.id = "author" + currentNumOfAuthors + "Surname";
        inputSurname.name = "surname[]";
        inputSurname.className = "form-control";
        inputSurname.type = "text";
        inputSurname.placeholder = "Priezvisko";
        inputSurname.required = true;
        divForSurnameInput.appendChild(inputSurname);
    }
}
//
// <div class="row mt-3">
//     <label for="aboutAuthorInputs1" class="col-form-label col-md-2">Autor</label>
//     <div class="col-md-8" id="aboutAuthorInputs1">
//         <div class="row">
//             <div class="col-md-5 me-lg-5">
//                 <input class="form-control" id="author1Name" name="authorName1" type="text" placeholder="Meno" required>
//             </div>
//             <div class="col-md-5 ms-lg-5">
//                 <input class="form-control" id="author1Surname" name="authorSurname1" type="text" placeholder="Priezvisko" required>
//             </div>
//         </div>
//     </div>
// </div>