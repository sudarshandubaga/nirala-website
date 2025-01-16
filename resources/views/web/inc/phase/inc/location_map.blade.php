<div class="container">
    <h2  data-aos="fade-right">Location Map</h2>
    <div class="dez-separator-outer"  data-aos="fade-right">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    <div class="row">
        @if (!empty($phase->location_image))
            <div class="col-sm-4 text-center">
                <img src="{{ asset('storage/' . $phase->location_image) }}" alt="" class="img img-fluid"  data-aos="zoom-in">
            </div>
        @endif
        <div class="col-sm-{{ !empty($phase->location_image) ? 8 : 12 }}">
           <div class="location_advantange"  data-aos="fade-left">
            {!! $phase->location_advantages !!}
           </div>
        </div>
    </div>
</div>

@push('extra_scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    // Select all <ul> elements inside the element with class "location_advantange"
    const locationAdvantageLists = document.querySelectorAll('.location_advantange ul');

    // Iterate through each <ul> element and add the desired classes
    locationAdvantageLists.forEach(ul => {
        ul.classList.add('list-check-circle', 'primary');
    });
});
    </script>
@endpush
