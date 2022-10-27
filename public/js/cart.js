$(document).ready(function() {
    $('.btn-plus').click(function() {
        $parentNote = $(this).parents('tr');
        $price = Number($parentNote.find('#price').text().replace('Kyats', ''));
        $qty = Number($parentNote.find('#qty').val());
        $total = $price * $qty;

        $parentNote.find('#total').html($total + ' Kyats');
        summaryCalculation();

    })

    $('.btn-minus').click(function() {
        $parentNote = $(this).parents('tr');
        $price = Number($parentNote.find('#price').text().replace('Kyats', ''));
        $qty = Number($parentNote.find('#qty').val());
        $total = $price * $qty;

        $parentNote.find('#total').html($total + ' Kyats');
        summaryCalculation();
    })


    function summaryCalculation() {
        $totalPrice = 0;

        //total summary
        $('#dataTable tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));
        })
        $('#subTotalPrice').html($totalPrice + " Kyats");
        if ($totalPrice == 0) {
            $('#finalTotalPrice').html("0 Kyats");
        } else {
            $('#finalTotalPrice').html(($totalPrice + 3000) + " Kyats");
        }
    }
})
