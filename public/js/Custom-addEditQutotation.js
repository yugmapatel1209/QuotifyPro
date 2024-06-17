document.addEventListener('DOMContentLoaded', function () {
    console.log('Custom JavaScript loaded');
    // Your custom JavaScript code here
    var mem = $('#date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "yyyy-mm-dd"

    });
    $("option:selected").prop("selected", false);
    //IsActive checkbox
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    // $(".price_comparison_section").hide();
    // $(".price_comparison_section_1").hide();
    //Temp commented for edit mode uncomment above lines

    $('#need_extra_price_comparison').on('ifChanged', function () {
        alert('aaa')
        var isChecked = $(this).prop('checked'); // Get the updated value of the checkbox
        // console.log('out', isChecked);
        if (isChecked) {
            console.log('aaa');
            // Checkbox is checked, update UI accordingly
            $("#need_extra_price_comparison_value").val("check");
            $(".price_comparison_section").show();
            $(".price_comparison_section_1").show();
        } else {
            console.log('bbb');
            $('#need_extra_price_comparison_value').val('uncheck');
            $(".price_comparison_section").hide();
            $(".price_comparison_section_1").hide();
        }

    });


    // $("#including_gst_" + len).on("keyup", function () {
    $('#Consecutive').on('keyup', ".including_gst", function () {
        console.log("🚀 ~ len:", len, $('#excluding_gst_' + len).val())
        console.log("🚀 ~ len:", len, $('.excluding_gst').val())

        var GST = $("#gst_percentage_" + len).val();

        var quantity = parseFloat($('#quantity_' + len).val());
        var including_gst = $(this).val();
        var excluding_gst = parseFloat($('#excluding_gst_' + len).val());
        var discount = parseFloat($('#discount_percentage_' + len).val());
        var profit = parseFloat($('#profit_percentage_' + len).val());
        // console.log({ profit, 'pr': $('#profit_percentage_' + len).val() })
        var transportation_charges = parseFloat($('#transportation_charges_' + len).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);
        console.log({ final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, })

        $("#excluding_gst_" + len).val(excluding_gst_amount);
        $("#final_amount_" + len).val(final_amount);
        $(".final_amount_" + len).text(final_amount);

        $("#original_rate_" + len).val(original_rate);
        $('.original_rate_' + len).text(original_rate);

        $("#purchase_amount_" + len).val(purchase_amount);
        $('.purchase_amount_' + len).text(purchase_amount);

        $("#sales_amount_" + len).val(sales_amount);
        $('.sales_amount_' + len).text(sales_amount);

        $("#benefit_" + len).val(benefit);
        $('.benefit_' + len).text(benefit);

        $('.transportation_charges_view_' + len).text(transportation_charges);
    });
    $('#Consecutive').on('keyup', ".excluding_gst", function () {
        var GST = $("#gst_percentage_" + len).val();
        var quantity = parseFloat($('#quantity_' + len).val());
        var including_gst = parseFloat($('#including_gst' + len).val());
        var excluding_gst = $(this).val();
        var discount = parseFloat($('#discount_percentage_' + len).val());
        var profit = parseFloat($('#profit_percentage_' + len).val());
        var transportation_charges = parseFloat($('#transportation_charges_' + len).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#including_gst_" + len).val(including_gst_amount);


        $("#final_amount_" + len).val(final_amount);
        $(".final_amount_" + len).text(final_amount);

        $("#original_rate_" + len).val(original_rate);
        $('.original_rate_' + len).text(original_rate);

        $("#purchase_amount_" + len).val(purchase_amount);
        $('.purchase_amount_' + len).text(purchase_amount);

        $("#sales_amount_" + len).val(sales_amount);
        $('.sales_amount_' + len).text(sales_amount);

        $("#benefit_" + len).val(benefit);
        $('.benefit_' + len).text(benefit);

        $('.transportation_charges_view_' + len).text(transportation_charges);
    });

    // $("#discount_percentage_" + len).on("keyup", function () {
    $('#Consecutive').on('keyup', ".discount_percentage", function () {
        console.log('Key up in input: discount_percentage_   ', $(this).val());
        var GST = $("#gst_percentage_" + len).val();
        var quantity = parseFloat($('#quantity_' + len).val());
        var including_gst = parseFloat($('#including_gst' + len).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + len).val());
        var discount = $(this).val();
        var profit = parseFloat($('#profit_percentage_' + len).val());
        var transportation_charges = parseFloat($('#transportation_charges_' + len).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        // $("#including_gst" + len).val(including_gst_amount);

        $("#final_amount_" + len).val(final_amount);
        $(".final_amount_" + len).text(final_amount);

        $("#original_rate_" + len).val(original_rate);
        $('.original_rate_' + len).text(original_rate);

        $("#purchase_amount_" + len).val(purchase_amount);
        $('.purchase_amount_' + len).text(purchase_amount);

        $("#sales_amount_" + len).val(sales_amount);
        $('.sales_amount_' + len).text(sales_amount);

        $("#benefit_" + len).val(benefit);
        $('.benefit_' + len).text(benefit);

        $('.transportation_charges_view_' + len).text(transportation_charges);
    });

    $('#Consecutive').on('keyup', ".profit_percentage", function () {
        // console.log('Key up in input: profit_percentage   ', $(this).val());
        var GST = $("#gst_percentage_" + len).val();
        var quantity = parseFloat($('#quantity_' + len).val());
        var including_gst = parseFloat($('#including_gst' + len).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + len).val());
        var discount = parseFloat($('#discount_percentage_' + len).val());
        var profit = $(this).val();
        var transportation_charges = parseFloat($('#transportation_charges_' + len).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#final_amount_" + len).val(final_amount);
        $(".final_amount_" + len).text(final_amount);

        $("#original_rate_" + len).val(original_rate);
        $('.original_rate_' + len).text(original_rate);

        $("#purchase_amount_" + len).val(purchase_amount);
        $('.purchase_amount_' + len).text(purchase_amount);

        $("#sales_amount_" + len).val(sales_amount);
        $('.sales_amount_' + len).text(sales_amount);

        $("#benefit_" + len).val(benefit);
        $('.benefit_' + len).text(benefit);

        $('.transportation_charges_view_' + len).text(transportation_charges);
    });

    $('#Consecutive').on('keyup', ".transportation_charges", function () {
        // console.log('Key up in input: transportation_charges   ', $(this).val());
        var GST = $("#gst_percentage_" + len).val();
        var quantity = parseFloat($('#quantity_' + len).val());
        var including_gst = parseFloat($('#including_gst' + len).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + len).val());
        var discount = parseFloat($('#discount_percentage_' + len).val());
        var profit = parseFloat($('#profit_percentage_' + len).val());
        var transportation_charges = $(this).val();
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#final_amount_" + len).val(final_amount);
        $(".final_amount_" + len).text(final_amount);

        $("#original_rate_" + len).val(original_rate);
        $('.original_rate_' + len).text(original_rate);

        $("#purchase_amount_" + len).val(purchase_amount);
        $('.purchase_amount_' + len).text(purchase_amount);

        $("#sales_amount_" + len).val(sales_amount);
        $('.sales_amount_' + len).text(sales_amount);

        $("#benefit_" + len).val(benefit);
        $('.benefit_' + len).text(benefit);

        $('.transportation_charges_view_' + len).text(transportation_charges);
    });



    function calc_result(gst, including_gst = 0, excluding_gst = 0, qty = 0, discount = 0, profit = 0, tr_ch = 0) {
        console.log('calc_result function input ::: ', { gst, including_gst, excluding_gst, qty, discount, profit, tr_ch });
        var including_gst_amount = including_gst;
        var excluding_gst_amount = excluding_gst;
        if (including_gst > 0) {
            excluding_gst_amount = including_gst / gst;
        } else {
            including_gst_amount = excluding_gst * gst;
        }

        var final_amount = excluding_gst_amount - (excluding_gst_amount * (discount / 100));
        // console.log(final_amount, final_amount + (final_amount * profit), ' :: aaa')
        var original_rate = final_amount + (final_amount * (profit / 100));

        var purchase_amount = final_amount * qty || 0;
        var sales_amount = original_rate * qty || 0;
        // console.log('calc_result :: benofit ', sales_amount, purchase_amount, tr_ch, ' tottl : ', sales_amount - purchase_amount - tr_ch)
        var benefit = sales_amount - purchase_amount - tr_ch;
        console.log('calc_result function output result :::::::::::: ::: ', { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, })

        return {
            final_amount,
            original_rate,
            purchase_amount,
            sales_amount,
            benefit,
            including_gst_amount,
            excluding_gst_amount,
        }
    }

});