<?php 
function dem_3_buoc() {
    echo "--- Generator Bắt đầu ---" . "\n";
    
    $i = 1;
    yield $i;
    
    echo "Generator Tạm dừng (1) và Đang tiếp tục..." . "\n";
    
    $i = $i + 1; // Giá trị $i được giữ nguyên từ lần trước (là 1)
    yield $i;
    
    echo "Generator Tạm dừng (2) và Đang tiếp tục..." . "\n";
    
    $i = $i * 2; // Giá trị $i được giữ nguyên từ lần trước (là 2)
    yield $i;
    
    echo "--- Generator Kết thúc ---" . "\n";
}

echo "BƯỚC 0: Khởi tạo vòng lặp.\n";

foreach (dem_3_buoc() as $value) {
    echo "=> Vòng lặp nhận được giá trị: " . $value . "\n";
    echo "--- Vòng lặp Tạm dừng để gọi lần tiếp theo ---\n";
}