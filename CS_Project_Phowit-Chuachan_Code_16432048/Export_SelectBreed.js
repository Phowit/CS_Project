document.addEventListener('DOMContentLoaded', () => {
    // อ้างอิงถึง Element ต่างๆ
    const breedSelectElement = document.getElementById('breedSelectExport');
    const searchBreedButton = document.getElementById('searchBreedExport');
    const exportTableBody = document.getElementById('exportTableBody');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const displaySelectedBreed = document.getElementById('displaySelectedBreed'); // Element สำหรับแสดงชื่อสายพันธุ์

    // --- Functions for Modals (to be called from table rows) ---

    // Function to prepare data for the edit modal
    window.prepareEditModal = function(exportID, exportDateForInput, breedID, exportAmount, exportDetails) {
        // อ้างอิง Element ที่ถูกต้องสำหรับ modal แก้ไขข้อมูลส่งออก
        const editExportIdInput = document.getElementById('edit_Export_ID');
        const editExportDateInput = document.getElementById('edit_Export_Date');
        const editExportAmountInput = document.getElementById('edit_Export_Amount');
        const editExportDetailsInput = document.getElementById('edit_Export_Details');
        const editBreedSelect = document.getElementById('edit_Breed_ID');

        // กำหนดค่าให้กับ input fields
        if (editExportIdInput) editExportIdInput.value = exportID;
        if (editExportDateInput) editExportDateInput.value = exportDateForInput;
        if (editExportAmountInput) editExportAmountInput.value = exportAmount;
        if (editExportDetailsInput) editExportDetailsInput.value = exportDetails;

        // กำหนดค่าที่ถูกเลือกใน dropdown ของสายพันธุ์
        if (editBreedSelect) {
            for (let i = 0; i < editBreedSelect.options.length; i++) {
                if (editBreedSelect.options[i].value == breedID) {
                    editBreedSelect.options[i].selected = true;
                    break;
                }
            }
        }
    };

    // Function to set the ID when delete button is clicked
    window.setDeleteID = function(exportID) {
        document.getElementById('delete_Export_ID').value = exportID;
    };


    // --- Core Table Data Rendering and Fetching ---

    // Function to render data into the table
    function renderExportTable(tableRows) {
        exportTableBody.innerHTML = ''; // ล้างข้อมูลแถวที่มีอยู่

        if (tableRows && tableRows.length > 0) {
            tableRows.forEach((rowData, index) => { // เพิ่ม index สำหรับนับลำดับ
                const tr = document.createElement('tr');
                tr.style.fontSize = '12px';
                
                // Escape details เพื่อป้องกันปัญหาเรื่องเครื่องหมายคำพูดใน HTML attribute
                const escapedDetails = rowData.Export_Details ? rowData.Export_Details.replace(/'/g, "\\'").replace(/"/g, '\\"') : '';

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${rowData.Export_Date_Formatted || ''}</td>
                    <td>${rowData.Breed_Name || ''}</td>
                    <td>${rowData.Export_Amount || ''}</td>
                    <td>${rowData.Export_Details || ''}</td>
                    <td>
                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                            data-bs-target="#editExportModal"
                            onclick="prepareEditModal(
                                '${rowData.Export_ID || ''}',
                                '${rowData.Export_Date_For_Input || ''}',
                                '${rowData.Breed_ID || ''}',
                                '${rowData.Export_Amount || ''}',
                                '${escapedDetails}'
                            )">
                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                        </button>
                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                            data-bs-target="#deleteExportModal"
                            onclick="setDeleteID(
                                '${rowData.Export_ID || ''}'
                            )">
                            <i class='far fa-trash-alt' style='color:red; font-size:16px;'></i>
                        </button>
                    </td>
                `;
                exportTableBody.appendChild(tr);
            });

        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan='6' class='text-center'>ไม่พบข้อมูลสำหรับสายพันธุ์นี้</td>`; // อัปเดต colspan เป็น 6
            exportTableBody.appendChild(tr);
        }
    }

    // Function to fetch data via AJAX
    function fetchTableData(breedId) {
        // อัปเดตข้อความแสดงผลในหัวตารางทันที
        const selectedBreedText = breedSelectElement.options[breedSelectElement.selectedIndex].textContent;
        if (displaySelectedBreed) {
            displaySelectedBreed.textContent = selectedBreedText;
        }

        const formData = new FormData();
        formData.append('breed_id', breedId); // เปลี่ยนชื่อ parameter ให้สอดคล้องกับ PHP ที่จะรับ

        fetch('fetch_table_Export.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP error! Status: ${response.status}. Server response: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error("PHP Error:", data.error);
                alert("เกิดข้อผิดพลาดจากเซิร์ฟเวอร์: " + data.error);
                renderExportTable([]);
                return;
            }
            renderExportTable(data.tableData);
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูลตาราง Export:', error);
            alert('ไม่สามารถโหลดข้อมูลตาราง Export ได้: ' + error.message);
            renderExportTable([]);
        });
    }

    // Event listener for the "ค้นหา" button
    if (searchBreedButton) {
        searchBreedButton.addEventListener('click', () => {
            const selectedBreedId = breedSelectElement.value;
            fetchTableData(selectedBreedId);
        });
    }
    
    // Initial load of table data when the page loads
    if (typeof initialExportTableData !== 'undefined' && initialExportTableData.length > 0) {
        renderExportTable(initialExportTableData);
    } else {
        fetchTableData('all'); 
    }
});