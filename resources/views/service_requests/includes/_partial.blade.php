@if(!empty($vehicleModels))
<select class="form-control @error('vehicle_model') is-invalid @enderror" name="vehicle_model" required
    autocomplete="vehicle_model">
    @foreach($vehicleModels as $id=>$val)
    <option value="{{ $id }}">{{ $val }}</option>
    @endforeach
</select>
@endif