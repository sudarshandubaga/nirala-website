<div class="row multi-images">
    <div class="col-sm-2 mb-3">
        <label for="id_{{ $textName }}" class="d-block choose-project-images add-image">
            <img src="https://icons.veryicon.com/png/o/miscellaneous/o2o-middle-school-project/plus-104.png"
                alt="" loading="lazy">
            <input type="file" class="d-none choose-multi-image" data-text-name="{{ $textName }}"
                id="id_{{ $textName }}">
        </label>
    </div>

    @if (!empty($images))

        @foreach ($images as $pimg)
            <div class="col-sm-2 mb-3 p-image multi-image-item">
                <div class="choose-project-images">
                    <button type="button" class="remove-phase-image" data-id="{{ $pimg->id }}"
                        data-name="{{ $textName }}">
                        <i class="bx bx-minus-circle"></i>
                    </button>
                    <img src="{{ asset('storage/' . $pimg->image) }}" alt="" loading="lazy">
                </div>
            </div>
        @endforeach

    @endif
</div>
