<div class="container">
    <h2>Downloads</h2>
    <div class="dez-separator-outer ">
        <div class="dez-separator bg-danger  style-skew"></div>
    </div>
    @if (!empty($phase->downloads))
    <div class="download-file">
        <ul>
            @foreach ($phase->downloads as $download)
                {{-- <li> --}}
                    {{-- <a href="{{ asset('storage/' . $download->file) }}" class="site-button button-skew" style="width:200px;"><span>{{ $download->title }}</span><i class="fa fa-angle-right"></i></a> --}}
                    {{-- <a href="{{ asset('storage/' . $download->file) }}" target="_blank">{{ $download->title }}</a> --}}
                {{-- </li> --}}
                <li>
                    <a href="{{ asset('storage/' . $download->file) }}" target="_blank" style="width:250px;">
                        <span class="pull-left"><i class="fa fa-file"></i></span>
                        <span class="file-name">{{ $download->title }}</span>
                        <i class="fa fa-download"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @else
        <div>No download uploaded yet.</div>
    @endif
</div>
