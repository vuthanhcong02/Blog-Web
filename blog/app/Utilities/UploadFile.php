<?php

namespace App\Utilities;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UploadFile
{
    public static function uploadFile($file, $path)
    {
        // Lấy tên gốc của file khi người dùng tải lên
        $file_name_original = $file->getClientOriginalName();
        // Lấy phần mở rộng (extension) của file (ví dụ: jpg, png, pdf, ...)
        $extension = $file->getClientOriginalExtension();
         // Loại bỏ phần mở rộng khỏi tên file gốc (để chuẩn bị đổi tên file)
        $file_name_without_extension = Str::replaceLast('.'.$extension, '', $file_name_original);

        // Tạo tên mới cho file dựa trên tên gốc, thời gian hiện tại, và một số ngẫu nhiên
        $str_time_now = Carbon::now()->format('ymd_his');

        $file_name = Str::slug($file_name_without_extension) . '_' . uniqid() . '_' . $str_time_now . '.' . $extension; // Str::slug thiết đặt tên file dựa trên tên gốc, thời gian hiện tại, và một số ngẫu nhiên
         // Di chuyển file vào thư mục đích (đường dẫn được truyền vào biến $path)
        $file->move($path, $file_name);
        return $file_name;
    }
}
