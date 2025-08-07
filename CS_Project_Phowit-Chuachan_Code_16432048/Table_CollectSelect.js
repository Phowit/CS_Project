// Table_CollectSelect.js

// เมื่อ DOM โหลดเสร็จแล้ว ให้ทำงาน
document.addEventListener('DOMContentLoaded', function() {
    // อ้างอิงถึง element ที่เกี่ยวข้อง
    const selectMonth = document.getElementById('selectMonth');
    const selectYear = document.getElementById('selectYear');
    const searchButton = document.getElementById('searchTableData'); // ใช้ ID ของปุ่มค้นหาในตาราง
    const displaySelectedMonthYear = document.getElementById('displaySelectedMonthYear');

    // ลิสต์ชื่อเดือนภาษาไทยสำหรับแสดงผลในหัวตาราง
    const thaiMonthsNames = {
        '1': 'มกราคม', '2': 'กุมภาพันธ์', '3': 'มีนาคม', '4': 'เมษายน',
        '5': 'พฤษภาคม', '6': 'มิถุนายน', '7': 'กรกฎาคม', '8': 'สิงหาคม',
        '9': 'กันยายน', '10': 'ตุลาคม', '11': 'พฤศจิกายน', '12': 'ธันวาคม'
    };

    // ฟังก์ชันสำหรับอัปเดต URL และโหลดข้อมูลตารางใหม่
    function updateTableByMonthYear() {
        const selectedMonth = selectMonth.value;
        const selectedYear = selectYear.value;

        // อัปเดตข้อความแสดงผลในหัวตารางทันที (ก่อนโหลดหน้าใหม่)
        const selectedMonthName = thaiMonthsNames[selectedMonth];
        const selectedYearBE = parseInt(selectedYear) + 543;
        if (displaySelectedMonthYear) { // ตรวจสอบว่า element มีอยู่จริง
            displaySelectedMonthYear.textContent = `${selectedMonthName} ${selectedYearBE}`;
        }

        // สร้าง URL ใหม่พร้อมกับ month และ year
        // ให้โหลด Admin_TableCollect.php ใหม่ พร้อมส่งค่าเดือนและปีไป
        const url = new URL(window.location.origin + window.location.pathname); // เริ่มต้นด้วย path ปัจจุบัน
        url.searchParams.set('month', selectedMonth);
        url.searchParams.set('year', selectedYear);

        // โหลดหน้าใหม่
        window.location.href = url.toString();
    }

    // เพิ่ม event listener ให้กับปุ่มค้นหา
    if (searchButton) {
        searchButton.addEventListener('click', updateTableByMonthYear);
    }

    // (Optional) หากต้องการให้โหลดข้อมูลทันทีที่เปลี่ยนเดือนหรือปี โดยไม่ต้องกดปุ่มค้นหา
    // if (selectMonth) {
    //     selectMonth.addEventListener('change', updateTableByMonthYear);
    // }
    // if (selectYear) {
    //     selectYear.addEventListener('change', updateTableByMonthYear);
    // }

    // ไม่ต้องมีส่วนตั้งค่า initial display text ที่นี่แล้ว
    // เพราะ PHP ได้ทำไปแล้วใน Admin_TableCollect.php เมื่อโหลดหน้าครั้งแรก
});