@extends("layouts.app")
@section("content")
    @include('nav_bar')
    @include('search_form')

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Invoice</th>
                <th scope="col">Purchaser</th>
                <th scope="col">Distributor</th>
                <th scope="col">Referred Distributors</th>
                <th scope="col">Order date</th>
                <th scope="col">Order Total</th>
                <th scope="col">Percentage</th>
                <th scope="col">Commission</th>
                <th scope="col" style="width: 100px;"></th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data))
                @foreach($data as $key => $order)
                <tr>
                    <td>{{$order['invoice']}}</td>
                    <td>{{$order['purchaser']}}</td>
                    <td>{{$order['distributor']}}</td>
                    <td>{{$order['referred_distributors']}}</td>
                    <td>{{$order['order_date']}}</td>
                    <td>{{ number_format($order['total']) }}</td>
                    <td>{{$order['percentage']}}</td>
                    <td>{{$order['commission']}}</td>

                @endforeach
            @endif
        </tbody>
    </table>
    {{$orders->links()}}

@endsection


