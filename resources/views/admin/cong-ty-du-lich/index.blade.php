@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách công ty du lịch</h1>

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
                <th>Giấy phép</th>
                <th>Duyệt</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($congTyDuLichList as $item)
            <tr>
                <td class="d-flex align-items-center">
                    <a href="{{ $item->hinh_dai_dien }}" target="_blank">
                        <img width="60" src="{{ $item->hinh_dai_dien }}" alt="">
                    </a>
                    <span class="ml-2">{{ $item->ten_tai_khoan }}</span>
                </td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->sdt }}</td>
                <td>
                    <a href="{{ $item->giay_phep_kd }}" download>Tải về</a>
                </td>
                <td>
                    @if($item->da_duyet == 1)
                    <span class="badge badge-success">Đã duyệt</span>
                    @else
                    <span class="badge badge-danger">Chưa duyệt</span>
                    @endif
                </td>
                <td>
                    @if($item->da_duyet == 0)
                    <a href="?ma_tai_khoan={{ $item->ma_tai_khoan }}&active=1" class="btn btn-sm btn-success">Duyệt ngay</a>
                    <a href="?ma_tai_khoan={{ $item->ma_tai_khoan }}&active=2" class="btn btn-sm btn-danger">Không duyệt</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $congTyDuLichList->links() }}
    </div>
</div>
@endsection