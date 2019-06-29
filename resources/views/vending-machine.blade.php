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
            update_display_input_money();
            $('.count').prop('disabled', true);
            $(document).on('click', '.plus', function () {
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
                update_display_input_money();

            });

            function update_display_input_money() {
                $('#input-money').html(usd_input + '$ and ' + coins_input + 'c');
            }

            let item_input = '-';
            update_display_input_item();
            $('.num_keypad').attr('disabled', 'disabled');
            $(document).on('click', '.char_keypad', function () {
                item_input = $(this).data('content');
                $('.char_keypad').attr('disabled', 'disabled');
                $('.num_keypad').attr('disabled', false);
                update_display_input_item()
            });
            $(document).on('click', '.num_keypad', function () {
                item_input += $(this).data('content');
                $('.num_keypad').attr('disabled', 'disabled');
                update_display_input_item()
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
                update_display_input_item();
                update_display_output_price();
            });

            let output_charge = '-';
            $(document).on('click', '#cancel-paying', function () {
                output_charge = usd_input + '$ and ' + coins_input + 'c';
                usd_input = 0;
                coins_input = 0;
                item_input = '-';
                output_price = '-';
                $('#pay-and-get-item').attr('disabled', 'disabled');
                update_display_input_item();
                update_display_input_money();
                update_display_output_price();
                update_output_charge_display();
            });

            function update_output_charge_display() {
                $('#charge-display').html(output_charge);
            }


            function update_display_input_item() {
                $('#input-item').html(item_input);
            }

            let output_price = '-';
            update_display_output_price();
            function update_display_output_price() {
                $('#output-price').html(output_price + "$");
            }

            function getSnackPrice() {
                $.ajax({
                    method: "GET",
                    url: "/snacks/"+item_input+"/price",
                    dataType: 'json',
                    success: function(data) {

                        output_price = data.price;
                        update_display_output_price();
                        // submitBtn.button('reset');
                        // if (data.result === 'success') {
                        //     deleteLogModal.modal('hide');
                        //     location.reload();
                        // }
                        // else {
                        //     alert('AJAX ERROR ! Check the console !');
                        //     console.error(data);
                        // }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        // submitBtn.button('reset');
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
