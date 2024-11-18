@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Thêm địa điểm</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ảnh địa điểm</label>
                        <input type="file" class="dropify" name="hinh_anh_dia_diem" />
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Tên địa điểm</label>
                            <input name="ten_dia_diem" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <div class="d-flex">
                                <input name="dia_chi" type="text" class="flex-1 form-control">
                                <select name="ma_xa_phuong" class="flex-1 form-control ml-3" required>
                                    @foreach($xaPhuongList as $item)
                                    <option value="{{ $item->ma_xa_phuong }}">
                                        {{ $item->ten_xa_phuong }} - {{ $item->quanHuyen->ten_quan_huyen }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Loại địa điểm</label>
                                <select name="ma_loai_dia_diem" class="form-control" required>
                                    @foreach($loaiDiaDiemList as $item)
                                    <option value="{{ $item->ma_loai_dia_diem }}">
                                        {{ $item->ten_loai_dia_diem }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Danh mục du lịch</label>
                                <select name="ma_danh_muc" class="form-control" required>
                                    @foreach($dmDuLichList as $item)
                                    <option value="{{ $item->ma_danh_muc }}">
                                        {{ $item->ten_danh_muc }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea id="summernote" name="mo_ta_dia_diem"></textarea>
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
        <a href="/admin/dia-diem" class="btn btn-danger btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-ban"></i>
            </span>
            <span class="text">Huỷ bỏ</span>
        </a>

        @csrf
    </form>
</div>
@endsection