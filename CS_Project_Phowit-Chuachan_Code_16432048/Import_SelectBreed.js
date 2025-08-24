document.addEventListener('DOMContentLoaded', () => {
    // อ้างอิงถึง Element ต่างๆ
    const breedSelectElement = document.getElementById('breedSelectImport'); // ต้องตรงกับ ID ใน PHP
    const searchButton = document.getElementById('searchBreedImport'); // ต้องตรงกับ ID ใน PHP
    const importTableBody = document.getElementById('importTableBody');
    const confirmDeleteButton = document.getElementById('confirmDeleteBtn');
    const displaySelectedBreed = document.getElementById('displaySelectedBreed'); // Element สำหรับแสดงชื่อสายพันธุ์

    // --- Functions for Modals (to be called from table rows) --- 
    window.setDeleteID = function(importID , importAmount) {
        document.getElementById('delete_Import_ID').value = importID;
        document.getElementById('delete_Import_Amount').value = importAmount;
    };

    // Function to prepare data for the edit modal
    // Adjusted to match the data structure sent from PHP
    window.prepareEditModal = function(importID, importDateForInput, breedID, importAmount, importDetails) {
        document.getElementById('edit_Import_ID').value = importID;
        document.getElementById('edit_Import_Date').value = importDateForInput;
        document.getElementById('edit_Import_Amount').value = importAmount;
        document.getElementById('edit_Import_Details').value = importDetails;

        const editBreedSelect = document.getElementById('edit_Breed_ID');
        if (editBreedSelect) {
            for (let i = 0; i < editBreedSelect.options.length; i++) {
                if (editBreedSelect.options[i].value == breedID) {
                    editBreedSelect.options[i].selected = true;
                    break;
                }
            }
        }
    };

    // --- Core Table Data Rendering and Fetching ---

    // Function to render table rows from data
    function renderTableRows(tableRows) {
        importTableBody.innerHTML = ''; // Clear existing rows

        if (tableRows && tableRows.length > 0) {
            let counter = 1; // เริ่มนับลำดับที่ 1 ใหม่ทุกครั้งที่ render
            tableRows.forEach(rowData => {
                const tr = document.createElement('tr');
                tr.style.fontSize = '13px'; // ปรับขนาดฟอนต์ให้สอดคล้องกับ tbody ใน PHP

                // Escape details to prevent issues with quotes in HTML attributes
                const escapedDetails = rowData.Import_Details ? rowData.Import_Details.replace(/'/g, "\\'").replace(/"/g, '\\"') : '';

                tr.innerHTML = `
                    <td>${rowData.Import_ID}</td>
                    <td>${rowData.Import_Date || ''}</td>
                    <td>${rowData.Breed_Name || ''}</td>
                    <td>${rowData.Import_Amount ? rowData.Import_Amount : ''}</td>
                    <td>${rowData.Import_Details || ''}</td>
                    <td>
                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                            data-bs-target="#editImportModal"
                            onclick="prepareEditModal(
                                '${rowData.Import_ID || ''}',
                                '${rowData.Import_Date_For_Input || ''}',
                                '${rowData.Breed_ID || ''}',
                                '${rowData.Import_Amount || ''}',
                                '${escapedDetails}' // Use escapedDetails here
                            )">
                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                        </button>

                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                            data-bs-target="#deleteImportModal"
                            onclick="setDeleteID(
                                '${rowData.Import_ID || ''}',
                                '${rowData.Import_Amount || ''}'
                            )">
                            <i class='far fa-trash-alt' style='color:red; font-size:16px;'></i>
                        </button>
                    </td>
                `;
                importTableBody.appendChild(tr);
            });
        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan='6' class='text-center'>ไม่พบข้อมูลสำหรับสายพันธุ์นี้</td>`; // แก้ colspan เป็น 6
            importTableBody.appendChild(tr);
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

        fetch('Fetch_Table_Import.php', { // Make sure this path is correct
            method: 'POST', // หรือ GET ก็ได้ ถ้าจะส่งผ่าน URL parameters
            body: formData  // ใช้ body สำหรับ POST
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            if (data.error) {
                console.error("PHP Error:", data.error);
                alert("เกิดข้อผิดพลาดจากเซิร์ฟเวอร์: " + data.error);
                renderTableRows([]); // Clear table on error
                return;
            }
            renderTableRows(data.tableData); // Render table with fetched data
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูลตาราง:', error);
            alert('ไม่สามารถโหลดข้อมูลตารางได้: ' + error.message);
            renderTableRows([]); // Clear table on error
        });
    }

    // Event listener for the "ค้นหา" button
    if (searchButton) { // ตรวจสอบให้แน่ใจว่าปุ่มมีอยู่
        searchButton.addEventListener('click', () => {
            const selectedBreedId = breedSelectElement.value;
            fetchTableData(selectedBreedId);
        });
    }

    // Initial load of table data when the page loads
    // ใช้ข้อมูลที่ PHP ส่งมาใน global variable 'initialImportTableData'
    if (typeof initialImportTableData !== 'undefined' && initialImportTableData.length > 0) {
        renderTableRows(initialImportTableData);
    } else {
        // กรณีไม่มีข้อมูล หรือ PHP ไม่ได้ส่งข้อมูลมา
        renderTableRows([]);
    }
});