$(document).ready(function(){
    $('input.product').on(function(){
   CalculateItemsValue();
    });
});


        function percentage(num, per)
        {
            return (num/100)*per;
        }

        function CalculateItemsValue() {
            var total_items = 1;
            var total = 0.00;
            var noVatTotal = 0.00;
            for (i=1; i<=total_items; i++) {

                amountID = document.getElementById("amount"+i);
                priceID = document.getElementById("price"+i);
                vatID = document.getElementById("vat"+i);

                noVatTotal[i] = total + parseInt(amountID.innerText) * parseInt(priceID.innerText);
                total[i] = percentage(noVatTotal[i], parseInt(vatID.innerText))
                document.getElementById("Total"+i).innerHTML = "€" + total[i];

            }
            document.getElementById("ItemsTotal").innerHTML = "€" + total;

        }

