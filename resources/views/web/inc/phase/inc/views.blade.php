<style>
    .view_container {
        position: relative;
        height: 300px;
        width: auto;
        transition: 0.4s;
        overflow: hidden;
        margin:10px 0;
    }
    
    .view_container img {
        display: block;
        width: 100%;
        /* height: auto; */
        height: 100%;
        /* object-fit: cover; */
    }
    
    .view_overlay {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background:linear-gradient(to bottom, rgba(34, 193, 195, 0.5), rgba(253, 187, 45, 0.5));
        color: #fff;
        opacity: 0; /* Initially hidden */
        pointer-events: none; /* Prevent interaction when hidden */
        transition: opacity 0.4s;
        cursor: pointer;
    }
    
    .view_container:hover .view_overlay {
        opacity: 1; /* Show overlay on hover */
        pointer-events: auto; /* Enable interaction */
    }
    
    .view_overlay a {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        height: 100%;
        width: 100%;
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit text color */
    }
    </style>
<div class="container">
    <h2 data-aos="fade-right">Gallery</h2>
    <div class="dez-separator-outer " data-aos="fade-right">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    {{-- @if (!empty($phase->views))
        <div class="row">
            @foreach ($phase->views as $image)
                <a href="{{ asset('storage/' . $image->image) }}" class="col-sm-4 text-center mb-3" data-lightbox="views">
                    <img src="{{ asset('storage/' . $image->image) }}" class="img img-fluid square-image view" style="border-radius: 10px;">
                </a>
            @endforeach
        </div>
    @else
        <div>No views uploaded yet.</div>
    @endif --}}
    <div class="row">
        
        @foreach ($phase->views as $image)
<div class="col-md-4">
    <div class="view_container">
        <!-- Image -->
        <img src="{{ asset('storage/' . $image->image) }}" alt="Luxury Living" data-aos="zoom-in-down">
    
        <!-- Overlay -->
        <div class="view_overlay">
            <!-- Entire overlay clickable -->
            <a href="{{ asset('storage/' . $image->image) }}" data-lightbox="views" data-title="Luxury Living">
                <h4 class="text-white">Luxury Living</h4>
                <p>THE BUILDING</p>
            </a>
        </div>
    </div>
</div>
@endforeach
        </div>
    </div>
</div>
