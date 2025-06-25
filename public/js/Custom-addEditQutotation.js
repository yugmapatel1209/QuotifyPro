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
    //disabled below line While edit create and issue need to check while create a new entry
    // $("option:selected").prop("selected", false);

    //IsActive checkbox
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    // $(".price_comparison_section").hide();
    // $(".price_comparison_section_1").hide();
    //Temp commented for edit mode uncomment above lines

    //For Edit screen show hide price_comparison_section
    console.log($('.price_comparison_section').data('show-section'));
    var showSection = $('.price_comparison_section').data('show-section') === true;

    if (showSection) {
        $('.price_comparison_section').show();
        $('.price_comparison_section_1').show();
    } else {
        console.log('hide', showSection);
        $('.price_comparison_section').hide();
        $('.price_comparison_section_1').hide();
    }


    $('#need_extra_price_comparison').on('ifChanged', function () {
        // alert('aaa')
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


    // $("#including_gst_" + index).on("keyup", function () {
    $('#Consecutive').on('keyup', ".including_gst", function () {
        // console.log("🚀 ~ len:", len, $('#excluding_gst_' + len).val())
        // console.log("🚀 ~ len:", len, $('.excluding_gst').val())
        var currentInput = $(this);
        // Find the index or identifier of the current input field
        var index = currentInput.attr('id').split('_').pop(); // Assuming the id is 'including_gst_X'

        var GST = $("#gst_percentage_" + index).val();
        var quantity = parseFloat($('#quantity_' + index).val());
        var including_gst = $(this).val();
        var excluding_gst = parseFloat($('#excluding_gst_' + index).val());
        var discount = parseFloat($('#discount_percentage_' + index).val());

        var profit = parseFloat($('#profit_percentage_' + index).val());
        // console.log({ profit, 'pr': $('#profit_percentage_' + index).val() })
        var transportation_charges = parseFloat($('#transportation_charges_' + index).val());
        const formattedGST = 1 + GST / 100;
        console.log("🚀 ~ index & GST Amount :", index, GST, $("#gst_percentage_" + index).val(), { excluding_gst, formattedGST });

        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);
        console.log({ final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, })

        $("#excluding_gst_" + index).val(excluding_gst_amount);
        $("#final_amount_" + index).val(final_amount);
        $(".final_amount_" + index).text(final_amount);

        $("#original_rate_" + index).val(original_rate);
        $('.original_rate_' + index).text(original_rate);

        $("#purchase_amount_" + index).val(purchase_amount);
        $('.purchase_amount_' + index).text(purchase_amount);

        $("#sales_amount_" + index).val(sales_amount);
        $('.sales_amount_' + index).text(sales_amount);

        $("#benefit_" + index).val(benefit);
        $('.benefit_' + index).text(benefit);

        $('.transportation_charges_view_' + index).text(transportation_charges);
    });
    $('#Consecutive').on('keyup', ".excluding_gst", function () {
        var currentInput = $(this);
        // Find the index or identifier of the current input field
        var index = currentInput.attr('id').split('_').pop(); // Assuming the id is 'including_gst_X'
        var GST = $("#gst_percentage_" + index).val();
        console.log('In excluding_gst gst_percentage_value is ::', GST, " and index is ::", index);
        var quantity = parseFloat($('#quantity_' + index).val());
        var including_gst = parseFloat($('#including_gst' + index).val());
        var excluding_gst = $(this).val();
        var discount = parseFloat($('#discount_percentage_' + index).val());
        var profit = parseFloat($('#profit_percentage_' + index).val());
        var transportation_charges = parseFloat($('#transportation_charges_' + index).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#including_gst_" + index).val(including_gst_amount);


        $("#final_amount_" + index).val(final_amount);
        $(".final_amount_" + index).text(final_amount);

        $("#original_rate_" + index).val(original_rate);
        $('.original_rate_' + index).text(original_rate);

        $("#purchase_amount_" + index).val(purchase_amount);
        $('.purchase_amount_' + index).text(purchase_amount);

        $("#sales_amount_" + index).val(sales_amount);
        $('.sales_amount_' + index).text(sales_amount);

        $("#benefit_" + index).val(benefit);
        $('.benefit_' + index).text(benefit);

        $('.transportation_charges_view_' + index).text(transportation_charges);
    });

    // $("#discount_percentage_" + index).on("keyup", function () {
    $('#Consecutive').on('keyup', ".discount_percentage", function () {
        var currentInput = $(this);
        // Find the index or identifier of the current input field
        var index = currentInput.attr('id').split('_').pop(); // Assuming the id is 'including_gst_X'
        console.log('Key up in input: discount_percentage_   ', $(this).val());
        var GST = $("#gst_percentage_" + index).val();
        var quantity = parseFloat($('#quantity_' + index).val());
        var including_gst = parseFloat($('#including_gst' + index).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + index).val());
        var discount = $(this).val();
        var profit = parseFloat($('#profit_percentage_' + index).val());
        var transportation_charges = parseFloat($('#transportation_charges_' + index).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        // $("#including_gst" + index).val(including_gst_amount);

        $("#final_amount_" + index).val(final_amount);
        $(".final_amount_" + index).text(final_amount);

        $("#original_rate_" + index).val(original_rate);
        $('.original_rate_' + index).text(original_rate);

        $("#purchase_amount_" + index).val(purchase_amount);
        $('.purchase_amount_' + index).text(purchase_amount);

        $("#sales_amount_" + index).val(sales_amount);
        $('.sales_amount_' + index).text(sales_amount);

        $("#benefit_" + index).val(benefit);
        $('.benefit_' + index).text(benefit);

        $('.transportation_charges_view_' + index).text(transportation_charges);
    });

    $('#Consecutive').on('keyup', ".profit_percentage", function () {
        var currentInput = $(this);
        // Find the index or identifier of the current input field
        var index = currentInput.attr('id').split('_').pop(); // Assuming the id is 'including_gst_X'
        // console.log('Key up in input: profit_percentage   ', $(this).val());
        var GST = $("#gst_percentage_" + index).val();
        var quantity = parseFloat($('#quantity_' + index).val());
        var including_gst = parseFloat($('#including_gst' + index).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + index).val());
        var discount = parseFloat($('#discount_percentage_' + index).val());
        var profit = $(this).val();
        var transportation_charges = parseFloat($('#transportation_charges_' + index).val());
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#final_amount_" + index).val(final_amount);
        $(".final_amount_" + index).text(final_amount);

        $("#original_rate_" + index).val(original_rate);
        $('.original_rate_' + index).text(original_rate);

        $("#purchase_amount_" + index).val(purchase_amount);
        $('.purchase_amount_' + index).text(purchase_amount);

        $("#sales_amount_" + index).val(sales_amount);
        $('.sales_amount_' + index).text(sales_amount);

        $("#benefit_" + index).val(benefit);
        $('.benefit_' + index).text(benefit);

        $('.transportation_charges_view_' + index).text(transportation_charges);
    });

    $('#Consecutive').on('keyup', ".transportation_charges", function () {
        var currentInput = $(this);
        // Find the index or identifier of the current input field
        var index = currentInput.attr('id').split('_').pop(); // Assuming the id is 'including_gst_X'
        // console.log('Key up in input: transportation_charges   ', $(this).val());
        var GST = $("#gst_percentage_" + index).val();
        var quantity = parseFloat($('#quantity_' + index).val());
        var including_gst = parseFloat($('#including_gst' + index).val());
        var excluding_gst = parseFloat($('#excluding_gst_' + index).val());
        var discount = parseFloat($('#discount_percentage_' + index).val());
        var profit = parseFloat($('#profit_percentage_' + index).val());
        var transportation_charges = $(this).val();
        const formattedGST = 1 + GST / 100;
        const { final_amount, original_rate, purchase_amount, sales_amount, benefit, including_gst_amount, excluding_gst_amount, } = calc_result(formattedGST, including_gst, excluding_gst, quantity, discount, profit, transportation_charges);

        $("#final_amount_" + index).val(final_amount);
        $(".final_amount_" + index).text(final_amount);

        $("#original_rate_" + index).val(original_rate);
        $('.original_rate_' + index).text(original_rate);

        $("#purchase_amount_" + index).val(purchase_amount);
        $('.purchase_amount_' + index).text(purchase_amount);

        $("#sales_amount_" + index).val(sales_amount);
        $('.sales_amount_' + index).text(sales_amount);

        $("#benefit_" + index).val(benefit);
        $('.benefit_' + index).text(benefit);

        $('.transportation_charges_view_' + index).text(transportation_charges);
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