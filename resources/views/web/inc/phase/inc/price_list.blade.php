  <style>
      .view:hover{
        transform: scale(1.1);
        overflow: hidden;
        transition: 0.4s;
    }
  </style>
  @if (count($phase->price_list_images) > 0)
<div class="container">
    <h2>Price List</h2>
    <div class="dez-separator-outer ">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    @if (!empty($phase->price_list_images))
        <div class="row">
            @foreach ($phase->price_list_images as $image)
                <a href="{{ asset('storage/' . $image->image) }}" class="col-sm-4 text-center mb-3"
                    data-lightbox="price_list">
                    <img src="{{ asset('storage/' . $image->image) }}" class="img img-fluid square-image view" style="border-radius:5px;border:5px solid #ccc;">
                </a>
            @endforeach
        </div>
    @endif

    <div>
        {!! $phase->price_list !!}
    </div>
</div>
@endif
