@extends('home.master')

@section('content')
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
        }
        .cart-item .item-info {
            flex-grow: 1;
        }
        .cart-item .item-quantity {
            display: flex;
            align-items: center;
        }
        .cart-item .item-quantity button {
            width: 30px;
            height: 30px;
            border: none;
            background-color: #007bff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .cart-item .item-quantity input {
            width: 40px;
            text-align: center;
            border: 1px solid #ced4da;
            margin: 0 5px;
        }
        .cart-item .item-remove {
            margin-left: 20px;
            cursor: pointer;
            color: #dc3545;
        }
        .cart-summary {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
        }
        .btn-clear, .btn-checkout {
            width: 100%;
            padding: 10px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-clear {
            background-color: #dc3545;
        }
        .btn-checkout {
            background-color: #343a40;
        }
    </style>

    <div class="container cart-container">
        <h2 class="text-center">Giỏ Hàng</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(empty($cart))
            <p class="text-center">Giỏ hàng của bạn đang trống.</p>
        @else
            <div class="row">
                <!-- Sản phẩm trong giỏ hàng -->
                <div class="col-md-8">
                    <div id="cart-items">
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cart as $item)
                        <div class="cart-item" data-price="{{ $item->price }}">
                            <img src="{{ $item->image }}" alt="{{ $item->product_name }}">
                            <div class="item-info">
                                <h5>{{ $item->product_name }}</h5>
                            </div>
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="item-quantity">
                                    <button type="button" class="btn-minus">-</button>
                                    <input type="text" name="quantity" value="{{ $item->quantity }}" min="1">
                                    <button type="button" class="btn-plus">+</button>
                                </div>
                            </form>
                            <div id="total-{{ $item->id }}" class="item-total">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} vnđ</div>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->ma_bai_viet }}">
                                <button type="submit" class="item-remove"><i class="fas fa-times"></i></button>
                            </form>
                        </div>
                        
                        @endforeach        
                    </div>
                        <button class="btn-clear"><a href="{{ route('cart.clear') }}">Xóa Tất Cả</a></button>
                    </div>

                <!-- Tóm tắt giỏ hàng -->
                <div class="col-md-4">
                    <div class="cart-summary">
                        <h5>Tổng Giỏ Hàng</h5>
                        <div class="summary-item">
                            <span>SỐ LƯỢNG:</span>
                            <span id="total-quantity">{{ count($cart) }}</span>
                        </div>
                        <div class="summary-item">
                            <span>TỔNG:</span>
                            <span id="total-price">{{ number_format($total, 0, ',', '.') }} vnđ</span>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><a href="{{route('checkout')}}"  style="color: black; text-decoration: none;">Đặt hàng</a></button>
                    </div>
                </div>
            </div>
        @endif
    </div>  

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const minusButtons = document.querySelectorAll('.btn-minus');
            const plusButtons = document.querySelectorAll('.btn-plus');
            const quantityInputs = document.querySelectorAll('.item-quantity input');

            // Hàm cập nhật số lượng và tính lại giá
            function updateQuantity(index, change) {
                const input = quantityInputs[index];
                let quantity = parseInt(input.value) + change;
                if (quantity < 1) quantity = 1; // Đảm bảo quantity không nhỏ hơn 1
                input.value = quantity; // Cập nhật quantity trong DOM

                // Lấy id và price từ thuộc tính data-price trong phần tử cart-item
                const cartItem = input.closest('.cart-item');
                const itemId = cartItem.querySelector('input[name="id"]').value;
                const price = parseFloat(cartItem.dataset.price); // Lấy giá từ data-price

                // Cập nhật giá trực tiếp trên giao diện
                updateItemTotal(itemId, price, quantity);

                // Gọi hàm gửi yêu cầu AJAX để cập nhật giỏ hàng trên server
                updateCart(itemId, quantity);
            }

            // Hàm gửi yêu cầu AJAX để cập nhật giỏ hàng
            function updateCart(itemId, quantity) {
                fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: itemId, // id không thay đổi
                        quantity: quantity // Chỉ thay đổi quantity
                    })
                })
                .then(async (response) => {
                    const contentType = response.headers.get('content-type');
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Chi tiết lỗi từ server:', errorText);
                        throw new Error('Yêu cầu thất bại với mã lỗi: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Cập nhật lại tổng tiền và tổng số lượng
                        updateTotalPrice(data.totalPrice);
                        updateTotalQuantity(data.totalQuantity);
                    } else {
                        alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            // Cập nhật giá trực tiếp trong DOM khi thay đổi số lượng
            function updateItemTotal(itemId, price, quantity) {
                const totalElement = document.getElementById(`total-${itemId}`);
                const totalPrice = price * quantity;

                // Định dạng giá theo kiểu decimal với dấu phân cách thập phân và phân cách hàng nghìn
                const formattedPrice = new Intl.NumberFormat('vi-VN', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2,
                }).format(totalPrice);

                // Cập nhật giá mới với định dạng
                totalElement.textContent = `${formattedPrice} vnđ`;
            }

            // Cập nhật tổng số lượng
            function updateItemTotal(itemId, price, quantity) {
                const totalElement = document.getElementById(`total-${itemId}`);
                const totalPrice = price * quantity;

                // Định dạng giá theo kiểu decimal với dấu phân cách thập phân và phân cách hàng nghìn
                const formattedPrice = new Intl.NumberFormat('vi-VN', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2,
                }).format(totalPrice);

                // Cập nhật giá mới với định dạng
                totalElement.textContent = `${formattedPrice} vnđ`;
            }

            // Cập nhật tổng giá
            function updateTotalPrice(totalPrice) {
                document.getElementById('total-price').textContent = `${totalPrice} vnđ`;
            }

            // Gắn sự kiện click cho các nút
            minusButtons.forEach((btn, index) => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    updateQuantity(index, -1); // Giảm số lượng khi nhấn dấu trừ
                });
            });

            plusButtons.forEach((btn, index) => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    updateQuantity(index, 1); // Tăng số lượng khi nhấn dấu cộng
                });
            });
        });
    </script>
     
@endsection
