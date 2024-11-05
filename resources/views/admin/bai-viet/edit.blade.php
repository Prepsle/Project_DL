@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Chỉnh sửa bài viết</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ảnh bài viết</label>
                        <input type="file" class="dropify" name="hinh_anh_bai_viet" data-default-file="{{ $baiViet->hinh_anh_bai_viet }}" />
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Tên bài viết</label>
                            <input name="ten_bai_viet" type="text" class="form-control" value="{{ $baiViet->ten_bai_viet }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <input name="mo_ta_ngan" type="text" class="form-control" value="{{ $baiViet->mo_ta_ngan }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa điểm</label>
                            <select name="ma_dia_diem[]" class="select2 form-control" multiple="multiple">
                                @foreach($diaDiemList as $item)
                                <option value="{{ $item->ma_dia_diem }}" {!! App\Helpers\Helper::SelectedDiaDiem($baiViet->diaDiemList, $item) !!}>
                                    {{ $item->ten_dia_diem }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung bài viết</label>
                            <textarea id="summernote" name="noi_dung_bai_viet">{{ $baiViet->noi_dung_bai_viet }}</textarea>
                        </div>
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
        <a href="/admin/bai-viet" class="btn btn-danger btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-ban"></i>
            </span>
            <span class="text">Huỷ bỏ</span>
        </a>

        @csrf
    </form>
</div>
@endsection