@extends('home.master')

@section('content')
<style>
    /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f8f9fa;
    line-height: 1.6;
}

.order-details-container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    margin-bottom: 0px;
}

p {
    margin-bottom: 10px;
}

.order-info, .customer-info, .product-list, .order-total {
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    text-align: left;
    padding: 10px;
    border: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: #fff;
}

.order-total p {
    font-size: 16px;
}

.order-total .grand-total {
    font-size: 18px;
    color: #e63946;
    font-weight: bold;
}

</style>
<div class="order-details-container">
    <h1 style="font-size: 30px" class="order-title">Chi tiết Đơn hàng</h1>

    <!-- Thông tin đơn hàng -->
    <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> #123456789</p>
        <p><strong>Ngày đặt hàng:</strong> 25/11/2023</p>
        <p><strong>Trạng thái:</strong> Đang xử lý</p>
    </div>

    <!-- Thông tin khách hàng -->
    @if (Auth::check())
        <div class="customer-info">
            <h2 style="font-size: 30px">Thông tin khách hàng</h2>
            <p><strong>Họ và tên:</strong> {{ Auth::user()->ten_tai_khoan }}</p>
            <p><strong>Số điện thoại:</strong> {{ Auth::user()->sdt }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    @endif

    <!-- Danh sách sản phẩm -->
    <div class="product-list">
        <h2 style="font-size: 30px">Sản phẩm đã đặt</h2>
        <table>
            <thead>
                <tr>
                    <th>Tên tour</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>{{$item['product_name']}}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{$item['price']}} vnđ</td>
                        <td>{{$item['price'] * $item['quantity']}} vnđ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tổng thanh toán -->
    {{-- <div class="order-total">
        <p><strong>Tổng tiền:</strong> 1,600,000₫</p>
        <p><strong>Phí vận chuyển:</strong> 30,000₫</p>
        <p class="grand-total"><strong>Thành tiền:</strong> 1,630,000₫</p>
    </div> --}}
    <form action="{{ route('checkout.order')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Đặt hàng</button>
    </form>  
</div>
@endsection
