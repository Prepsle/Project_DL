@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Bình luận: {{ $baiViet->ten_bai_viet }}</h1>

    <div class="my-5 ml-auto" style="width: 300px">
        <!-- <form class="input-group mb-3">
            <select name="trang_thai_binh_luan" class="form-control">
                <option value="" {{ $trang_thai_binh_luan == '' ? 'selected' : '' }}>Tất cả</option>
                <option value="cho_xac_nhan" {{ $trang_thai_binh_luan == 'cho_xac_nhan' ? 'selected' : '' }}>Chờ xác nhận</option>
                <option value="da_xac_nhan" {{ $trang_thai_binh_luan == 'da_xac_nhan' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="khong_xac_nhan" {{ $trang_thai_binh_luan == 'khong_xac_nhan' ? 'selected' : '' }}>Không xác nhận</option>
            </select>
            <button class="btn btn-primary">Lọc</button>
        </form> -->
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr class="bg-primary text-white">
                <th>Tài khoản</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @if($trang_thai_binh_luan == '')
            @foreach($baiViet->binhLuanList('cho_xac_nhan') as $item)
            <tr>
                <td>{{ $item->taiKhoan->ten_tai_khoan }}</td>
                <td>{{ $item->chi_tiet_binh_luan }}</td>
                <td>
                    @if($item->trang_thai_binh_luan == 'cho_xac_nhan')
                    <span class="badge badge-warning">Chờ xác nhận</span>
                    @elseif($item->trang_thai_binh_luan == 'da_xac_nhan')
                    <span class="badge badge-success">Đã xác nhận</span>
                    @else
                    <span class="badge badge-danger">Không xác nhận</span>
                    @endif
                </td>
                <td>{{ App\Helpers\Helper::DateTime($item->thoi_gian_binh_luan) }}</td>
                <td>
                    @if($item->trang_thai_binh_luan == 'cho_xac_nhan')
                    <a href="?action=update&ma_binh_luan={{ $item->ma_binh_luan }}&trang_thai_binh_luan=da_xac_nhan" class="btn btn-success btn-sm">Xác nhận</a>
                    <a href="?action=update&ma_binh_luan={{ $item->ma_binh_luan }}&trang_thai_binh_luan=khong_xac_nhan" class="btn btn-danger btn-sm">Không xác nhận</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            @foreach($baiViet->binhLuanList($trang_thai_binh_luan) as $item)
            <tr>
                <td>{{ $item->taiKhoan->ten_tai_khoan }}</td>
                <td>{{ $item->chi_tiet_binh_luan }}</td>
                <td>
                    @if($item->trang_thai_binh_luan == 'cho_xac_nhan')
                    <span class="badge badge-warning">Chờ xác nhận</span>
                    @elseif($item->trang_thai_binh_luan == 'da_xac_nhan')
                    <span class="badge badge-success">Đã xác nhận</span>
                    @else
                    <span class="badge badge-danger">Không xác nhận</span>
                    @endif
                </td>
                <td>{{ App\Helpers\Helper::DateTime($item->thoi_gian_binh_luan) }}</td>
                <td>
                    @if(Auth::user()->ma_loai_tai_khoan == 1 && $item->trang_thai_binh_luan == 'cho_xac_nhan')
                    <a href="?action=update&ma_binh_luan={{ $item->ma_binh_luan }}&trang_thai_binh_luan=da_xac_nhan" class="btn btn-success btn-sm">Xác nhận</a>
                    <a href="?action=update&ma_binh_luan={{ $item->ma_binh_luan }}&trang_thai_binh_luan=khong_xac_nhan" class="btn btn-danger btn-sm">Không xác nhận</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
