@extends('web.layouts.app')

@section('main_contents')
    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(images/career-bg.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Career</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Career</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="clearfix">
            <!-- About Company -->
            <div class="section-full bg-white content-inner"
                style="background-image: url(images/bg-img.png); background-repeat: repeat-x; background-position: left bottom -37px;">
                <div class="container">
                    <div class="section-content">

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="bg-dark text-center">
                                    <tr>
                                        <th class="text-white">S.No.</th>
                                        <th class="text-white">Position</th>
                                        <th class="text-white">Department</th>
                                        <th class="text-white">Nos.</th>
                                        <th class="text-white">Location</th>
                                        <th class="text-white">Qualification</th>
                                        <th class="text-white">Min. Exp.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careerPosts as $index => $c)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $c->title }}</td>
                                            <td>{{ $c->department }}</td>
                                            <td>{{ $c->total_posts }}</td>
                                            <td>{{ $c->location }}</td>
                                            <td>{{ $c->qualification }}</td>
                                            <td>{{ $c->min_exp }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <div class="text-center mb-5">
                            <a href="{{ route('apply-job') }}" class="site-button">APPLY NOW</a>
                        </div>

                        {{-- {{ Form::open(['url' => route('career-post.store'), 'files' => true]) }}
                        <h3>Join Us & Apply</h3>
                        <x-alert />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {{ Form::select('career_post_id', $posts, null, ['class' => 'form-control', 'placeholder' => 'Select Post *', 'required' => 'required']) }}
                                </div>
                                <div class="mb-3">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your Name *', 'required' => 'required']) }}
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Male" id="genderMale"
                                            name="gender" checked>
                                        <label class="form-check-label" for="genderMale">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Female" id="genderFemale"
                                            name="gender">
                                        <label class="form-check-label" for="genderFemale">
                                            Female
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email *', 'required' => 'required']) }}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Your Phone *', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        {{ Form::text('current_salary', null, ['class' => 'form-control', 'placeholder' => 'Current Salary (LPA)']) }}
                                    </div>
                                    <div class="form-group col-sm-6 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        {{ Form::text('expected_salary', null, ['class' => 'form-control', 'placeholder' => 'Expected Salary (LPA)', 'required' => 'required']) }}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {{ Form::text('experience', null, ['class' => 'form-control', 'placeholder' => 'Your Experience (in Year & Months)']) }}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {{ Form::text('previous_company_name', null, ['class' => 'form-control', 'placeholder' => 'Your Previous Company Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">


                                <div class="form-group">
                                    {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Your Address *', 'required' => 'required', 'rows' => 10]) }}
                                </div>


                                <div class="form-group">
                                    <label>Upload Resume / CV</label>
                                    <input type="file" name="resume" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">

                            <button class="site-button rounded">
                                Submit & Apply
                            </button>
                        </div>
                        {{ Form::close() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
