$(document).ready(function() {
    //on click plus button
    $('.btn-plus').click(function() {
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').html());
            $qty = Number($parentNode.find('#qty').val());
            $total = $price * $qty;
            $parentNode.find('#total').html($total);
            sumPriceTotal();
        })
        //on click minus button
    $('.btn-minus').click(function() {
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').html());
            $qty = Number($parentNode.find('#qty').val());
            $total = $price * $qty;
            $parentNode.find('#total').html($total);

            sumPriceTotal();
        })
        //on click remove button
    $('.btnRemove').click(function() {
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $orderId = $parentNode.find('#orderId').val();
            console.log($productId);
            $parentNode.remove();
            sumPriceTotal();
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clear/currProduct',
                data: { 'productId': $productId, 'orderId': $orderId },
                dataType: 'json',

            });

        })
        //master sum function button
    function sumPriceTotal() {
        $subTotal = 0;
        $('#dataBody tr').each(function(index, row) {
            $subTotal += Number($(row).find('#total').html().replace("kyats", ""));
        });
        $('#subTotal').html(`${$subTotal} kyats`);
        $('#sumPrice').html($subTotal + 3000);
    }
})