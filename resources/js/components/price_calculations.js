$(document).ready(function () {
    $('.product').click(function () {
        $('.product').click(function () {

        });
        CalculateItemsValue();
    });
});

$(document).ready(function () {
    $('.new-product').click(function () {
        $('.new-product').click(function () {

        });
        addItem();
    });
});

itemsID = document.getElementById("total_items")
var total_items = parseInt(itemsID.value);

function addItem() {
    tableID = document.getElementById("order-table");

    total_items++
    document.getElementById("total_items").value = total_items;
    var newFields = document.getElementById('table-rows').cloneNode(true);
    newFields.id = '';


    var newRows = newFields.querySelectorAll('.copy');
    console.log(newRows)

    for (var i=0;i<newRows.length;i++) {
        var theName = newRows[i].name
        if (theName)
            newRows[i].name = theName.replace('1', total_items);
        var theId = newRows[i].id
        if (theId)
            newRows[i].id = theId.replace('1', total_items);
        var theValue = newRows[i].value
        if (theValue)
            newRows[i].Value = '';
        var theClass = newRows[i].class
    }


    var insertHere = document.getElementById('table-rows');
    insertHere.parentNode.insertBefore(newFields,insertHere);
}



function roundTo(n, digits) {
    if (digits === undefined) {
        digits = 0;
    }

    var multiplicator = Math.pow(10, digits);
    n = parseFloat((n * multiplicator).toFixed(11));
    n = (Math.round(n) / multiplicator).toFixed(2);
    return n;
}

function vatPercentage(num, per) {
    let Amount = num / 100 * per;
    return roundTo(Amount, 2);
}



function CalculateItemsValue() {



    var total = [0.00];
    var noVatTotal = [0.00];
    var vat = [0.00];
    var subtotal = 0.00;
    var discountAmount = 0.00

    for (i = 1; i <= total_items; i++) {
        amountID = document.getElementById("amount" + i);
        priceID = document.getElementById("price" + i);
        vatID = document.getElementById("vat" + i);
        noVatTotal[i] = roundTo(parseFloat(amountID.value) * parseFloat(priceID.value), 2);
        vat[i] = vatPercentage(noVatTotal[i], parseFloat(vatID.value));
        total[i] = roundTo(parseFloat(noVatTotal[i]) + parseFloat(vat[i]), 2);
        if(total[i] !== 'NaN'){
            document.getElementById("total" + i).innerHTML = "€" + total[i];
            subtotal = parseFloat(subtotal) + parseFloat(total[i]);
        }

    }

    discountID = document.getElementById("discount");

    discountAmount = vatPercentage(subtotal, parseFloat(discountID.value));
    if(parseFloat(discountID.value) !== 'NaN') {
        document.getElementById("discount-price").innerHTML = parseFloat(discountID.value) + "% Discount -€" + parseFloat(discountAmount);
    }
    subtotal = roundTo(parseFloat(subtotal) - parseFloat(discountAmount), 2);
    console.log(subtotal)
    if(subtotal !== 'NaN') {
        document.getElementById("subtotal").innerHTML = "Subtotal €" + subtotal;
    }
    if(subtotal !== 'NaN') {
        document.getElementById("total").innerHTML = "total €" + subtotal;
    }
    document.getElementById("total_items").value = total_items;
}


