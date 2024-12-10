@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Tất cả các đơn hàng</h1>

    <table class="table table-bordered bg-white">
        <thead>
            <tr class="bg-primary text-white">
                <th>Tên Tour</th>
                <th>Người đặt</th>
                <th>sđt</th>
                <th>email</th>
                <th>Số lượng</th>
                <th>Tổng giá</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($orderDetails as $orderDetails)
            <tr>
                <td>{{ $orderDetails->ten_bai_viet }}</td>
                <td>{{ $orderDetails->ten_tai_khoan }}</td>
                <td>{{ $orderDetails->sdt }}</td>
                <td>{{ $orderDetails->email }}</td>
                <td>{{ $orderDetails->quantity }}</td>
                <td>{{ $orderDetails->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection