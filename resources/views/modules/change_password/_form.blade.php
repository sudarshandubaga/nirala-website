<div class="row">
    <div class="col-sm-12 ">

        <div class="mb-3 row align-items-center">
            {{ Form::label('current_password', null, ['class' => 'form-label col-sm-4 col-lg-2']) }}
            <div class="col-sm-6 col-lg-4">
                <div class="input-group">
                    {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Enter current password', 'required' => 'required']) }}
                    <span class="input-group-text p-0 password-toggle-btn">
                        <button type="button" class="btn btn-link">
                            <i class="bx bx-show"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="mb-3 row align-items-center">
            {{ Form::label('password', null, ['class' => 'form-label col-sm-4 col-lg-2']) }}
            <div class="col-sm-6 col-lg-4">
                <div class="input-group">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter new password', 'required' => 'required']) }}
                    <span class="input-group-text p-0 password-toggle-btn">
                        <button type="button" class="btn btn-link">
                            <i class="bx bx-show"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="mb-3 row align-items-center">
            {{ Form::label('confirm_password', null, ['class' => 'form-label col-sm-4 col-lg-2']) }}
            <div class="col-sm-6 col-lg-4">
                <div class="input-group">
                    {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Enter confirm password', 'required' => 'required']) }}
                    <span class="input-group-text p-0 password-toggle-btn">
                        <button type="button" class="btn btn-link">
                            <i class="bx bx-show"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
