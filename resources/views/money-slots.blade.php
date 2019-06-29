@foreach($monies as $type => $money)
    @if($type != 'card')
        <h1>{!! $type !!}</h1>
        <hr>
        @foreach($money as $moneyObject)
            <div class="qty">
                <label style="font-size: 20px; width: 50%"><b>{!! "$moneyObject->amount $moneyObject->symbol" !!} </b></label>
                <input hidden type="number" id="{{"$type-$moneyObject->amount"}}" class="count" name="{{$type}}[{{$moneyObject->amount}}]"
                       value="0">
                <span data-type="{{$type}}" data-symbol="{!! $moneyObject->symbol !!}" data-amount="{{$moneyObject->amount}}"
                      class="plus bg-dark">+</span>
            </div>
        @endforeach
    @endif
@endforeach
