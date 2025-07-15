document.addEventListener('DOMContentLoaded', () => {
    const breedSelectElement = document.getElementById('breedSelect');
    const searchButton = document.getElementById('searchBreed');
    const importTableBody = document.getElementById('importTableBody');
    const confirmDeleteButton = document.getElementById('confirmDeleteBtn');
    const editForm = document.getElementById('editForm'); // Form in edit modal

    // Global variable to store ID for deletion
    let currentImportIDToDelete = null;

    // --- Functions for Modals (to be called from table rows) ---

    // Function to set the ID when delete button is clicked
    // This function needs to be accessible globally or attached to window
    window.setDeleteID = function(importID) {
        currentImportIDToDelete = importID;
    };

    // Function to handle delete action (redirect to delete script)
    // This function needs to be accessible globally or attached to window
    window.deleteImportData = function() {
        if (currentImportIDToDelete) {
            window.location.href = "Delete_Import.php?id=" + currentImportIDToDelete;
        } else {
            alert("ไม่พบรหัสข้อมูลที่จะลบ");
        }
    };

    // Function to prepare data for the edit modal
    // This function needs to be accessible globally or attached to window
    window.prepareEditModal = function(importID, importDateForInput, breedID, importAmount, importDetails) {
        // Populate the edit modal form fields
        document.getElementById('edit_Import_ID').value = importID;
        document.getElementById('edit_Import_Date').value = importDateForInput;
        document.getElementById('edit_Import_Amount').value = importAmount;
        document.getElementById('edit_Import_Details').value = importDetails;

        // Set the selected option for the breed dropdown
        const editBreedSelect = document.getElementById('edit_Breed_ID');
        if (editBreedSelect) {
            // Loop through options and set 'selected' for the matching value
            for (let i = 0; i < editBreedSelect.options.length; i++) {
                if (editBreedSelect.options[i].value == breedID) {
                    editBreedSelect.options[i].selected = true;
                    break;
                }
            }
        }
    };

    // --- AJAX for Table Data ---

    // Function to render table rows from data
    function renderTableRows(tableRows) {
        importTableBody.innerHTML = ''; // Clear existing rows

        if (tableRows && tableRows.length > 0) {
            tableRows.forEach(rowData => {
                const tr = document.createElement('tr');
                tr.style.fontSize = '12px';
                // Use template literals for cleaner HTML string
                tr.innerHTML = `
                    <td>${rowData.Import_ID || ''}</td>
                    <td>${rowData.Import_Date || ''}</td>
                    <td>${rowData.Breed_Name || ''}</td>
                    <td>${rowData.Import_Amount ? rowData.Import_Amount + ' ตัว' : ''}</td>
                    <td>${rowData.Import_Details || ''}</td>
                    <td>
                        <button type="button" class="btn" data-bs-toggle="modal" style="height:30px; width:46%; padding: 1px;"
                            data-bs-target="#editImportModal" 
                            onclick="prepareEditModal(
                                '${rowData.Import_ID || ''}', 
                                '${rowData.Import_Date_For_Input || ''}', 
                                '${rowData.Breed_ID || ''}', 
                                '${rowData.Import_Amount || ''}', 
                                \`${rowData.Import_Details || ''}\` // Use backticks for details to handle special characters
                            )">
                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                        </button>
                        <button class="btn" data-bs-toggle="modal" onclick="setDeleteID('${rowData.Import_ID || ''}')"
                            data-bs-target="#confirmDeleteModal" style="height:30px; width:46%; padding: 5px;">
                            <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                        </button>
                    </td>
                `;
                importTableBody.appendChild(tr);
            });
        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan='7' class='text-center'>ไม่พบข้อมูลสำหรับสายพันธุ์นี้</td>`;
            importTableBody.appendChild(tr);
        }
    }

    // Function to fetch data via AJAX
    function fetchTableData(breedId) {
        const formData = new FormData();
        formData.append('breedSelect', breedId);

        fetch('fetch_table_data.php', { // Make sure this path is correct
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            console.log("ข้อมูลตารางที่ได้รับ:", data);
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
    searchButton.addEventListener('click', () => {
        const selectedBreedId = breedSelectElement.value; // Correctly get the value from the dropdown
        fetchTableData(selectedBreedId);
    });

    // Event listener for the "ยืนยัน" button in delete modal
    confirmDeleteButton.addEventListener('click', () => {
        deleteImportData();
    });

    // Optional: Handle form submission for edit modal using AJAX (if you want to avoid page reload)
    // For now, it will submit normally as per your existing Update_Import.php setup
    // editForm.addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent default form submission
    //     const formData = new FormData(this);
    //     fetch('Update_Import.php', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => response.json()) // Assuming Update_Import.php returns JSON
    //     .then(data => {
    //         if (data.success) {
    //             alert('ข้อมูลอัปเดตสำเร็จ!');
    //             const selectedBreedId = breedSelectElement.value;
    //             fetchTableData(selectedBreedId); // Reload table after successful update
    //             $('#editImportModal').modal('hide'); // Hide modal (requires jQuery)
    //             // Or use Bootstrap 5 native JS:
    //             // var editModal = bootstrap.Modal.getInstance(document.getElementById('editImportModal'));
    //             // editModal.hide();
    //         } else {
    //             alert('เกิดข้อผิดพลาดในการอัปเดต: ' + data.message);
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error updating data:', error);
    //         alert('ไม่สามารถอัปเดตข้อมูลได้: ' + error.message);
    //     });
    // });


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
    var currentPage = '<?php echo basename($_SERVER["PHP_SELF"]); ?>';
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });

    // โค้ดสำหรับ Modal "เพิ่มข้อมูล" (ถ้า Admin_FormImport.php มี Modal นี้)
    // ถ้า Admin_FormImport.php สร้าง modal ด้วย ID "addRecordModal" 
    // และมีการเรียกใช้ `var modal = document.getElementById("Modal");` ใน chart_breed.js 
    // อาจจะต้องปรับปรุงให้ใช้ Bootstrap 5 JS หรือรวมเข้ามาในนี้ให้เป็นระเบียบ
    // หาก modal "เพิ่มข้อมูล" ใช้ Bootstrap 5 data-bs-toggle="modal" data-bs-target="#addRecordModal" อยู่แล้ว
    // โค้ดด้านล่างนี้อาจจะไม่จำเป็น
    /*
    var addRecordModal = document.getElementById("addRecordModal");
    if (addRecordModal) {
        // No specific JS needed if using data-bs-toggle and data-bs-target
        // Bootstrap handles it automatically
    }
    */
});