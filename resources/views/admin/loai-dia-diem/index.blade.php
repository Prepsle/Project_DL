@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách loại địa điểm</h1>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="/admin/loai-dia-diem/add" class="btn btn-success btn-icon-split btn-sm">
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
                <th>Mã loại địa điểm</th>
                <th>Tên loại địa điểm</th>
                <th width="114">Công cụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loaiDiaDiemList as $item)
            <tr>
                <td>{{ $item->ma_loai_dia_diem }}</td>
                <td>{{ $item->ten_loai_dia_diem }}</td>
                <td>
                    <a href="/admin/loai-dia-diem/edit/{{ $item->ma_loai_dia_diem }}" class="btn btn-warning rounded-circle"><i class="far fa-edit"></i></a>
                    <div onclick="removeRow('/admin/loai-dia-diem/destroy', '{{ $item->ma_loai_dia_diem }}')" class="btn btn-danger rounded-circle"><i class="fas fa-trash-alt"></i></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $loaiDiaDiemList->links() }}
    </div>
</div>
@endsection