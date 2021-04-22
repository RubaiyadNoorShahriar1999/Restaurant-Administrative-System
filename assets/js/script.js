function validateEmail(email) {
    var emailreg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var errMsgElem = email.parentElement.nextElementSibling;

    if (email.value.length === 0) {
        email.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Email can't be empty";

        return;
    } else if (email.value.length === 0) {
        email.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";

        return;
    }

    if (!emailreg.test(email.value)) {
        email.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Invalid email address";

        return;
    } else {
        email.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    //   console.log(emailreg.test(email.value));
    //   console.dir(email.parentElement.parentElement);
    //   console.dir(errMsgElem);
}

function validatePassword(pass) {
    var passwordReg = /[@\|#\|$\|%]/;
    var errMsgElem = pass.parentElement.nextElementSibling;
    var cpassword = document.getElementById("cpassword");

    if (pass.value.length === 0) {
        pass.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Password can't be empty";

        if (cpassword) {
            validateCPassword(cpassword);
        }

        return;
    } else if (pass.value.length > 0) {
        pass.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    if (passwordReg.test(pass.value) && pass.value.length >= 8) {
        pass.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        pass.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText =
            "Password must be larger than 8 character, include at least one of them (@, #, $, %)";
    }

    if (cpassword) {
        validateCPassword(cpassword);
    }
}

function validateName(name) {
    var nameReg = /[a-zA-z0-9-_]/;
    var errMsgElem = name.parentElement.nextElementSibling;

    if (name.value.length === 0) {
        name.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Name can't be empty";

        return;
    } else if (name.value.length > 0) {
        name.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    if (nameReg.test(name.value) && name.value.length >= 2) {
        name.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        name.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Name must be larger than 2 character, should be alphanumeric";
    }

}

function validateWorker(type) {
    var typeReg = /[a-zA-z-_]/;
    var errMsgElem = type.parentElement.nextElementSibling;

    if (type.value.length === 0 && type.value.length <=3 ) {
        type.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Worker type can't be empty";

        return;
    // } else if (type.value.length >= 4) {
    //     type.classList.remove("error");
    //     errMsgElem.classList.remove("error-message");
    //     errMsgElem.innerText = "";
    }else if (type.value.length >= 2) {
        type.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    if (typeReg.test(type.value) && type.value.length >= 4) {
        type.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        type.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Worker type must be larger than 4 characters";
    }

}


function validateLocation(location) {
    var errMsgElem = location.parentElement.nextElementSibling;

    if (location.value.length === 0) {
        location.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Loaction can't be empty";
    } else if (location.value.length >= 4) {
        location.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

}

function validatePhone(phone) {
    var typeReg = /[0-9-_]/;
    var errMsgElem = phone.parentElement.nextElementSibling;

    if (phone.value.length === 0) {
        phone.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Phone can't be empty";
    } else if (phone.value.length === 11) {
        phone.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    if (typeReg.test(phone.value) && phone.value.length === 11) {
        phone.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        phone.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Worker phone must be 11 characters";
    }


}
function validateRID(rid) {
    var typeReg = /[0-9-_]/;
    var errMsgElem = rid.parentElement.nextElementSibling;

    if (rid.value.length === 0) {
        rid.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Restaurant ID can't be empty";
    } else if (rid.value.length > 0) {
        rid.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    // if (typeReg.test(rid.value) && rid.value.length > 0) {
    //     rid.classList.remove("error");
    //     errMsgElem.classList.remove("error-message");
    //     errMsgElem.innerText = "";
    // } else {
    //     rid.classList.add("error");
    //     errMsgElem.classList.add("error-message");
    //     errMsgElem.innerText = "Restaurant ID must be  more than 2 characters";
    // }


}
function validateWID(wid) {
    var typeReg = /[0-9-_]/;
    var errMsgElem = wid.parentElement.nextElementSibling;

    // if (wid.value.length === 0) {
    //     wid.classList.add("error");
    //     errMsgElem.classList.add("error-message");
    //     errMsgElem.innerText = "Restaurant ID can't be empty";
    // } else if (wid.value.length >2) {
    //     wid.classList.remove("error");
    //     errMsgElem.classList.remove("error-message");
    //     errMsgElem.innerText = "";
    // }

    if (typeReg.test(wid.value) && wid.value.length > 2) {
        wid.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        wid.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Worker ID must be numeric and more than 2 characters";
    }


}

function validateNID(nid) {
    var errMsgElem = nid.parentElement.nextElementSibling;

    if (nid.value.length === 0) {
        nid.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "NID can't be empty";
    } else if (nid.value.length !== 10) {
        nid.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "NID can't be less or greater than 10 charecters";
    } else if (nid.value.length === 10) {
        nid.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

}

function validateCPassword(cpassword) {
    var errMsgElem = cpassword.parentElement.nextElementSibling;
    var pass = document.querySelector("input#password");

    if (pass.value !== cpassword.value) {
        cpassword.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Passwords don't match";
    } else {
        cpassword.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }
}

function validateLoginPassword(pass) {
    var errMsgElem = pass.parentElement.nextElementSibling;

    if (pass.value.length === 0) {
        pass.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Password can't be empty";
    } else {
        pass.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }
}

function validateNPassword(npassword) {
    var passwordReg = /[@\|#\|$\|%]/;
    var errMsgElem = npassword.parentElement.nextElementSibling;
    var ccpassword = document.getElementById("ccpassword");

    if (npassword.value.length === 0) {
        npassword.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Password can't be empty";

        if (ccpassword) {
            validateCCPassword(ccpassword);
        }

        return;
    } else if (npassword.value.length > 0) {
        npassword.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }

    if (passwordReg.test(npassword.value) && npassword.value.length >= 8) {
        npassword.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    } else {
        npassword.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText =
            "Password must be larger than 8 character, include at least one of them (@, #, $, %)";
    }

    if (ccpassword) {
        validateCCPassword(ccpassword);
    }
}

function validateCCPassword(ccpassword) {
    var errMsgElem = ccpassword.parentElement.nextElementSibling;
    var password = document.querySelector("input#npassword");

    if (password.value !== ccpassword.value) {
        ccpassword.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Passwords don't match";
    } else {
        ccpassword.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }
}

function validateCurrentPass(currPass) {
    var errMsgElem = currPass.parentElement.nextElementSibling;

    if (currPass.value.length === 0) {
        currPass.classList.add("error");
        errMsgElem.classList.add("error-message");
        errMsgElem.innerText = "Current Password can't be empty";
    } else {
        currPass.classList.remove("error");
        errMsgElem.classList.remove("error-message");
        errMsgElem.innerText = "";
    }
}


function validateBeforeSubmit(form) {
    var inputs = form.querySelectorAll("input:not(input[type=\"radio\"]");
    // var radios = form.querySelectorAll("input[type=\"radio\"");

    // console.log(inputs);
    document.addEventListener("submit", function (e) {
        e.preventDefault();

        var isError = false;

        for (var i = 1; i < inputs.length; i++) {
            var element = inputs[i];
            var errMsgElem = inputs[i].parentElement.nextElementSibling;

            // console.log(errMsgElem);
            if (element.getAttribute("type") !== "hidden") {
                // console.log(element);
                if (inputs[i].value.length === 0) {
                    isError = true;
                    element.classList.add("error");
                    errMsgElem.classList.add("error-message");
                    errMsgElem.innerText = "Can't be empty";
                } else if (inputs[i].value.length > 0) {
                    // isError = false;
                    element.classList.remove("error");
                    errMsgElem.classList.remove("error-message");
                    errMsgElem.innerText = "";
                }
            }
        }
        // console.log(isError)
        // console.log(typeof form === "object")
        // console.log(arguments)
        // console.log(form.submit())

        if (!isError) {
            // HTMLFormElement.prototype.submit.call(form)
            // form.submit();
            form.submit();
        }
    });
}


for (const form of document.forms) {
    validateBeforeSubmit(form);
}

// var isConfirm = confirm("Are you Sure?");
// console.log(isConfirm);


// }
// console.log(btndelete);

//Ajax

var viewMTable = document.querySelector("table#view-mngmnt");
// var search = document.querySelector("form#view-management").search;
if (viewMTable) {
    // search.addEventListener("click", getManagementData);

    function getManagementData() {
        // if(e) {
        //     e.preventDefault();
        var form = document.querySelector("form#view-management");
        var searchInput = form.searchinput.value;
        var sortBy = form.sortby.value;
        // }
        // var search = form.search.value;
        var xhttp = new XMLHttpRequest();
        // var jsonData = "";

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var jsonData = JSON.parse(this.responseText);
                // console.log(JSON.parse(this.responseText));

                // template string
                // if(!jsonData['message']) {
                    var render = `
                        <tr>
                            <th>Work ID</th>
                            <th>Work Type</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>NID</th>
                            <th>Actions</th>
                        </tr>
                    `;

                    if(jsonData.length === 0) {
                        render = `
                            <tr class="errors-list">
                                <td style="text-align:center;">!! No data found</td>
                            </tr>
                        `;
                    }

                    for(var i = 0; i < jsonData.length; ++i) {
                        render += `
                            <tr>
                                <td>${jsonData[i]['w_id']}</td>
                                <td>${jsonData[i]['w_type']}</td>
                                <td>${jsonData[i]['email']}</td>
                                <td>${jsonData[i]['phone']}</td>
                                <td>${jsonData[i]['NID']}</td>
                                <td style="text-align:center;">
                                    <a id="btn-delete" class="btn btn-delete" href="./controller/deletemanagement.php?id=${jsonData[i]['w_id']}" onclick="confirmDelete(this)">Delete</a>
                                </td>
                            </tr>
                        `;
                    }

                    viewMTable.innerHTML = render;
                // } else {
                //     alert(jsonData['message']);
                // }
            }

            // console.log(render)
        };
        xhttp.open("GET", `./controller/viewmanagement.php?searchinput=${searchInput}&sortby=${sortBy}`, true);
        xhttp.send();

        // console.dir(searchInput);
        // console.dir(sortBy);
        // console.dir(search);
        return;
    }

    var getAllData = true;
    if (getAllData) {
        getManagementData();
        getAllData = false;
    }
    var btndelete = document.querySelector("#btn-delete");
    console.log(btndelete);
} else {
    function getManagementData() { }
}

function confirmDelete(btn) {
    if(!confirm("Are you sure you want to delete?")) {
        document.addEventListener("click", function (e) {
            e.preventDefault();
        })
    } else {
        btn.click();
    }
    // console.log(btn);
}