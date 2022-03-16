document.addEventListener('DOMContentLoaded', () => {

    // adding event listeners:
    // search form
    let searchForm = document.getElementById("search_form");
    searchForm.addEventListener("submit", e => {
        e.preventDefault(); // don't reload page
        let req = new XMLHttpRequest();
        // pass search word into url
        req.open("GET", "api/search.php?search_word=" + document.getElementById("search_word").value, true);
        req.send();
        req.onreadystatechange = () => {
            if (req.readyState == 4 && req.status == "200") {
                if (req.responseText !== "0") {
                    // if something found make table from result
                    let response = JSON.parse(req.responseText);
                    document.querySelector("p").innerText = "";
                    generateTable(response);
                } else {
                    // if nothing found show message
                    document.querySelector("p").innerText = "Nothing found";
                    clearTable();
                    console.log("Nothing found");
                }
            }
        }
    });

    // create form
    let createForm = document.getElementById("create_form");
    createForm.addEventListener("submit", e => {
        e.preventDefault(); // don't reload page
        let formData = new FormData(createForm); // get the data from the form
        let req = new XMLHttpRequest();
        req.open("POST", "api/create.php", true);
        req.send(formData); // send the form data in the request body
        req.onreadystatechange = () => {
            if (req.readyState == 4 && req.status == "200") {
                createForm.reset(); // clear inputs
                formData = undefined;
                console.log(req.responseText); // log message
                document.getElementById("read_all_button").click(); // refresh table
            }
        }
    });

    // update form
    let updateForm = document.getElementById("update_form");
    updateForm.addEventListener("submit", e => {
        e.preventDefault(); // dont reload page
        let formData = new FormData(updateForm); // get the data from the form
        let req = new XMLHttpRequest();
        req.open("POST", "api/update.php", true);
        req.send(formData); // send the form data in the request body
        req.onreadystatechange = () => {
            if (req.readyState == 4 && req.status == "200") {
                updateForm.reset(); // clear inputs
                console.log(req.responseText); // log message
                document.getElementById("read_all_button").click(); // refresh table
            }
        }
    });

    // READ all and show table
    document.getElementById("read_all_button").onclick = () => {
        let req = new XMLHttpRequest();
        req.open("GET", "api/read_all.php", true);
        req.send();
        req.onload = () => {
            let response = JSON.parse(req.responseText); // convert response JSON string into JSON object
            generateTable(response);
        }
    };

    // show SEARCH form
    document.getElementById("search_button").onclick = () => {
        hideAllForms(); // hide all forms
        let form = document.getElementById("search_form");
        form.style.display = "";
    };

    // show CREATE form
    document.getElementById("create_button").onclick = () => {
        hideAllForms(); // hide all forms
        let form = document.getElementById("create_form");
        form.style.display = "";
    };

    // show UPDATE form
    document.getElementById("update_button").onclick = () => {
        hideAllForms();
        let form = document.getElementById("update_form");
        form.style.display = "";
    };

    // show DELETE form
    document.getElementById("delete_button").onclick = () => {
        hideAllForms();
        let form = document.getElementById("delete_form");
        form.style.display = "";
        // show table to see what can be deleted
        let req = new XMLHttpRequest();
        req.open("GET", "api/read_all.php", true);
        req.send();
        req.onload = () => {
            createDropdown(JSON.parse(req.responseText)); // create the dropdown to choose what to delete
            document.getElementById("read_all_button").click(); // refresh table
        }
    };

    // functions:
    // generates the table and fills it with the given data
    function generateTable(data) {
        let table = document.querySelector("table");
        table.style.display = "";
        clearTable(); // delete old table data
        // populate table
        for (let element of data) {
            let row = table.insertRow();
            for (key in element) {
                let cell = row.insertCell();
                let text = document.createTextNode(element[key]);
                cell.appendChild(text);
            }
        }
    }

    // clears the table
    function clearTable() {
        let table = document.querySelector("table");
        table.style.display = "";
        if (table.rows.length > 1) {
            while (table.rows.length > 1) {
                table.deleteRow(table.rows.length - 1);
            }
        }
    }

    // dynamically create dropdown for DELETE
    function createDropdown(data) {
        let dropdownArea = document.querySelector("select");
        // fill dropdown list with the ids from the DB
        for (let element of data) {
            let option = document.createElement("option");
            option.value = element.car_id;
            option.text = element.car_id;
            dropdownArea.appendChild(option);
        }
        // delete element from DB and dropdownlist when an id is selected
        dropdownArea.onchange = function() {
            let form = document.getElementById("delete_form");
            let formData = new FormData(form); // get form data
            let req = new XMLHttpRequest();
            req.open("POST", "api/delete.php", true);
            req.send(formData); // send id to be deleted
            req.onload = () => {
                dropdownArea.remove(this.selectedIndex); // remove deleted element from list
                console.log(req.responseText); // log message
                document.getElementById("read_all_button").click(); // refresh table
            }
        }
    }

    // hides all of the forms
    function hideAllForms() {
        let forms = document.querySelectorAll("form");
        forms.forEach(element => {
            element.style.display = "none";
        });
    }
});