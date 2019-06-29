@foreach($monies as $type => $money)
    @if($type != 'card')
        <h1>{!! $type !!}</h1>
        <hr>
        @foreach($money as $moneyObject)
            <div class="qty">
                <label
                    style="font-size: 20px; width: 50%"><b>{!! "$moneyObject->value $moneyObject->symbol" !!} </b></label>
                <input hidden type="number" id="{{"$type-$moneyObject->value"}}" class="count"
                       name="{{$type}}[{{$moneyObject->value}}]"
                       value="0">
                <span data-id="{{$moneyObject->id}}" data-type="{{$type}}" data-symbol="{!! $moneyObject->symbol !!}"
                      data-amount="{{$moneyObject->value}}"
                      class="plus bg-dark">+</span>
            </div>
        @endforeach
    @endif
@endforeach
<hr>
<div class="qty">
    <input hidden type="number" id="{{"$type-$moneyObject->value"}}" class="count" name="card"
           value="1">
    <button id="pay-with-card" type="button" class="btn btn-success">Pay with card</button>
</div>
