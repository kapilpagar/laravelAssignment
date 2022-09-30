@extends ('layoutes.app')
@section('content')
<h1>HOme : {{Auth::user()->name}}</h1>
<h1>Email : {{Auth::user()->email}}</h1>
<h1>Contact : {{Auth::user()->contact}}</h1>
<h1>Address : {{Auth::user()->address}}</h1>
<h1>Country : {{Auth::user()->country}}</h1>
<h1>State : {{Auth::user()->state}}</h1>
<h1>City : {{Auth::user()->city}}</h1>
@endsection