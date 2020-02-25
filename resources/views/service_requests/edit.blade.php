@extends('layouts.main')
@section('content')
<!-- Masthead -->
<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5">Let's get your vehicle back on the trail!</h1>
            </div>
        </div>
    </div>
</header>

<section class="bg-light">
    <div class="container">
        <h1>Update Service Request form</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('service-requests.update', $serviceRequest->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="vehicle_make">Vehicle Make</label>
                <select class="form-control @error('vehicle_make') is-invalid @enderror" name="vehicle_make"
                    id="vehicle_make" required autocomplete="vehicle_make">
                    @foreach($vehicleMakes as $id=>$val)
                    <option value="{{ $id }}" @if((old('vehicle_make') ?? $serviceRequest->
                        vehicleModel->vehicle_make_id) == $id)selected
                        @endif>{{
                        $val }}</option>
                    @endforeach
                </select>
                @error('vehicle_make')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicle_model">Vehicle Model</label>

                <select id="vehicle_model" class="form-control @error('vehicle_model') is-invalid @enderror"
                    name="vehicle_model_id" required autocomplete="vehicle_model">
                    @foreach($vehicleModels as $id=>$val)
                    <option value="{{ $id }}" @if((old('vehicle_make') ?? $serviceRequest->vehicle_model_id)
                        ==$id)selected @endif>{{ $val }}</option>
                    @endforeach
                </select>

                @error('vehicle_model')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="client_name">Client Name</label>

                <input type="client_name" class="form-control @error('client_name') is-invalid @enderror"
                    name="client_name" value="{{ old('client_name') ?? $serviceRequest->client_name }}" required
                    autocomplete="client_name">

                @error('client_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="client_phone">Client Phone</label>

                <input type="client_phone" class="form-control @error('client_phone') is-invalid @enderror"
                    name="client_phone" value="{{ old('client_phone') ?? $serviceRequest->client_phone }}" required
                    autocomplete="client_phone">

                @error('client_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="client_email">Client Email</label>

                <input type="client_email" class="form-control @error('client_email') is-invalid @enderror"
                    name="client_email" value="{{ old('client_email') ?? $serviceRequest->client_email }}" required
                    autocomplete="client_email">

                @error('client_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Service Description</label>

                <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                    rows="5" required
                    autocomplete="description">{{ old('description') ?? $serviceRequest->description }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>
    </div>
</section>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).on("change", "#vehicle_make", function() {
        $.ajax({
            url: "{{ route('model-by-make') }}?vehicle_make_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                if (data.response) {
                    $('#vehicle_model').html(data.vehicleModels);
                }
            }
        });
    });
</script>
@endsection