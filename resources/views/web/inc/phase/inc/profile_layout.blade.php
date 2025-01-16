<div class="container">
    <h2  data-aos="fade-right">Profile Layout</h2>
    <div class="dez-separator-outer "  data-aos="fade-right">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    @if (!empty($phase->images))
        <div class="row">
            @foreach ($phase->images as $image)
                <a href="{{ asset('storage/' . $image->image) }}" class="col-sm-12 text-center mb-3"
                    data-lightbox="profile_images">
                    <img src="{{ asset('storage/' . $image->image) }}" class="img img-fluid" style="border-radius: 0;width:100%!important;"  data-aos="zoom-in">
                </a>
            @endforeach
        </div>
    @else
        <div>No images uploaded yet.</div>
    @endif
</div>
