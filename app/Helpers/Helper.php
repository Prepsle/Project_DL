<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function CreateUserID()
    {
        $lastUser = User::orderByDesc('user_id')->first();
        $year = substr(Carbon::now()->year, -2);

        if ($lastUser == null) {
            $number = '0001';
        } else {
            $number = ($year === substr($lastUser->user_id, 0, 2))
            ? sprintf('%04d', (int) substr($lastUser->user_id, -4) + 1)
            : '0001';
        }
        return $year . $number;
    }

    public static function Currency($number)
    {
        $formattedNumber = number_format($number, 0, ',', '.');
        return $formattedNumber . ' ₫';
    }

    public static function DateTime($str, $type = 'datetime')
    {
        $formats = [
            'date'     => 'd/m/Y',
            'time'     => 'H:i:s',
            'datetime' => 'H:i:s d/m/Y',
        ];
        return $str !== '' ? date($formats[$type], strtotime($str)) : '';
    }

    public static function DeleteTempImage($location, $model)
    {
        $thumbnail = array_map(function ($t) {
            return str_replace('/storage/', '', $t);
        }, $model::pluck('thumbnail')->toArray());

        $storageImage = array_map(function ($t) {
            return str_replace('public/', '', $t);
        }, Storage::allFiles('public/' . $location));

        $unusedImages = array_diff($storageImage, $thumbnail);

        foreach ($unusedImages as $image) {
            Storage::disk('public')->delete($image);
            echo '<br/> Đã xóa hình ảnh: /storage/' . $image;
        }
    }

    public static function SelectedDiaDiem($diaDiemList, $diaDiem)
    {
        return $diaDiemList->pluck('ma_dia_diem')->contains($diaDiem->ma_dia_diem) ? 'selected' : '';
    }

    public static function UploadImage($file, $fileLocation)
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/' . $fileLocation, $fileName);
        return "/storage/$fileLocation/$fileName";
    }

    public static function GetCategoryName($categorySlug)
    {
        $category = Category::where('category_slug', $categorySlug)->first();
        return $category ? $category->category_name : '';
    }
}