@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Chỉnh sửa loại địa điểm</h1>

    <form method="POST">
        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tên loại địa điểm</label>
                        <input name="ten_loai_dia_diem" type="text" class="form-control" value="{{ $loaiDiaDiem->ten_loai_dia_diem }}">
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Lưu</span>
        </button>
        <a href="/admin/loai-dia-diem/" class="btn btn-danger btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-ban"></i>
            </span>
            <span class="text">Huỷ bỏ</span>
        </a>

        @csrf
    </form>
</div>
@endsection
