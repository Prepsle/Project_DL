<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Giao Dịch Bitcoin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Kiểm Tra Thông Tin Ví</h2>
        <form id="wallet-info-form">
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ ví Bitcoin</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-primary">Kiểm tra</button>
        </form>
        <div id="wallet-info-result" class="mt-3"></div>

        <hr>

        <h2>Gửi Giao Dịch Bitcoin</h2>
        <form id="transaction-form">
            <div class="mb-3">
                <label for="from" class="form-label">Địa chỉ ví gửi</label>
                <input type="text" class="form-control" id="from" name="from" required>
            </div>
            <div class="mb-3">
                <label for="to" class="form-label">Địa chỉ ví nhận</label>
                <input type="text" class="form-control" id="to" name="to" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Số lượng (satoshi)</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="mb-3">
                <label for="private_key" class="form-label">Private Key (Chỉ dùng thử nghiệm)</label>
                <input type="text" class="form-control" id="private_key" name="private_key" required>
            </div>
            <button type="submit" class="btn btn-success">Gửi Giao Dịch</button>
        </form>
        <div id="transaction-result" class="mt-3"></div>
    </div>

    <script>
        // Kiểm tra thông tin ví
        $('#wallet-info-form').on('submit', function(e) {
            e.preventDefault();
            const address = $('#address').val();

            $.post("{{ route('payment.walletInfo') }}", { address: address }, function(data) {
                $('#wallet-info-result').html(`<pre>${JSON.stringify(data, null, 2)}</pre>`);
            }).fail(function(xhr) {
                $('#wallet-info-result').html(`<pre>Error: ${xhr.responseText}</pre>`);
            });
        });

        // Gửi giao dịch
        $('#transaction-form').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.post("{{ route('payment.sendTransaction') }}", formData, function(data) {
                $('#transaction-result').html(`<pre>${JSON.stringify(data, null, 2)}</pre>`);
            }).fail(function(xhr) {
                $('#transaction-result').html(`<pre>Error: ${xhr.responseText}</pre>`);
            });
        });
    </script>
</body>
</html>
