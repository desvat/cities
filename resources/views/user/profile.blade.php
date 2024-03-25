<!-- @extends('layouts.app') -->



@section('content')

    <div style="height: 400px; background-color: #ffffff; padding: 50px">

        <p>Meno: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>

    </div>

@endsection