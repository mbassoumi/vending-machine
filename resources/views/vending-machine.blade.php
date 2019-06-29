@extends('layout')

@section('content')


    <div class="row" style="margin: 5px;">

        <div class="col-sm-8">
            <div class="col-sm-12" style="margin: 5px;">
                @include('snack-slots')
            </div>
        </div>
        <br>
        <div class="col-sm-4">
            <div class="col-sm-12" style="margin: 5px;">
                @include('display')
            </div>

            <form method="POST">
                {{csrf_field()}}
                {{--                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                <div class="col-sm-12" style="margin: 5px;">
                    <div class="row">
                        <div class="col-sm-6">
                            @include('keypad')
                        </div>
                        <div class="col-sm-6">
                            @include('money-slots')
                        </div>

                    </div>
                </div>
            </form>
            <div class="col-sm-12" style="margin: 5px;">
                @include('charge-display')
            </div>
        </div>
    </div>






@stop

@section('js')

    <script>
        $(document).ready(function () {



            let coins_input = 0;
            let usd_input = 0;
            let with_card = false;
            update_display_input_money('-');
            $('.count').prop('disabled', true);
            $(document).on('click', '.plus', function () {
                with_card = false;

                $('#pay-with-card').attr('disabled', 'disabled');


                let amount = $(this).data('amount');
                let type = $(this).data('type');
                var affected_id = type + '-' + amount;
                $('#' + affected_id).val(parseInt($('#' + affected_id).val()) + 1);
                let symbol = $(this).data('symbol');
                switch (symbol) {
                    case '$':
                        usd_input += amount;
                        break;
                    case 'c':
                        coins_input += amount;
                        break;
                }
                update_display_input_money(usd_input + '$ and ' + coins_input + 'c');

            });

            function update_display_input_money(output) {
                $('#input-money').html(output);
            }

            let item_input = '-';
            update_display_input_item('-');
            $('.num_keypad').attr('disabled', 'disabled');
            $(document).on('click', '.char_keypad', function () {
                item_input = $(this).data('content');
                $('.char_keypad').attr('disabled', 'disabled');
                $('.num_keypad').attr('disabled', false);
                update_display_input_item(item_input)
                update_notes_display('-');
            });
            $(document).on('click', '.num_keypad', function () {
                item_input += $(this).data('content');
                $('.num_keypad').attr('disabled', 'disabled');
                update_display_input_item(item_input)
                getSnackPrice();
                $('#pay-and-get-item').attr('disabled', false);

                // update_display_output_price()
            });

            $('#pay-and-get-item').attr('disabled', 'disabled');

            $(document).on('click', '#clear_keypad', function () {
                item_input = '-';
                output_price = '-'
                $('.char_keypad').attr('disabled', false);
                $('.num_keypad').attr('disabled', 'disabled');
                $('#pay-and-get-item').attr('disabled', 'disabled');
                update_display_input_item(item_input);
                update_display_output_price(output_price);
                update_notes_display('-');
            });

            let output_charge = '-';
            $(document).on('click', '#cancel-paying', function () {
                if (usd_input != 0 || coins_input != 0) {
                    output_charge = usd_input + '$ and ' + coins_input + 'c';
                } else if (with_card) {
                    output_charge = "take your card";
                    with_card = false;
                } else {
                    output_charge = '';
                }
                usd_input = 0;
                coins_input = 0;
                item_input = '-';
                output_price = '-';
                $('#pay-and-get-item').attr('disabled', 'disabled');
                $('#pay-with-card').attr('disabled', false);
                $('.char_keypad').attr('disabled', false);
                update_display_input_item(item_input);
                update_display_input_money('-');
                update_display_output_price(output_price);
                update_output_charge_display(output_charge);
                update_notes_display('-');
            });

            $(document).on('click', '#pay-and-get-item', function (e) {

                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "/snacks/buy",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        code: item_input,
                        with_card: with_card,
                        usd_input: usd_input,
                        coins_input: coins_input,
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#pay-and-get-item').attr('disabled', 'disabled');
                        $('#pay-with-card').attr('disabled', false);
                        update_output_charge_display(data.charge);
                        update_display_input_item('-');
                        update_display_input_money('-');
                        update_display_output_price('-');
                        $('.char_keypad').attr('disabled', false);
                        with_card = false;
                        update_snack_quantity(data.snack_quantity_id, data.snack_quantity);
                    },
                    error: function (response) {
                        update_notes_display(response.responseJSON.message);
                    }
                });
            });

            function update_snack_quantity(id, value){
                $('#quantity_'+id).html(value)
            }

            $(document).on('click', '#pay-with-card', function () {
                with_card = true;
                usd_input = 0;
                coins_input = 0;
                $('#input-money').html('card is inserted');
                update_notes_display('-');

            });

            function update_output_charge_display(output) {
                $('#charge-display').html(output);
            }
            function update_notes_display(output) {
                $('#display-notes').html(output);
            }


            function update_display_input_item(output) {
                $('#input-item').html(output);
            }

            let output_price = '-';
            update_display_output_price(output_price);

            function update_display_output_price(output) {
                $('#output-price').html(output);
            }

            function getSnackPrice() {
                $.ajax({
                    method: "GET",
                    url: "/snacks/" + item_input + "/price",
                    dataType: 'json',
                    success: function (data) {
                        output_price = data.price;
                        update_display_output_price(output_price);
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                    }
                });
            }


        });
    </script>
@stop



@section('css')

    <style>
        .qty .count {
            width: 33%;
            color: #000;
            display: inline-block;
            vertical-align: top;
            font-size: 25px;
            font-weight: 700;
            line-height: 30px;
            padding: 0 2px;
            min-width: 35px;
            text-align: center;
        }

        .qty .plus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial, sans-serif;
            text-align: center;
            border-radius: 50%;
        }

        /*.qty .minus {*/
        /*    cursor: pointer;*/
        /*    display: inline-block;*/
        /*    vertical-align: top;*/
        /*    color: white;*/
        /*    width: 30px;*/
        /*    height: 30px;*/
        /*    font: 30px/1 Arial, sans-serif;*/
        /*    text-align: center;*/
        /*    border-radius: 50%;*/
        /*    background-clip: padding-box;*/
        /*}*/

        /*div {*/
        /*    text-align: center;*/
        /*}*/

        .minus:hover {
            background-color: #717fe0 !important;
        }

        .plus:hover {
            background-color: #717fe0 !important;
        }

        /*Prevent text selection*/
        span {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        input {
            border: 0;
            width: 2%;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input:disabled {
            background-color: white;
        }

    </style>
@stop
