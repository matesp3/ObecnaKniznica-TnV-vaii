
// import {LoginApi} from "./ajaxHelpers/LoginApi.js";

const unicodeSlovakLetters = "\u{C1}\u{C4}\u{C9}\u{CD}\u{D3}\u{D4}\u{DA}\u{DD}\u{E1}\u{E4}\u{E9}\u{ED}\u{F3}\u{F4}\u{FA}\u{FD}\u{10C}\u{10D}\u{10E}\u{10F}\u{139}\u{13A}\u{13D}\u{13E}\u{147}\u{148}\u{154}\u{155}\u{160}\u{161}\u{164}\u{165}\u{17D}\u{17E}";

window.onload = (event) => {
    async function sendRequest(controller, action, method, responseCode, body, onErrorReturn = null) {
        // Use exceptions to wrap the fetch call
        let baseUrl = "http://localhost?c=" + controller + "&a=" + action;
        try {
            // Bild up fetch and wait for response
            let response = await fetch(
                baseUrl,
                {
                    method: method,
                    body: JSON.stringify(body),
                    headers: { // Set headers for JSON communication
                        "Content-type": "application/json", // Send JSON
                        "Accept" : "application/json", // Accept only JSON as response
                    }
                });
            // If return code do not match our expected value throw error
            if (response.status !== responseCode )
                return onErrorReturn;
            // ak ocakavam json (chcem 200) -> 204 mi vrati pri tejto implementacii chybu
            // ak ocakavam empty (chcem 204) -> pri 200 (vrateni JSONU) mi vrati chybu pri takejto implementacii

            if (response.status === 204)
                return true;                   // nic neocakavam (204)
            else
                return await response.json();  // ocakavam json (200)
        } catch(ex) {
            // On any error just return error
            return onErrorReturn;
        }
    }

    async function tryLogin(event){
        let loginInput = document.getElementById('login').value;
        let passwordInput = document.getElementById('password').value;

        let data = await sendRequest(
            'login',
            'login',
            'POST',
            204,
            {
                login: loginInput,
                password: passwordInput
            },
            false);

        const div = document.getElementById('formErrorMessages');
        if (typeof data === "undefined") {
            div.innerHTML = div.innerHTML + `<span><i><small>"Chyba! UNDEFINED returned" </small></i></span>`;
            throw new Error('Controller returned UNDEFINED value!');
        }
        if (typeof data === "boolean") {
            // div.innerHTML = div.innerHTML + `<span className="invalid"><i><small>"BOOLEAN->${data}" Ok? </small></i></span>`;
            if (data === false) {
                event.preventDefault();
                document.getElementById('login').value = '';
                document.getElementById('password').value = '';
                div.innerHTML = `<span><i><small>Prihlásenie neúspešné! </small></i></span>`;
                div.firstChild.style.color = 'var(--myVar-invalid)';
            }
            else {
                window.location.href = "http://localhost/?c=home&a=index";
                // location.replace("http://localhost/?c=home&a=index");
                div.innerHTML = `<span><i><small>OK.. </small></i></span>`;
                div.firstChild.style.color = 'var(--myVar-valid)';
            }
        }
        // if (typeof data === "object" && data != null) {
        //     div.innerHTML = div.innerHTML + `<span className="invalid"><i><small>JSON data { ${data} }</small></i></span>`;
        // }
    }

    async function validateRegistration(event){
        let nameInput = document.getElementById('reg-name').value;
        let surnameInput = document.getElementById('reg-surname').value;
        let loginInput = document.getElementById('reg-login').value;
        let passwordInput = document.getElementById('reg-password').value;
        let passwordInput2 = document.getElementById('reg-password2').value;

        let data = await sendRequest(
            'user',
            'checkUserInputs',
            'POST',
            200,
            {
                login:        loginInput,
                password:     passwordInput,
                password2:    passwordInput2,
                name:         nameInput,
                surname:      surnameInput
            },
            false);

        const div = document.getElementById('registrationWrapper');
        if (typeof data === "undefined" || (typeof data === "boolean" && data === false)) {
            div.innerHTML = `<div class="invalid-feedback"> Pri prihlasovaní došlo k chybe!</div><br>` + div.innerHTML;
        }
        if (typeof data === "object" && data != null) {  // response 200
            if (data.response != null && data.response === false) {
                div.innerHTML = `<div class="invalid-feedback"> Pri prihlasovaní došlo k chybe!</div><br>` + div.innerHTML;
                return;
            }
            let allOk = proccessServerRegistrationResponse(data);

            if (allOk) {
                div.innerHTML = `<span><i><small> Registrácia prebehle úspešne! </small></i></span>`;
                div.firstChild.style.color = 'var(--myVar-valid)';
                window.location.href = "http://localhost/?c=catalogue&a=index";
                // location.replace("http://localhost/?c=home&a=index");
            }
        }
    }

    async function reserveBook(event){
        const button =  event.target;
        const availabilityElement = button.parentElement.firstChild.firstChild;

            let data = await sendRequest(
            '',
            'checkUserInputs',
            'POST',
            204,
            {
                bookItemId: button.firstChild.value,
            },
            false);

        const div = document.getElementById('registrationWrapper');
        if (typeof data === "boolean" && data === false) {
            div.innerHTML = `<div class="invalid-feedback"> Pri rezervácii došlo k chybe!</div><br>` + div.innerHTML;
            return;
        }
        if (typeof data == "boolean" && data === true) {  // response 204
            let countOfAvail = getPosition(':',availabilityElement.innerText);
            if (typeof countOfAvail != "undefined") {
                const newNum = parseInt(countOfAvail) - 1;
                if (newNum >= 0) {
                    availabilityElement.innerText = 'Dostupných:' + newNum;
                }

            }
        }
    }

    function proccessServerRegistrationResponse(jsonBody) {
        // `<div class="${data.name ? '' : 'in'}valid-feedback"> </div>`
        let allOk = true;
        if (!jsonBody.name) {
            const nameParent = document.getElementById('reg-name').parentElement;
            nameParent.innerHTML = nameParent.innerHTML + `<div class="invalid-feedback"> Meno v nesprávnom formáte!</div>`
            allOk = false;
        }
        if (!jsonBody.surname) {
            const nameParent = document.getElementById('reg-surname').parentElement;
            nameParent.innerHTML = nameParent.innerHTML + `<div class="invalid-feedback"> Priezvisko v nesprávnom formáte!</div>`
            allOk = false;
        }
        if (!jsonBody.login) {
            const nameParent = document.getElementById('reg-login').parentElement;
            nameParent.innerHTML = nameParent.innerHTML + `<div class="invalid-feedback"> Nesprávny alebo existujúci login!</div>`
            allOk = false;
        }
        if (!jsonBody.password) {
            const nameParent = document.getElementById('reg-password').parentElement;
            nameParent.innerHTML = nameParent.innerHTML + `<div class="invalid-feedback"> Heslo v nesprávnom formáte!</div>`
            allOk = false;
        }
        if (!jsonBody.password2) {
            const nameParent = document.getElementById('reg-password2').parentElement;
            nameParent.innerHTML = nameParent.innerHTML + `<div class="invalid-feedback"> Heslá sa nezhodujú!</div>`
            allOk = false;
        }
        return allOk;
    }

    function checkFileSize() {
        const fileInput = document.getElementById('bookPictureInput');
        if (fileInput != null) {
            const infoElement = document.getElementById('fInfo');

            if (fileInput.files.length > 0) {
                let fSize = fileInput.files.item(0).size / Math.pow(2,20); // 2^20 bytov - 1 MB
                fSize = Math.round(fSize * 100) / 100;
                infoElement.textContent = `Veľkosť nového obrázka: ${fSize} MB`
                infoElement.style.color = "var(--myVar-valid)";
            }
            else {
                infoElement.textContent = "Obrázok nebol vybraný/zmenený."
                infoElement.style.color = "var(--myVar-alert)";
            }
        }
    }

    function getPosition(precedingChar, identificator) {
        const params = identificator.toString().split(precedingChar);
        const position = params[1];
        if (position != null)
            return position;
        return undefined;
    }
    function renameIdsOfDeleteButtonsIfNeeded(startId) {
        if (startId <= 0)
            return;
        const buttons = document.getElementsByClassName('deleteButton');
        const count = buttons?.length;
        if (count === undefined) // undefined in case of buttons var was null
            return;

        for (let i = startId; i < count + 1; i++) {
            let currentBtn = buttons[i - 1]; // need to remember them, before renaming...
            const pos = getPosition("-", currentBtn.id);
            if (pos !== undefined) {
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
                currentLabel.textContent = `Autor (${i})`;
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
        if (deleteButtons.length === 1) {
            delButtons[0].style.display = "none";
        }
    }

    function addAuthorInputs() {
        const delButtons = document.getElementsByClassName('deleteButton');
        if (deleteButtons == null)
            return;
        if (deleteButtons.length === 1) {
            delButtons[0].style.display = "block"; // now, we can display it, because there's going to be at least two authors
        }

        const container = document.getElementById('authorsOfBookContainer');
        const currentNumOfAuthors = (container.children.length / 2) + 1; // divided by to due to labels children
        // create label
        let newLabel = document.createElement('label');
        newLabel.htmlFor = 'aboutAuthorInputs-' + currentNumOfAuthors;
        newLabel.className = "col-form-label col-md-2 mt-3";
        newLabel.innerText = `Autor (${currentNumOfAuthors})`;
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
        inputName.pattern = `^[a-zA-Z${unicodeSlovakLetters}].*`;
        divForNameInput.appendChild(inputName);
        // create inputSurname
        let inputSurname = document.createElement('input');
        inputSurname.id = "aSurname-" + currentNumOfAuthors;
        inputSurname.name = "surname-" + currentNumOfAuthors;
        inputSurname.className = "form-control";
        inputSurname.type = "text";
        inputSurname.placeholder = "Priezvisko";
        inputSurname.required = true;
        inputSurname.pattern = `^[a-zA-Z${unicodeSlovakLetters}].*`;
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

    //--------------- end of function definitions -----------------//

    // ------- initialization of page ------------- //

    let deleteButtons = document.getElementsByClassName('deleteButton');
    if (deleteButtons != null && deleteButtons.length > 0) {
        if (deleteButtons.length === 1)
            deleteButtons[0].style.display = "none"; // if there's only one, the delete button should not be displayed

        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', (e) => { deleteAuthorInputs(e); } );
        }
    }

    let addAuthorBtn = document.getElementById('btnAddAnotherAuthor');
    if (addAuthorBtn != null)
        addAuthorBtn.onclick = () => { addAuthorInputs(); };


    const tableHours = document.getElementById('tableHours');
    let dayPosition = new Date().getDay();
    if (tableHours != null && dayPosition !== 0) {
        let tbody = tableHours.childNodes.item(1).childNodes;
        let td = tbody.item(2 * (dayPosition - 1)).style.fontWeight = 'bold'; //2,4,6
    }

    const fileInput = document.getElementById('bookPictureInput');
    if (fileInput != null) {
        fileInput.onchange = () => { checkFileSize(); };
    }

    const formLogin = document.getElementById('formLogin');
    if (formLogin != null)
    {
        formLogin.addEventListener("submit",  async (event) => {
            event.preventDefault();
            await tryLogin(event);
            return false;
        });
    }

    const formRegistration = document.getElementById('formRegistration');
    if (formRegistration != null)
    {
        formRegistration.addEventListener("submit",  async (event) => {
            event.preventDefault();
            await validateRegistration(event);
            return false;
        });
    }

    const bookContainer = document.getElementById('containerOfBooks');
    if (bookContainer != null) {
        const reserveButtons = document.getElementsByClassName('btnReserve');
        for (let i = 0; i < reserveButtons.length; i++) {
            reserveButtons[i].addEventListener("onclick", async (event) => {
                event.preventDefault();
                await reserveBook(event);
                return false;
            });
        }
    }

}