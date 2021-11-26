<div>
    <h4>Products Barcode</h4>
</div>

<div class="card-body">
    <div id="print">
    <div class="row">
        @forelse ( $productsBarcode as $barcode )
           <div class="col-md-3">
                <div class="card">
                    <h4>{{$barcode -> product_code}}</h4>
                    <div class="card-body">
                        {!!$barcode->barcode!!}    
                    </div>    
                </div>   
            </div> 
        @empty
            
        @endforelse
    </div>
    </div>
</div>