@extends('web.layouts.app')

@section('content')
<div class="sale-section section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="sale-card">

                    @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('message.type') }} alert-dismissible shadow-sm">
                            {{ Session::get('message.text') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    <div class="card-header-modern">
                        <div class="icon-circle-sale">
                            <i class="fa fa-tag"></i>
                        </div>
                        <h3 class="title">{{ __('Sale Request') }}</h3>
                        <p>{{ __('Turn your items into cash. Submit your item details below.') }}</p>
                    </div>

                    <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
                        @csrf

                        <div class="form-group-modern">
                            <label><i class="fa fa-user"></i> {{ __('Name & Phone') }}</label>
                            <input type="text" name="name" class="input-modern" placeholder="e.g. Mahmoud - 010xxxx" required>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="fa fa-dollar"></i> {{ __('Expected Price') }}</label>
                            <input type="text" name="price" class="input-modern" placeholder="e.g. 500 EGP" required>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="fa fa-edit"></i> {{ __('Item Description') }}</label>
                            <textarea name="description" rows="3" class="input-modern" placeholder="{{ __('What are you selling?') }}"></textarea>
                        </div>

                        <div class="form-group-modern">
                            <label><i class="fa fa-image"></i> {{ __('Item Image') }}</label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="image" id="sale-image" class="file-input-hidden" onchange="previewImage(this)">
                                <label for="sale-image" class="file-label" id="file-label-text">
                                    <i class="fa fa-cloud-upload"></i>
                                    <span>{{ __('Click to upload item photo') }}</span>
                                </label>
                                <img id="image-preview" src="#" alt="Preview" style="display:none; width:100%; margin-top:10px; border-radius:8px; border:1px solid #ddd;">
                            </div>
                        </div>

                        <button type="submit" class="primary-btn btn-block submit-btn-modern">
                            {{ __('Submit Sale Request') }} <i class="fa fa-check-circle"></i>
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
    .sale-section {
        background-color: #fbfbfb;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .sale-card {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }

    .card-header-modern {
        text-align: center;
        margin-bottom: 30px;
    }

    .icon-circle-sale {
        width: 70px;
        height: 70px;
        background: #D10024; /* Electro Red */
        color: #fff;
        line-height: 70px;
        font-size: 30px;
        border-radius: 50%;
        margin: 0 auto 15px;
        box-shadow: 0 5px 15px rgba(209, 0, 36, 0.2);
    }

    .form-group-modern {
        margin-bottom: 20px;
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
    }

    /* File Upload */
    .file-upload-wrapper { position: relative; width: 100%; }
    .file-input-hidden { position: absolute; left: 0; top: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer; }
    .file-label {
        display: block;
        padding: 15px;
        text-align: center;
        background: #F9FAFB;
        border: 2px dashed #E4E7ED;
        border-radius: 8px;
        color: #8D99AE;
        transition: 0.3s;
    }
    .file-input-hidden:hover + .file-label { border-color: #D10024; color: #D10024; }

    /* Button */
    .submit-btn-modern {
        font-weight: 700;
        padding: 15px;
        border-radius: 50px !important;
        font-size: 16px;
        border: none;
        background-color: #D10024;
        color: #FFF;
        margin-top: 10px;
    }
    .submit-btn-modern:hover {
        background-color: #B2001F;
        transform: translateY(-2px);
    }
</style>
@endpush

@push('js')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).fadeIn();
                $('#file-label-text').find('span').text(input.files[0].name);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
