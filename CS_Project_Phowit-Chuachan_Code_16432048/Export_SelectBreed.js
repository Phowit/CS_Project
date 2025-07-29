document.addEventListener('DOMContentLoaded', () => {
    // อ้างอิงถึง Element ต่างๆ
    const breedSelectElement = document.getElementById('breedSelectExport');
    const searchBreedButton = document.getElementById('searchBreedExport');
    const exportTableBody = document.getElementById('exportTableBody');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const displaySelectedBreed = document.getElementById('displaySelectedBreed'); // Element สำหรับแสดงชื่อสายพันธุ์

    // Global variable to store ID for deletion
    let currentExportIDToDelete = null;

    // --- Functions for Modals (to be called from table rows) ---

    // Function to set the ID when delete button is clicked
    window.setDeleteID = function(exportID) {
        currentExportIDToDelete = exportID;
    };

    // Function to handle delete action (redirect to delete script)
    window.deleteExportData = function() {
        if (currentExportIDToDelete) {
            window.location.href = "Delete_Export.php?id=" + currentExportIDToDelete;
        } else {
            alert("ไม่พบรหัสข้อมูลที่จะลบ");
        }
    };



    // Function to prepare data for the edit modal
    window.prepareEditModal = function(ExportID, ExportDateForInput, ExportAmount, ExportDetails) {
        editExportIdInput.value = ExportID;
        editExportDateInput.value = ExportDateForInput;
        editExportAmountInput.value = ExportAmount;
        editExportDetailsInput.value = ExportDetails;

        // Set max attribute for ExportAmount input
        if (editExportAmountInput) {
            editExportAmountInput.max = ExportAmount;
        }

        // Open the modal
        editExportModal.show(); 
    };



    // Get the edit modal elements
    const editExportModal = new bootstrap.Modal(document.getElementById('editExportModal')); // Initialize Bootstrap Modal object
    const editExportIdInput = document.getElementById('edit_Export_ID');
    const editExportDateInput = document.getElementById('edit_Export_Date');
    const editExportAmountInput = document.getElementById('edit_Export_Amount');
    const editExportDetailsInput = document.getElementById('edit_Export_Details');
    // --- Functions for Modals ---

    // --- AJAX for Table Data ---

    // Function to render data into the table
    function renderExportTable(tableRows) {
        exportTableBody.innerHTML = ''; // Clear existing rows

        if (tableRows && tableRows.length > 0) {
            tableRows.forEach((row, index) => { // Added index for serial number
                const tr = document.createElement('tr');
                tr.style.fontSize = '12px';
                // Use template literals for cleaner HTML string
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${row.Export_Date_Formatted || ''}</td>
                    <td>${row.Breed_Name || ''}</td>
                    <td>${row.Export_Amount || ''}</td>
                    <td>${row.Export_Details || ''}</td>
                    <td>
                        <button type="button" class="btn btn-sm edit-btn" 
                            data-export-id="${row.Export_ID}"
                            data-export-date="${row.Export_Date_DateTimeLocal}"
                            data-breed-id="${row.Breed_ID}"
                            data-export-amount="${row.Export_Amount}"
                            data-export-details="${row.Export_Details}"
                            data-bs-toggle="modal" data-bs-target="#editExportModal" 
                            style="height:30px; width:46%; padding: 1px;">
                            <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                        </button>
                        <button class="btn btn-sm delete-btn" 
                            data-export-id="${row.Export_ID}" 
                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                            style="height:30px; width:46%; padding: 5px;">
                            <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                        </button>
                    </td>
                `;
                exportTableBody.appendChild(tr);
            });

            // Attach event listeners for edit and delete buttons after rendering
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const exportId = this.dataset.exportId;
                    const exportDate = this.dataset.exportDate;
                    const breedId = this.dataset.breedId;
                    const exportAmount = this.dataset.exportAmount;
                    const exportDetails = this.dataset.exportDetails;

                    window.prepareEditModal(exportId, exportDate, breedId, exportAmount, exportDetails);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const exportIdToDelete = this.dataset.exportId;
                    window.setDeleteID(exportIdToDelete);
                });
            });

        } else {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td colspan='6' class='text-center'>ไม่พบข้อมูลสำหรับสายพันธุ์นี้</td>`; // Updated colspan
            exportTableBody.appendChild(tr);
        }
    }

    // Function to fetch data via AJAX
    function fetchTableData(breedId) {
        console.log("Fetching Export Table Data for breedId:", breedId);
        const formData = new FormData();
        formData.append('breedSelectExport', breedId); // Use the correct key for PHP

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
    searchBreedButton.addEventListener('click', () => {
        const selectedBreedId = breedSelectElement.value;
        fetchTableData(selectedBreedId);
    });

    // Event listener for the "ยืนยัน" button in delete modal
    confirmDeleteBtn.addEventListener('click', () => {
        window.deleteExportData();
    });

    // Initial load of table data when the page loads
    // Use the embedded initialExportTableData
    if (typeof initialExportTableData !== 'undefined' && initialExportTableData.length > 0) {
        renderExportTable(initialExportTableData);
    } else {
        // If no initial data (e.g., first load with no default breed), fetch from PHP for 'all'
        fetchTableData('all'); 
    }

});