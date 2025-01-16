

<div class="dez-box p-a20 border-1">
    <div class="dez-media">
        @if (count($project->phases) > 1)
        <a href="{{ route('phase.index', ['project' => $project]) }}">
            <img src="{{ asset('storage/' . $project->image) }}" alt="" style="object-fit: contain"></a>
        @else 
        <a href="{{ route('phase.show', [$project->phases[0]]) }}">
            <img src="{{ asset('storage/' . $project->image) }}" alt="" style="object-fit: contain"></a>
        @endif
       
    </div>
    <div class="dez-info text-center">
        <h4 class="dez-title m-t20">
                @if (count($project->phases) > 1)
                <a href="{{ route('phase.index', ['project' => $project]) }}">
                    {{ $project->name }}</a>
                @else 
                <a href="{{ route('phase.show', [$project->phases[0]]) }}">
                    {{ $project->name }}</a>
                @endif
        </h4>
        <p>
            {{ substr(html_entity_decode(strip_tags($project->description)), 0, 107) }}
        </p>
        @if (count($project->phases) > 1)
        <a href="{{ route('phase.index', ['project' => $project]) }}" class="site-button">Read
            More</a>
        @else
        {{-- {{$project->phases[0]}} --}}
        <a href="{{ route('phase.show', [$project->phases[0]]) }}"  class="site-button">Read
            More</a>
        @endif
     
    </div>
</div>
