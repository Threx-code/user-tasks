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
        <td data-toggle="modal" data-target="#items{{$key}}" style="cursor: pointer">
            View Item
            <div class="modal fade" id="items{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$key}}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $orderItem = (json_decode($order['orderItem'], true));@endphp
                                @foreach($orderItem as $item)
                                <tr>
                                    <td>{{$item['product']['sku'] ?? ''}}</td>
                                    <td>{{$item['product']['name'] ?? ''}}</td>
                                    <td>{{ number_format($item['product']['price'] ?? 0) }}</td>
                                    <td>{{$item['qantity'] }}</td>
                                    <td>{{$item['qantity'] * ($item['product']['price'] ?? 0)}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>
{{$orders->links()}}

@endsection


