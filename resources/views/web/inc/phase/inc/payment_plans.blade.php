@if (count($phase->payment_plans) > 0)
<div class="container">
    <div class="row py-5">

    
    <h2>Payment Plans</h2>
    <div class="dez-separator-outer ">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    @if (!empty($phase->payment_plans))
        <ul style="list-style: none;">
            @foreach ($phase->payment_plans as $pPlan)
                <li>
                    <a href="{{ asset('storage/' . $pPlan->file) }}" class="site-button button-skew" style="width:200px;"><span>{{ $pPlan->title }}</span><i class="fa fa-angle-right"></i></a>
                    {{-- <a href="{{ asset('storage/' . $pPlan->file) }}" target="_blank">{{ $pPlan->title }}</a> --}}
                </li>
            @endforeach
        </ul>
    @else
        <div>No payment plans uploaded yet.</div>
    @endif
</div>
</div>

@endif