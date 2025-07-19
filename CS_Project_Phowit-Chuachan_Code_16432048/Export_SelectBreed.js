document.addEventListener('DOMContentLoaded', () => {
    const breedSelectElement = document.getElementById('breedSelectExport');
    const searchBreedButton = document.getElementById('searchBreedExport');
    const exportTableBody = document.getElementById('exportTableBody');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const deleteExportIdInput = document.getElementById('deleteExportId');

    // Global variable to store ID for deletion
    let currentExportIDToDelete = null;

    // --- Functions for Modals (to be called from table rows) ---

    // Function to set the ID when delete button is clicked
    // This function needs to be accessible globally or attached to window
    window.setDeleteID = function(ExportID) {
        currentExportIDToDelete = ExportID;
        deleteExportIdInput.value = ExportID; // ตั้งค่าใน input hidden ใน modal ด้วย
    };

    // Function to handle delete action (redirect to delete script)
    // This function needs to be accessible globally or attached to window
    // ** เปลี่ยนชื่อฟังก์ชันนี้ด้วย เพราะคุณเรียกใน confirmDeleteBtn เป็น deleteImportData() **
    window.deleteExportData = function() { // เปลี่ยนชื่อเป็น deleteExportData
        if (deleteExportIdInput.value) { // ใช้ค่าจาก input แทน currentExportIDToDelete
            window.location.href = "Delete_Export.php?id=" + deleteExportIdInput.value;
        } else {
            alert("ไม่พบรหัสข้อมูลที่จะลบ");
        }
    };

    // Function to prepare data for the edit modal
    // This function needs to be accessible globally or attached to window
    window.prepareEditModal = function(ExportID, ExportDateForInput, BreedID, ExportAmount, ExportDetails, ImportAmount) { // เพิ่ม Import_Amount
        // Populate the edit modal form fields
        document.getElementById('edit_Export_ID').value = ExportID;
        document.getElementById('edit_Export_Date').value = ExportDateForInput;
        document.getElementById('edit_Export_Amount').value = ExportAmount;
        document.getElementById('edit_Export_Details').value = ExportDetails;

        // Display Import_Amount for reference
        const importAmountDisplay = document.querySelector(`#editExportModal${ExportID} a`); // หา <a> ใน modal นั้น
        if (importAmountDisplay) {
            importAmountDisplay.textContent = `นำเข้าจำนวน ${ImportAmount} ตัว`;
        }
        // Set max attribute for ExportAmount input
        const editExportAmountInput = document.querySelector(`#editExportModal${ExportID} input[name="New_Export_Amount"]`);
        if (editExportAmountInput) {
            editExportAmountInput.max = ImportAmount;
        }

        // Set the selected option for the breed dropdown
        // อันนี้อาจจะไม่ต้องใช้ในโมดอลแก้ไขข้อมูลการนำออก เพราะ Breed_ID มาจาก Import ไม่ใช่ Export
        // แต่ถ้าต้องการใช้ก็ต้องให้ Breed_ID ที่ส่งมานั้นเป็น ID ของสายพันธุ์
        /*
        const editBreedSelect = document.getElementById('edit_Breed_ID'); // ตรวจสอบว่ามี element นี้จริง
        if (editBreedSelect) {
            for (let i = 0; i < editBreedSelect.options.length; i++) {
                if (editBreedSelect.options[i].value == BreedID) {
                    editBreedSelect.options[i].selected = true;
                    break;
                }
            }
        }
        */
    };

    // --- AJAX for Table Data ---

    // Function to render data into the table
    function renderExportTable(tableRows) { // <--- เปลี่ยนชื่อเป็น renderExportTable
        exportTableBody.innerHTML = ''; // Clear existing rows

        if (tableRows && tableRows.length > 0) {
            tableRows.forEach(row => {
                const tr = document.createElement('tr');
                tr.style.fontSize = '12px';
                // ใช้ template literals สำหรับ cleaner HTML string
                tr.innerHTML = `
                    <td>${row.Export_ID || ''}</td>
                    <td>${row.Export_Date_Formatted || ''}</td>
                    <td>${row.Breed_Name || ''}</td>
                    <td>${row.Export_Amount || ''}</td>
                    <td>${row.Export_Details || ''}</td>
                    <td>
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#editExportModal${row.Export_ID || ''}" style="height:30px; width:46%; padding: 1px;">
                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                        </button>

                        <div class="modal fade" id="editExportModal${row.Export_ID || ''}" tabindex="-1" aria-labelledby="editExportModalLabel${row.Export_ID}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editExportModalLabel${row.Export_ID}">แก้ไขข้อมูลการนำออก</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="Update_Export.php" method="post">
                                            <input type="hidden" class="form-control" name="Export_ID" value="${row.Export_ID}" readonly>

                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating">
                                                        <input type="datetime-local" class="form-control" name="Export_Date" value="${row.Export_Date_DateTimeLocal}" required>
                                                        <label for="Export_Date" class="form-label">วัน เวลา ที่นำออก</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" name="New_Export_Amount" min="1" max="${row.Import_Amount}" value="${row.Export_Amount}" required>
                                                        <label for="New_Export_Amount" class="form-label">จำนวนไก่ที่นำออก (ตัว)</label>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <div class="form-floating">
                                                <textarea class="form-control" name="Export_Details" style="height: 100px;" required>${row.Export_Details}</textarea>
                                                <label for="floatingTextarea">รายละเอียด</label>
                                            </div>

                                            <div class="col-12">
                                                <a>นำเข้าจำนวน ${row.Import_Amount} ตัว</a> </div>

                                            <div class="row">
                                                <div class="col-12" style="margin-top: 20px;">
                                                    <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" style="margin-top: 20px;">ยกเลิก</button>
                                                    <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn delete-btn" data-export-id="${row.Export_ID}" style="height:30px; width:46%; padding: 5px;" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                        </button>
                    </td>
                `;
                exportTableBody.appendChild(tr);
            });
            // Attach event listeners for delete buttons after rendering
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const exportIdToDelete = this.dataset.exportId;
                    setDeleteID(exportIdToDelete); // เรียกใช้ setDeleteID เพื่อตั้งค่าใน hidden input
                });
            });

        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan='7' class='text-center'>ไม่พบข้อมูลสำหรับสายพันธุ์นี้</td>`;
            exportTableBody.appendChild(tr); // แก้ไข ExportTableBody เป็น exportTableBody
        }
    }

    // Function to fetch data via AJAX
    function fetchTableData(breedId) {
        console.log("เรียกใช้ fetchTableData ด้วย breedId:", breedId); // เพิ่มบรรทัดนี้
        const formData = new FormData();
        formData.append('breedSelectExport', breedId);

        fetch('fetch_table_Export.php', { // Make sure this path is correct
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log("ได้รับ Response จาก PHP:", response); // เพิ่มบรรทัดนี้
            if (!response.ok) {
                // If response is not OK, try to read as text to see the PHP error
                return response.text().then(text => {
                    throw new Error(`HTTP error! Status: ${response.status}. Server response: ${text}`);
                });
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            console.log("ข้อมูล JSON ที่ได้รับ:", data); // เพิ่มบรรทัดนี้
            if (data.error) {
                console.error("PHP Error:", data.error);
                alert("เกิดข้อผิดพลาดจากเซิร์ฟเวอร์: " + data.error);
                renderExportTable([]); // Clear table on error <--- เปลี่ยนชื่อเป็น renderExportTable
                return;
            }
            renderExportTable(data.tableData); // Render table with fetched data <--- เปลี่ยนชื่อเป็น renderExportTable
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูลตาราง:', error);
            alert('ไม่สามารถโหลดข้อมูลตารางได้: ' + error.message);
            renderExportTable([]); // Clear table on error <--- เปลี่ยนชื่อเป็น renderExportTable
        });
    }

    // Event listener for the "ค้นหา" button
    searchBreedButton.addEventListener('click', () => {
        const selectedBreedId = breedSelectElement.value; // Correctly get the value from the dropdown
        fetchTableData(selectedBreedId);
    });

    // Event listener for the "ยืนยัน" button in delete modal
    confirmDeleteBtn.addEventListener('click', () => {
        deleteExportData(); // <--- เปลี่ยนชื่อเป็น deleteExportData
    });

    // Initial load of table data when the page loads
    // Use the initially selected value from the PHP-generated select box
    const initialSelectedBreed = breedSelectElement.value;
    if (initialSelectedBreed) {
        fetchTableData(initialSelectedBreed);
    }

    // --- Other scripts from chart_breed.js that are not table related ---
    // (If chart_breed.js contains logic for charts only, you can keep it separate.
    // If it contains modal logic, it's better to move it here or ensure no conflicts.)

    // โค้ดสำหรับเมนู Active (ยังคงเดิม)
    // ตรวจสอบให้แน่ใจว่า AdminExport.php อยู่ในโฟลเดอร์เดียวกันกับหน้าอื่นๆ ที่เรียกใช้
    // หรือปรับ path ให้ถูกต้อง
    var currentPage = '<?php echo basename($_SERVER["PHP_SELF"]); ?>';
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });

});