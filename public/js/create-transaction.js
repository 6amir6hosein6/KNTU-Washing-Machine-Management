function setParam() {
    let d = document.getElementById("select-customer").value
    if (d !== "0") {
        const myArray = d.split("|");
        let name = myArray[0];
        let id = myArray[1].replace(/\s/g, '');
        let debt = myArray[2].replace(/\s/g, '');

        document.getElementById("customer_name").value = name;
        document.getElementById("customer_id").value = id;
        document.getElementById("debt").value = addCommas(debt);

    } else {
        document.getElementById("customer_name").value = null;
        document.getElementById("customer_id").value = null;
        document.getElementById("debt").value = null;
    }
}

