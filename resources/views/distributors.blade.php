@extends("layouts.app")
@section("content")
    @include('nav_bar')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Top</th>
            <th scope="col">Distributor Name</th>
            <th scope="col">Total Sale</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($distributors))
            @foreach($distributors as $key => $distributor)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$distributor->name}}</td>
                    <td>${{ number_format($distributor->total) }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    {{$distributors->links()}}

@endsection


