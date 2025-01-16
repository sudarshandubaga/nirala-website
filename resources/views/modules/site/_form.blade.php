<div class="row">
    <div class="col-sm-8 col-lg-9">

        <div class="mb-3">
            {{ Form::label('title', null, ['class' => 'form-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) }}
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                {{ Form::label('video_id', 'Youtube Video ID', ['class' => 'form-label']) }}
                {{ Form::text('video_id', null, ['class' => 'form-control', 'placeholder' => 'Enter video_id']) }}
            </div>
            <div class="col-sm-4 mb-3">
                {{ Form::label('email', null, ['class' => 'form-label']) }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
            </div>
            <div class="col-sm-4 mb-3">
                {{ Form::label('fax', null, ['class' => 'form-label']) }}
                {{ Form::text('fax', null, ['class' => 'form-control', 'placeholder' => 'Enter fax']) }}
            </div>
            <div class="col-sm-4 mb-3">
                {{ Form::label('phone', null, ['class' => 'form-label']) }}
                {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter phone']) }}
            </div>
            <div class="col-sm-4 mb-3">
                {{ Form::label('mobile', null, ['class' => 'form-label']) }}
                {{ Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Enter mobile']) }}
            </div>
            <div class="col-sm-4 mb-3">
                {{ Form::label('whatsapp_no', null, ['class' => 'form-label']) }}
                {{ Form::text('whatsapp_no', null, ['class' => 'form-control', 'placeholder' => 'Enter whatsapp no.']) }}
            </div>

        </div>

        <div class="mb-3">
            {{ Form::label('address', null, ['class' => 'form-label']) }}
            {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Address', 'rows' => 10]) }}
        </div>

        <h5 class="card-title">Locations</h5>
        <div class="mb-3">
            <button type="button" class="btn btn-outline-dark btn-sm add-addr-btn"><i class="bx bx-plus"></i> Add
                Row</button>
        </div>
        <div id="addresses">
            @if (!empty($site->offices))
                @foreach ($site->offices as $index => $office)
                    <div class="addr-row">
                        <div class="row">
                            <div class="col-sm-4 mb-3 align-self-end d-grid">
                                <label for="address" class="form-label">Office Name</label>
                                <input class="form-control office_name" placeholder="Enter office name" name="address"
                                    id="address"
                                    value="{{ !empty($office['office_name']) ? $office['office_name'] : null }}" />
                            </div>
                            <div class="col-sm-5 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control address" placeholder="Enter address" name="address"
                                    id="address" value="{{ $office['address'] }}" />
                            </div>
                            <div class="col-sm-3 mb-3 align-self-end d-grid">
                                <button type="button" class="btn btn-danger remove-addr-btn"><i
                                        class="bx bx-minus"></i> Remove</button>
                            </div>
                        </div>
                        <hr />
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mb-3">
            {{ Form::label('google_map', 'Google Map Link', ['class' => 'form-label']) }}
            {{ Form::textarea('google_map', null, ['class' => 'form-control', 'placeholder' => 'Add links for iframe.', 'rows' => 10]) }}
        </div>

        <div class="mb-3">
            {{ Form::label('footer_scripts', 'Extra Scripts', ['class' => 'form-label']) }}
            {{ Form::textarea('footer_scripts', null, ['class' => 'form-control', 'placeholder' => 'Add scripts for Webmaster, Analytics, Adsense, Search Console, etc.', 'rows' => 10]) }}
        </div>

        <div class="row">
            <div class="col-sm-6 mb-3">
                {{ Form::label('facebook_link', null, ['class' => 'form-label']) }}
                {{ Form::text('facebook_link', null, ['class' => 'form-control', 'placeholder' => 'Enter facebook link']) }}
            </div>
            <div class="col-sm-6 mb-3">
                {{ Form::label('instagram_link', null, ['class' => 'form-label']) }}
                {{ Form::text('instagram_link', null, ['class' => 'form-control', 'placeholder' => 'Enter instagram link']) }}
            </div>
            <div class="col-sm-6 mb-3">
                {{ Form::label('twitter_link', 'Twitter Link', ['class' => 'form-label']) }}
                {{ Form::text('twitter_link', null, ['class' => 'form-control', 'placeholder' => 'Enter twitter link']) }}
            </div>
            <div class="col-sm-6 mb-3">
                {{ Form::label('linkedin_link', 'Linkedin Link', ['class' => 'form-label']) }}
                {{ Form::text('linkedin_link', null, ['class' => 'form-control', 'placeholder' => 'Enter linkedin link']) }}
            </div>
        </div>

    </div>
    <div class="col-sm-4 col-lg-3">
        <div class="mb-3">
            {{ Form::label('logo_file', 'Choose Logo', ['class' => 'form-label']) }}
            <label for="logo_file" class="d-block upload-image">
                <img src="{{ !empty($site->logo) ? $site->logo : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                    alt="" id="logo-img-preview" loading="lazy">
                {{ Form::file('logo_file', ['class' => 'd-none', 'data-target' => '#logo-img-preview', 'data-text-target' => '#logo']) }}
            </label>
            <textarea name="logo" id="logo" class="d-none"></textarea>
        </div>
        <div class="mb-3">
            {{ Form::label('favicon_file', 'Choose Favicon', ['class' => 'form-label']) }}
            <label for="favicon_file" class="d-block upload-image">
                <img src="{{ !empty($site->favicon) ? $site->favicon : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                    alt="" id="img-preview" loading="lazy">
                {{ Form::file('favicon_file', ['class' => 'd-none', 'data-target' => '#img-preview', 'data-text-target' => '#favicon']) }}
            </label>
            <textarea name="favicon" id="favicon" class="d-none"></textarea>
        </div>

        {{-- <div class="mb-3">
            {{ Form::label('welcome_image_file', 'Choose Welcome Image', ['class' => 'form-label']) }}
            <label for="welcome_image_file" class="d-block upload-image">
                <img src="{{ !empty($site->welcome_image) ? $site->welcome_image : 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
                    alt="" id="welcome_img-preview" loading="lazy">
                {{ Form::file('welcome_image_file', ['class' => 'd-none', 'data-target' => '#welcome_img-preview', 'data-text-target' => '#welcome_image']) }}
            </label>
            <textarea name="welcome_image" id="welcome_image" class="d-none"></textarea>

            @if ($site->welcome_image)
                <div class="text-center mt-3">
                    <a href="{{ route('admin.site.remove-image', ['field' => 'welcome_image']) }}"
                        class="btn btn-outline-danger btn-sm remove-image">
                        <i class="bx bx-minus"></i>
                        Remove Welcome Image
                    </a>
                </div>
            @endif
        </div> --}}

        <div>
            <label for="" class="form-label">WELCOME BANNER</label>
        </div>
        <div class="row g-3">
            <div class="col-4">
                <label class="multiple-image-upload">
                    <div>
                        <i class="bx bx-plus"></i>
                    </div>
                    <input type="file" accept="image/*" class="d-none" data-field_name="welcome_images" multiple>
                </label>
            </div>
            @if (!empty($bannerImages))
                @foreach ($bannerImages as $banner)
                    <div class="col-4">
                        <div class="img-preview">
                            <a href="{{ route('admin.site.remove-welcome-banner', $banner) }}"
                                class="close">&times;</a>
                            <img src="{{ $banner->image }}" class="w-100" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@push('extra_scripts')
    <script>
        function adjustAddrSerial() {
            let i = 0;
            if ($('.addr-row').length) {
                $('.addr-row').each(function() {
                    let addr = $(this).find('.address'),
                        ofc = $(this).find('.office_name');

                    ofc.attr('name', `addresses[${i}][office_name]`);
                    ofc.attr('id', `office_name_${i}`);
                    ofc.prev().attr('for', `office_name_${i}`);

                    addr.attr('name', `addresses[${i}][address]`);
                    addr.attr('id', `address_${i}`);
                    addr.prev().attr('for', `address_${i}`);

                    i++;
                });
            }
        }

        adjustAddrSerial();

        $(function() {
            $(document).on("click", ".add-addr-btn", function() {
                let html = `
                    <div class="addr-row">
                        <div class="row">
                            <div class="col-sm-4 mb-3 align-self-end d-grid">
                                <label for="address" class="form-label">Office Name</label>
                                <input class="form-control office_name" placeholder="Enter office name" name="address"
                                    id="address" value="" />
                            </div>
                            <div class="col-sm-5 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control address" placeholder="Enter address" name="address" cols="50" id="address" />
                            </div>
                            <div class="col-sm-3 mb-3 align-self-end d-grid">
                                <button type="button" class="btn btn-danger remove-addr-btn"><i class="bx bx-minus"></i> Remove</button>
                            </div>
                        </div>
                        <hr />
                    </div>
                `;

                $('#addresses').append(html);
                adjustAddrSerial();
            });

            $(document).on("click", ".remove-addr-btn", function() {
                $(this).closest(".addr-row").remove();
            });
        });
    </script>
@endpush
