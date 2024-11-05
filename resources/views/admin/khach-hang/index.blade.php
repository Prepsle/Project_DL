@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách thành viên</h1>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div></div>
        <form class="input-group" style="width: 300px">
            <input name="q" type="text" class="form-control" placeholder="Từ khoá" value="{{ $keyword }}">
            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr class="bg-primary text-white">
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach($khachHangList as $item)
            <tr>
                <td>{{ $item->ten_tai_khoan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->sdt }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $khachHangList->links() }}
    </div>
</div>
@endsection