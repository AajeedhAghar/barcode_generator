@extends('layout')

@section('content')

    <div>
        <h3>Products Barcode</h3>
    </div>
    

    <div class="card-body">
        <div id="print">
            <div class="row">
                @forelse ( $productsBarcode as $barcode )
                    <div class="col-md-5">
                        <div class="card">

                            <div class="card-body">
                                {{ $barcode->product_code }}
                                {!! $barcode->barcode !!}
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
@endsection
