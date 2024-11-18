@extends('admin.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Danh sách xã phường</h1>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="/admin/xa-phuong/add" class="btn btn-success btn-icon-split btn-sm">
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
                <th>Mã xã phường</th>
                <th>Tên xã phường</th>
                <th>Quận Huyện</th>
                <th width="114">Công cụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($xaPhuongList as $item)
            <tr>
                <td>{{ $item->ma_xa_phuong }}</td>
                <td>{{ $item->ten_xa_phuong }}</td>
                <td>{{ $item->quanHuyen->ten_quan_huyen }}</td>
                <td>
                    <a href="/admin/xa-phuong/edit/{{ $item->ma_xa_phuong }}" class="btn btn-warning rounded-circle"><i class="far fa-edit"></i></a>
                    <div onclick="removeRow('/admin/xa-phuong/destroy', '{{ $item->ma_xa_phuong }}')" class="btn btn-danger rounded-circle"><i class="fas fa-trash-alt"></i></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $xaPhuongList->links() }}
    </div>
</div>
@endsection
