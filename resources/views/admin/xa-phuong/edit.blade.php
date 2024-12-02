@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Chỉnh sửa xã phường</h1>

    <form method="POST">
        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tên xã phường</label>
                        <input name="ten_xa_phuong" type="text" class="form-control" value="{{ $xaPhuong->ten_xa_phuong }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Quận huyện</label>
                        <select name="ma_quan_huyen" class="form-control">
                            @foreach($quanHuyenList as $item)
                            <option value="{{ $item->ma_quan_huyen }}" {{ $xaPhuong->ma_quan_huyen == $item->ma_quan_huyen ? "selected" : "" }}>
                                {{ $item->ten_quan_huyen }}
                            </option>
                            @endforeach
                        </select>
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
        <a href="/admin/xa-phuong/" class="btn btn-danger btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-ban"></i>
            </span>
            <span class="text">Huỷ bỏ</span>
        </a>

        @csrf
    </form>
</div>
@endsection
