@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách bài viết</h1>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="/admin/bai-viet/add" class="btn btn-success btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>

        <form class="input-group" style="width: 400px">
            <input name="start_date" type="date" class="form-control" value="{{ $start_date }}">
            <input name="end_date" type="date" class="form-control"  value="{{ $end_date }}">
            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

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
                <th>Bài viết</th>
                <th width="25%">Nội dung</th>
                <th>Lượt xem</th>
                <th>Địa điểm</th>
                <th>Ngày đăng</th>
                <th>Tác giả</th>
                <th width="180">Công cụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baiVietList as $item)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ $item->hinh_anh_bai_viet }}" target="_blank">
                            <img width="80" src="{{ $item->hinh_anh_bai_viet }}" alt="{{ $item->ten_bai_viet }}">
                        </a>
                        <span class="ml-2">{{ $item->ten_bai_viet }}</span>
                    </div>
                </td>
                <td>
                    <div class="two-line">
                        {!! $item->mo_ta_ngan !!}
                    </div>
                </td>
                <td>{{ $item->luot_xem_bai_viet }}</td>
                <td>
                    @foreach($item->diaDiemList as $diaDiem)
                    <span class="badge badge-primary">{{ $diaDiem->ten_dia_diem }}</span>
                    @endforeach
                </td>
                <td>{{ App\Helpers\Helper::DateTime($item->ngay_dang_bai_viet) }}</td>
                <td>{{ $item->nguoiDangBaiViet->ten_tai_khoan }}</td>
                <td>
                    <a href="/admin/bai-viet/view-comment/{{ $item->ma_bai_viet }}" class="btn btn-info rounded-circle"><i class="far fa-comments"></i></a>
                    <a href="/admin/bai-viet/edit/{{ $item->ma_bai_viet }}" class="btn btn-warning rounded-circle"><i class="far fa-edit"></i></a>
                    <div onclick="removeRow('/admin/bai-viet/destroy', '{{ $item->ma_bai_viet }}')" class="btn btn-danger rounded-circle"><i class="fas fa-trash-alt"></i></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $baiVietList->links() }}
    </div>
</div>
@endsection