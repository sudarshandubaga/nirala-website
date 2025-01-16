<style>
    .overview p{
        color: rgb(130, 130, 138);
        font-size: 16px;
        text-align: justify;
        
    }
</style>
<div class="container">
    <h1  data-aos="fade-right">Overview</h1>
    <div class="dez-separator-outer"  data-aos="fade-right">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    <div class="row">
        {{-- @if (!empty($phase->image))
            <div class="col-sm-4 text-center">
                <img src="{{ asset('storage/' . $phase->image) }}" alt="" class="img img-fluid">
            </div>
        @endif --}}
        {{-- <div class="section-head col-sm-{{ !empty($phase->image) ? 8 : 12 }}"> --}}
        <div class="section-head col-sm-12">
            {{-- <h3>{{ $phase->name }}</h3> --}}
            <div class="overview" data-aos="zoom-in">
                {!! $phase->overview !!}
            </div>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <a href="" class="btn btn-primary px-5 py-3" style="background: #063970;">Instant Call Back</a>
        </div>
    </div>
</div> --}}
