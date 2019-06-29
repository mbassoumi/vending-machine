<div class="card">
    <div class="card-header">
        Vending Machine
    </div>
    <div class="card-body">
        @foreach($snacks as $key => $value)
            <div class="row">
                @foreach($value as $snack)
                    <div style="width: 1%"></div>
                    <div style="width: 18%">
                        <div class="card">
                            <div class="card-header">
                                {!! $snack->name !!}
                            </div>
                            <div class="card-body">
                                <footer class="blockquote-footer">
                                    Quantity:
                                    <cite title="Source Title">
                                        {!! $snack->quantity !!}
                                    </cite>
                                </footer>
                                <footer class="blockquote-footer">
                                    Code:
                                    <cite title="Source Title">
                                        {!! $snack->row . $snack->column !!}
                                    </cite>
                                </footer>
                            </div>
                        </div>
                    </div>
                    <div style="width: 1%"></div>
                @endforeach

            </div>
            <hr>
        @endforeach
    </div>
</div>
