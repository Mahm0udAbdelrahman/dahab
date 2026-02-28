@extends('web.layouts.app')

@section('content')

<div class="maintenance-wrapper">
    <div class="maintenance-form-card">

        <!-- Flash Message -->
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('message.type') }} alert-dismissible">
                {{ Session::get('message.text') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <!-- Header -->
        <div class="form-header">
            <i class="fa fa-tools"></i>
            <h4>{{ __('Maintenance Request') }}</h4>
            <p>{{ __('Please fill the form below to submit your maintenance request.') }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('maintenance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group-modern">
                <label>{{ __('Name Phone') }}</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group-modern">
                <label>{{ __('Description') }}</label>
                <textarea name="description" rows="4" class="form-control"></textarea>
            </div>

            <div class="form-group-modern">
                <label>{{ __('Upload Image') }}</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">
                <i class="fa fa-paper-plane mr-1"></i>
                {{ __('Submit Request') }}
            </button>

        </form>
    </div>
</div>

@endsection


@push('css')
<style>
/* ====== CENTER FORM ====== */
.maintenance-wrapper {
    min-height: calc(100vh - 150px);
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    padding: 20px;
}

/* ====== CARD ====== */
.maintenance-form-card {
    width: 100%;
    max-width: 520px;
    background: #fff;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
}

/* ====== HEADER ====== */
.form-header {
    text-align: center;
    margin-bottom: 25px;
}

.form-header i {
    font-size: 34px;
    color: var(--primary, #007bff);
    margin-bottom: 8px;
}

.form-header p {
    color: #777;
    font-size: 14px;
}

/* ====== FORM ====== */
.form-group-modern label {
    font-weight: 500;
    margin-bottom: 6px;
}

.form-control,
.form-control-file {
    border-radius: 8px;
    padding: 10px;
}

/* ====== BUTTON ====== */
.btn-primary {
    border-radius: 8px;
    padding: 10px;
}
</style>
@endpush
