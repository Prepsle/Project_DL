@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách địa điểm</h1>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="/admin/dia-diem/add" class="btn btn-success btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm mới</span>
        </a>

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
                <th>Địa điểm</th>
                <th>Địa chỉ</th>
                <th>Loại địa điểm</th>
                <th>Danh mục du lịch</th>
                <th width="114">Công cụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diaDiemList as $item)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ $item->hinh_anh_dia_diem }}" target="_blank">
                            <img width="80" src="{{ $item->hinh_anh_dia_diem }}" alt="{{ $item->ten_dia_diem }}">
                        </a>
                        <span class="ml-2">{{ $item->ten_dia_diem }}</span>
                    </div>
                </td>
                <td>
                    <span>{{ $item->dia_chi }}, </span>
                    <span>{{ $item->xaPhuong->ten_xa_phuong }}, </span>
                    <span>{{ $item->xaPhuong->quanHuyen->ten_quan_huyen }}</span>
                </td>
                <td>{{ $item->loaiDiaDiem->ten_loai_dia_diem }}</td>
                <td>{{ $item->dmDuLich->ten_danh_muc }}</td>
                <td>
                    <a href="/admin/dia-diem/edit/{{ $item->ma_dia_diem }}" class="btn btn-warning rounded-circle"><i class="far fa-edit"></i></a>
                    <div onclick="removeRow('/admin/dia-diem/destroy', '{{ $item->ma_dia_diem }}')" class="btn btn-danger rounded-circle"><i class="fas fa-trash-alt"></i></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $diaDiemList->links() }}
    </div>
</div>
@endsection