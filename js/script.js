let password = document.getElementById('form-pass');
password.addEventListener('keyup', validate);

let vpassword = document.getElementById('form-vpass');
vpassword.addEventListener('input', validate);

const inputs = document.querySelectorAll('form-field')



function validate(event) {

    let passex = /^(?=.*\d)[0-9a-zA-Z]{8,}$/;

    let uimsg = document.getElementById('uimsg');
    let uimsg2 = document.getElementById('uimsg2');
    let vpassElement = event.srcElement.attributes['id'].nodeValue;
    let subBtn = document.getElementById('left');

    var dis = (passex.test(password.value));

    uimsg.innerHTML = "Your password is " + ((passex.test(password.value)) ? "" : "not ") + "valid";
    uimsg.className = ((passex.test(password.value)) ? "valid" : "invalid");

    if (vpassElement == 'form-vpass') {
        if (vpassword.value != password.value || dis == false) {
            uimsg2.innerHTML = "Your passwords do not match";
            uimsg2.className = "invalid";
            subBtn.disabled = true;
        } else {
            uimsg2.innerHTML = "Your passwords do match";
            uimsg2.className = "valid";
            subBtn.disabled = false
        }
    }
}