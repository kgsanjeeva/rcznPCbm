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

<!-- List Tickets -->
<section class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6 mt-3 mb-3">
        <form class="navbar-form" role="search">
          <div class="input-group">
            <input class="form-control" placeholder="Search" name="search" type="text" value="{{ request('search') }}">
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    @include('layouts.message')

    <div class="row">
      <table class="table table-striped">
        <thead>
          <th>Ticket #</th>
          <th>Client Name</th>
          <th>Status</th>
          <th>Last Update</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach($requests AS $request)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $request->client_name }}</td>
            <td>{{ $request->status }}</td>
            <td>{{ $request->updated_at->format('m/d/Y h:i a') }}</td>
            <td>
              <a href="{{ route('service-requests.edit',[$request->id]) }}" class="btn btn-primary">EDIT</a>
              <form method="POST" action="{{ route('service-requests.destroy', $request->id) }}" accept-charset="UTF-8"
                style="display:inline"><input name="_method" type="hidden" value="DELETE"><input type="hidden"
                  name="_token" value="{{ csrf_token() }}">
                <button title="Delete ServiceRequest" class="btn btn-danger"
                  onclick="return confirm('Are you sure?')">DELETE</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $requests->links() }}
    </div>
  </div>
</section>

@endsection