{{ Form::open(['url' => route('contact.store'), 'files' => true]) }}
<x-alert />
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <input name="name" type="text" required class="form-control" placeholder="Your Name">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <input name="email" type="email" class="form-control" required placeholder="Your Email Id">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <input name="phone" type="text" required class="form-control" placeholder="Phone">
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <input name="subject" type="text" required class="form-control" placeholder="Subject">
            </div>
        </div>
    </div> --}}
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group">
                <textarea name="message" rows="10" class="form-control" required placeholder="Your Message..."
                    style="height: 170px"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <button name="submit" type="submit" value="Submit" class="site-button ">
            <span>Submit</span>
        </button>
    </div>
</div>
{{ Form::close() }}
