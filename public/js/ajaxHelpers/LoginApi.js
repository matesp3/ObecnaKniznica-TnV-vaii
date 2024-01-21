import {DataService} from "./DataService.js";

class LoginApi extends DataService{
    constructor(button) {
        super('login');

        // const button = document.getElementById('submitLogin');
        if (button != null) {
            button.onclick = async (e) => {
                await this.tryLogin(e);
            }
        }

    }

    async tryLogin(event) {
        // let loginInput = document.getElementById('login').value;
        // let passwordInput = document.getElementById('password').value;
        // let jsonData = await this.sendRequest(
        //     'login',
        //     'POST',
        //     200,
        //     {
        //         login: loginInput,
        //         password: passwordInput
        //     },
        //     false);
        // if (jsonData === true) // empty response
        //     return;
        // else if (jsonData === false) {
        //     const div = document.getElementById('loginFormTitle');
        //     div.innerHTML = div.innerHTML + `<span className="invalid"><i><small>
        //         Nastala nečakaná chyba pri kontrole prihlasovacích údajov! </small></i></span>`;
        //     event.preventDefault();
        //     return;
        // }
        // else { // there's some json
        //     const div = document.getElementById(jsonData.passed ? 'password' : 'login').parentElement;
        //     div.innerHTML = div.innerHTML + `<span className="invalid"><i><small> <?= 'Nesprávne zadané ' . ((jsonData.loginOk) ? 'heslo': 'prihlasovacie meno') . '!' ?> </small></i></span>`;
        //     event.preventDefault();
        // }
    }

}

export {LoginApi}