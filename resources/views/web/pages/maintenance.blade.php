@extends('web.layouts.app')

@section('content')
<div class="maintenance-section section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="maintenance-card">
                    @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('message.type') }} alert-dismissible shadow-sm">
                            {{ Session::get('message.text') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    <div class="card-header-modern">
                        <div class="icon-circle">
                            <i class="fa fa-wrench"></i>
                        </div>
                        <h3 class="title">{{ __('Maintenance Request') }}</h3>
                        <p>{{ __('Fill in the details and our team will contact you shortly.') }}</p>
                    </div>

                    <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
                        @csrf

                        <div class="form-group-modern">
                            <label><i class="fa fa-user"></i> {{ __('Name & Phone') }}</label>
                            <input type="text" name="title" class="input-modern" placeholder="e.g. Mahmoud - 010xxxx" required>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="fa fa-edit"></i> {{ __('Problem Description') }}</label>
                            <textarea name="description" rows="4" class="input-modern" placeholder="{{ __('Describe your issue here...') }}"></textarea>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="fa fa-camera"></i> {{ __('Upload Photo (Optional)') }}</label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="image" id="image-upload" class="file-input-hidden">
                                <label for="image-upload" class="file-label">
                                    <i class="fa fa-cloud-upload"></i>
                                    <span>{{ __('Choose a file or drag it here') }}</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="primary-btn btn-block submit-btn-modern">
                            {{ __('Send Request') }} <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    /* Section Background */
    .maintenance-section {
        background-color: #fbfbfb;
        padding-top: 60px;
        padding-bottom: 60px;
    }

    /* Card Styling */
    .maintenance-card {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }

    /* Header Styling */
    .card-header-modern {
        text-align: center;
        margin-bottom: 35px;
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        background: #D10024; /* Electro Red */
        color: #fff;
        line-height: 70px;
        font-size: 30px;
        border-radius: 50%;
        margin: 0 auto 15px;
        box-shadow: 0 5px 15px rgba(209, 0, 36, 0.3);
    }

    .card-header-modern h3 {
        margin: 0;
        font-weight: 700;
        color: #2B2D42;
        text-transform: uppercase;
    }

    .card-header-modern p {
        color: #8D99AE;
        margin-top: 5px;
    }

    /* Modern Inputs */
    .form-group-modern {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group-modern label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #2B2D42;
    }

    .form-group-modern label i {
        color: #D10024;
        margin-right: 5px;
    }

    .input-modern {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #E4E7ED;
        background: #F9FAFB;
        border-radius: 8px;
        transition: all 0.3s ease;
        outline: none;
    }

    .input-modern:focus {
        border-color: #D10024;
        background: #fff;
        box-shadow: 0 0 8px rgba(209, 0, 36, 0.1);
    }

    /* Custom File Upload */
    .file-upload-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input-hidden {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-label {
        display: block;
        padding: 20px;
        text-align: center;
        background: #F9FAFB;
        border: 2px dashed #E4E7ED;
        border-radius: 8px;
        color: #8D99AE;
        transition: all 0.3s ease;
    }

    .file-input-hidden:hover + .file-label {
        border-color: #D10024;
        color: #D10024;
        background: rgba(209, 0, 36, 0.02);
    }

    /* Submit Button */
    .submit-btn-modern {
        font-weight: 700;
        padding: 15px;
        border-radius: 80px !important;
        font-size: 16px;
        transition: all 0.3s ease;
        border: none;
        background-color: #D10024;
        color: #FFF;
    }

    .submit-btn-modern:hover {
        background-color: #B2001F;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(209, 0, 36, 0.3);
    }

    /* Alert Styling */
    .alert {
        border-radius: 10px;
        font-weight: 500;
    }
</style>
@endpush
