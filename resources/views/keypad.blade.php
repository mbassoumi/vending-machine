<div id="keypad" class="card">
    <div class="card-header">
        Keypad
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                @foreach(['A', 'B', 'C', 'D', 'E'] as $char)
                    <button data-content="{!! $char !!}" type="button" style="width: 100%; margin: 5px"
                            class="btn btn-info char_keypad">
                        {!! $char !!}
                    </button>
                @endforeach
            </div>
            <div class="col-sm-6">
                @foreach(['1', '2', '3', '4', '5'] as $char)
                    <button data-content="{!! $char !!}" style="width: 100%; margin: 5px" type="button"
                            class="btn btn-info num_keypad">
                        {!! $char !!}
                    </button>
                @endforeach
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div style="width: 1%"></div>
                <button id="clear_keypad" style="width: 100%; margin: 5px" type="button" class="btn btn-info">
                    clear
                </button>
                <div style="width: 1%"></div>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-12">
                <button style="width: 100% ; margin: 5px" type="button" class="btn btn-info">Get</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button style="width: 100% ; margin: 5px" type="button" class="btn btn-info">cancel</button>
            </div>
        </div>


    </div>
</div>
