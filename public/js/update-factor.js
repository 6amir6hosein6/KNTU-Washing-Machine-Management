let id = 0;
let total_price = 0;
let total_weight = 0;
const tbody = document.getElementById("products_tbody");

initProduct(products_data)
calculatePaid();
calculateWorkerPaid();


function initProduct(products) {

    for(let i=0;i<products.length;i++){
        id = id + 1;

        let products_total = products[i]['weight'] * products[i]['count'] * products[i]['fee']

        products[i]['in_table_id'] = "product" + id

        fillTable(id,products[i]['product_name'],products[i]['weight'],products[i]['count'],addCommas(products[i]['fee']),addCommas(products_total))

        totalParamCalculation(products_total,products[i]['weight']);
    }
}

function setParamLoad() {
    let d = document.getElementById("select-loads").value
    console.log(d)
    if (d !== "0") {
        const myArray = d.split("|");
        let description = myArray[1];
        let load_id = myArray[0].replace(/\s/g, '');

        document.getElementById("load_description").value = description;
        document.getElementById("load_id").value = load_id;
    } else {
        document.getElementById("load_description").value = null;
        document.getElementById("load_id").value = null;
    }
}

function setParamProducts() {
    let d = document.getElementById("select-products").value
    if (d !== "0") {
        const myArray = d.split("|");
        let product_name = myArray[1];
        let product_id = myArray[0].replace(/\s/g, '');

        document.getElementById("product_name").value = product_name;
        document.getElementById("product_id").value = product_id;
    } else {
        document.getElementById("product_name").value = null;
        document.getElementById("product_id").value = null;
    }
}

function freshProduct(){
    document.getElementById('select-products').selectedIndex = "0";

    document.getElementById("product_id").value = null;
    document.getElementById("product_name").value = null;

    document.getElementById("weight").value = 0;
    document.getElementById("count").value = 0;
    document.getElementById("fee").value = 0;
    document.getElementById("total").value = 0;
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


function totalCalculate() {
    let weight = document.getElementById("weight").value
    let count = document.getElementById("count").value
    let fee = document.getElementById("fee").value

    if (isNumber(weight) && isNumber(count) && isNumber(fee)) {
        document.getElementById("total").value = addCommas(weight * count * fee);
    }
}

function addProduct() {
    id = id + 1;

    let product_name = document.getElementById('product_name').value;
    let product_id = document.getElementById('product_id').value;
    let weight = document.getElementById('weight').value;
    let count = document.getElementById('count').value;
    let fee = document.getElementById('fee').value;

    if (product_name) {
        if (isNumber(weight) && isNumber(count) && isNumber(fee)){
            let dict = {
                product_id: product_id,
                product_name: product_name,
                weight: weight,
                count: count,
                fee: fee,
                in_table_id: "product" + id
            };

            products_data.push(dict)
            products_json = JSON.stringify(products_data);

            document.getElementById('products_data').value = products_json;

            fillTable(id,product_name,weight,count,fee);

            let total_products_price = weight * count * fee
            totalParamCalculation(total_products_price,parseInt(weight))

            freshProduct();
        }else {
            alert('مقادیر وزن ، تعداد ، فی به درستی وارد نشده اند')
        }
    }else{
        alert('محصولی انتخاب نشده است')
    }
}

function deleteProduct(element){
    let id = element.id
    for (let i=0;i<products_data.length;i++){
        if(products_data[i]['in_table_id'] === id){
            total_price = total_price - products_data[i]['weight'] * products_data[i]['count'] * products_data[i]['fee'];
            total_weight = total_weight - parseInt(products_data[i]['weight']);

            total_debt = total_debt - products_data[i]['weight'] * products_data[i]['count'] * products_data[i]['fee']
            document.getElementById("total_debt").value = addCommas(total_debt);
            document.getElementById("exist_price").value = addCommas(total_debt);

            products_data.splice(i, 1);
            break
        }
    }

    document.getElementById("total_price").value = addCommas(total_price);
    document.getElementById("total_weight").value = addCommas(total_weight);

    products_json = JSON.stringify(products_data);

    document.getElementById('products_data').value = products_json;

    element.remove();
    freshProduct();
}

function fillTable(id,product_name,weight,count,fee){
    tbody.innerHTML = tbody.innerHTML +
        "<tr id='product" + id + "'>" +
        "<th>" + product_name + "</th>" +
        "<th>" + weight + "</th>" +
        "<th>" + count + "</th>" +
        "<th>" + addCommas(fee) + "</th>" +
        "<th>" + addCommas(weight * count * fee) + "</th>" +
        "<th>" + "<a style='cursor: pointer;font-size: 20px;color: red;' onclick='deleteProduct(product"+ id +")'><i class=\"fa fa-trash \"></i></a>"  + "</th>" +
        "</tr>";
}

function totalParamCalculation(products_total,weight){
    total_price = total_price + products_total;
    total_weight = total_weight + parseInt(weight);

    document.getElementById("total_price").value = addCommas(total_price);
    document.getElementById("total_weight").value = addCommas(total_weight);

    total_debt = total_debt + products_total
    document.getElementById("total_debt").value = addCommas(total_debt)
    document.getElementById("exist_price").value = addCommas(total_debt)
}

function calculateWorkerPaid(){
    let debt = parseInt(document.getElementById("debt").value);
    let worker_paid = parseInt(document.getElementById("worker_paid").value);
    let paid = parseInt(document.getElementById("paid").value);
    total_debt = total_price + debt + worker_paid - paid;
    document.getElementById("total_debt").value = addCommas(total_debt);
    document.getElementById("exist_price").value = addCommas(total_debt);
}

function calculatePaid(){
    let debt = parseInt(document.getElementById("debt").value);
    let paid = parseInt(document.getElementById("paid").value);
    let worker_paid = parseInt(document.getElementById("worker_paid").value);
    total_debt = total_price + debt + worker_paid - paid;
    document.getElementById("exist_price").value = addCommas(total_debt);
}

