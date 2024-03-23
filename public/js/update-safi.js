let total_price = 0;
let total_weight = 0;
let total_count = 0;
let exist_price = 0
const tbody = document.getElementById("products_tbody");

initProduct(products_data)

function initProduct(products) {

    for(let i=0;i<products.length;i++){

        let products_total_price = products[i]['weight'] * products[i]['count'] * products[i]['fee']

        products[i]['in_table_id'] = "product" + products[i]['id']

        selected_product.push(products[i]['id'])

        fillTable(products[i]['id'],products[i]['product_name'],products[i]['weight'],products[i]['count'],addCommas(products[i]['fee']),addCommas(products_total_price))

        calculateTotalParameter(products_total_price,parseInt(products[i]['weight']),parseInt(products[i]['count']));
    }

    calculateExistPrice()
}

function setParamLoad() {
    let d = document.getElementById("select-loads").value
    if (d !== "0") {
        const myArray = d.split("|");

        let load_id = myArray[0].replace(/\s/g, '');
        let load_owner_name = myArray[1];
        let load_driver = myArray[2];


        document.getElementById("load_owner_name").value = load_owner_name;
        document.getElementById("load_id").value = load_id;
        document.getElementById("load_driver").value = load_driver;
    } else {
        document.getElementById("load_owner_name").value = null;
        document.getElementById("load_id").value = null;
        document.getElementById("load_driver").value = null;
    }
}

function setParamProducts() {
    let d = document.getElementById("select-products").value
    if (d !== "0") {
        const myArray = d.split("|");

        let product_id = myArray[0].replace(/\s/g, '');

        let product_name = myArray[1];

        document.getElementById("product_name").value = product_name;
        document.getElementById("product_id").value = product_id;
    } else {
        document.getElementById("product_name").value = null;
        document.getElementById("product_id").value = null;
    }
}

function freshProduct() {
    document.getElementById('select-products').selectedIndex = "0";
    document.getElementById("product_id").value = null;
    document.getElementById("product_name").value = null;
}

function isNumber(char) {
    if (typeof char !== 'string') {
        return false;
    }

    if (char.trim() === '') {
        return false;
    }
    return !isNaN(char);
}

function getProduct(base_url) {

    let product_id = document.getElementById("product_id").value;
    let load_id = document.getElementById("load_id").value;

    if (load_id && product_id) {

        sendAjaxRequest(base_url, load_id, product_id);

    } else {
        alert('یک بار و یک محصول انتخاب کنید')
    }
}

function sendAjaxRequest(base_url, load_id, product_id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", base_url + "/" + load_id + "/" + product_id);
    xhttp.getResponseHeader("Content-type", "application/json");

    xhttp.onload = function () {
        document.getElementById('searchBtn').disabled = true

        let json_data = this.responseText;
        let data = JSON.parse(json_data);

        for (let i = 0; i < data.length; i++) {
            if (!selected_product.includes(data[i]['id'])) {

                let products_total_price = data[i]['weight'] * data[i]['count'] * data[i]['fee']

                data[i]['in_table_id'] = "product" + data[i]['id']

                products_data.push(data[i])
                selected_product.push(data[i]['id'])

                fillTable(data[i]['id'], data[i]['product_name'], data[i]['weight'], data[i]['count'], data[i]['fee'])

                calculateTotalParameter(products_total_price, parseInt(data[i]['weight']), parseInt(data[i]['count']))
                console.log(selected_product)
            }
        }

        updateProductJson()

        freshProduct()

        calculateExistPrice()

        document.getElementById('searchBtn').disabled = false

    }
    xhttp.send();
}

function deleteProduct(element) {
    let id = element.id
    for (let i = 0; i < products_data.length; i++) {
        if (products_data[i]['in_table_id'] === id) {

            let this_product_total_price = products_data[i]['weight'] * products_data[i]['count'] * products_data[i]['fee']

            calculateTotalParameter(-this_product_total_price, -parseInt(products_data[i]['weight']), -parseInt(products_data[i]['count']))

            deleteProductIdFromSelectedProduct(products_data[i]['id']);

            products_data.splice(i, 1);

            calculateExistPrice()

            updateProductJson()

            element.remove();
            freshProduct();

            break
        }
    }

}

function deleteProductIdFromSelectedProduct(param) {
    const index = selected_product.indexOf(param);
    if (index > -1) {
        selected_product.splice(index, 1);
    }
}

function calculateExistPrice() {
    let do_price = document.getElementById('do_price').value
    let hire = document.getElementById('hire').value
    let discharge = document.getElementById('discharge').value
    let weighbridge = document.getElementById('weighbridge').value
    let handy = document.getElementById('handy').value

    let all_cost = parseInt(do_price) + parseInt(hire) + parseInt(discharge) + parseInt(weighbridge) + parseInt(handy);
    exist_price = total_price - all_cost

    document.getElementById('exist_price').style = "none"
    if (exist_price < 0) {
        document.getElementById('exist_price').style = "border : 1px solid red"
    }

    document.getElementById('exist_price').value = exist_price;
}

function updateProductJson() {
    products_json = JSON.stringify(products_data);
    document.getElementById('products_data').value = products_json;
}

function calculateTotalParameter(products_total_price, weight, count) {
    total_price = total_price + products_total_price;
    total_weight = total_weight + weight;
    total_count = total_count + count;

    document.getElementById("total_price").value = total_price;
    document.getElementById("total_weight").value = total_weight;
    document.getElementById("total_count").value = total_count;

    exist_price = exist_price + products_total_price
    document.getElementById("exist_price").value = addCommas(exist_price)
}

function fillTable(id, product_name, weight, count, fee) {
    tbody.innerHTML = tbody.innerHTML +
        "<tr id='product" + id + "'>" +
        "<th>" + product_name + "</th>" +
        "<th>" + weight + "</th>" +
        "<th>" + count + "</th>" +
        "<th>" + addCommas(fee) + "</th>" +
        "<th>" + addCommas(weight * count * fee) + "</th>" +
        "<th>" + "<a style='cursor: pointer;font-size: 20px;color: red;' onclick='deleteProduct(product" + id + ")'><i class=\"fa fa-trash \"></i></a>" + "</th>" +
        "</tr>";
}
