@push('extra_css')

.view:hover{
    transform: scale(1.1);
    overflow: hidden;
    transition: 0.4s;
}

@endpush
<style>
    .image-container {
    position: relative;
    overflow: hidden;
}

.image-container img {
    display: block;
    width: 100%;
    height: 280px;
    transition: transform 0.4s ease; /* Optional zoom effect */
}

.image-container .overlay {
    position: absolute;
    top: -100%; /* Start above the image */
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0, 0, 0, 0.6);  */
    /* background: linear-gradient(to bottom, rgba(34, 193, 195, 0.5), rgba(253, 187, 45, 0.5)); */
    /* background: linear-gradient(to top left, rgba(57, 255, 20, 0.6), rgba(0, 255, 255, 0.6)); */
    /* background: linear-gradient(160deg, rgba(0, 100, 0, 0.6), rgba(255, 223, 0, 0.6)); */
    /* background: linear-gradient(to bottom, rgba(80, 200, 120, 0.5), rgba(0, 0, 0, 0.5)); */
    background: linear-gradient(to top, rgba(39, 174, 96, 0.5), rgba(41, 128, 185, 0.5));


    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: top 0.4s ease; /* Smooth transition */
    text-align: center;
    font-size: 18px;
}

.image-container:hover img {
    transform: scale(1.1); /* Optional zoom effect on hover */
}

.image-container:hover .overlay {
    top: 0; /* Slide down to cover the image */
}

</style>

<div class="container">
    <h2 data-aos="fade-right">Unit Plans</h2>
    <div class="dez-separator-outer"  data-aos="fade-right">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    @if (!empty($phase->unit_plans))
    <div class="row">
        @foreach ($phase->unit_plans as $image)
            @if (file_exists(public_path('storage/' . $image->image)))
                <div class="col-sm-4 text-center mb-3 image-container" data-aos="flip-left">
                    <a href="{{ asset('storage/' . $image->image) }}" data-lightbox="unit_plans">
                        <img src="{{ asset('storage/' . $image->image) }}" class="img img-fluid square-image view" style="border-radius:0px;">
                        <div class="overlay">
                            <p>Unit Plan Details</p>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    @else
        <div>No unit plans uploaded yet.</div>
    @endif
</div>
