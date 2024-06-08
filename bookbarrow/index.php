<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="dilru.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Library Management System</h1>

    <div id="formPage" class="form-container">
        <h2>Add Borrow Details</h2>
        <form id="borrowForm" action="add_borrow.php" method="post">
            <label for="borrowId">Borrow ID:</label>
            <input type="text" id="borrowId" name="borrowId" required>
            <label for="bookId">Book ID:</label>
            <input type="text" id="bookId" name="bookId" required>
            <label for="memberId">Member ID:</label>
            <input type="text" id="memberId" name="memberId" required>
            <label for="borrowStatus">Borrow Status:</label>
            <select id="borrowStatus" name="borrowStatus" required>
                <option value="borrowed">Borrowed</option>
                <option value="available">Available</option>
            </select>
            <button type="submit">Add Borrow Detail</button>
        </form>
    </div>

    <div id="detailsPage" class="form-container" style="display: none;">
        <h2>Borrow Details</h2>
        <table id="borrowTable">
            <thead>
                <tr>
                    <th>Borrow ID</th>
                    <th>Book ID</th>
                    <th>Member ID</th>
                    <th>Borrow Status</th>
                    <th>Borrower Date Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="borrowTableBody">
            </tbody>
        </table>
        <button type="button" onclick="showFormPage()">Add More</button>
    </div>

    <script>
        function showFormPage() {
            document.getElementById('formPage').style.display = 'block';
            document.getElementById('detailsPage').style.display = 'none';
            document.getElementById('borrowForm').reset();
        }

        function fetchBorrowDetails() {
            fetch('fetch_borrow.php')
                .then(response => response.json())
                .then(data => {
                    const borrowTableBody = document.getElementById('borrowTableBody');
                    borrowTableBody.innerHTML = '';
                    data.forEach(detail => {
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${detail.borrow_id}</td>
                            <td>${detail.book_id}</td>
                            <td>${detail.member_id}</td>
                            <td>${detail.borrow_status}</td>
                            <td>${detail.borrower_date_modified}</td>
                            <td>
                                <button type="button" onclick="editRow('${detail.borrow_id}', '${detail.book_id}', '${detail.member_id}', '${detail.borrow_status}')" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" onclick="deleteRow('${detail.borrow_id}')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        `;
                        borrowTableBody.appendChild(newRow);
                    });
                    document.getElementById('detailsPage').style.display = 'block';
                    document.getElementById('formPage').style.display = 'none';
                });
        }

        function editRow(borrowId, bookId, memberId, borrowStatus) {
            showFormPage();
            document.getElementById('borrowId').value = borrowId;
            document.getElementById('bookId').value = bookId;
            document.getElementById('memberId').value = memberId;
            document.getElementById('borrowStatus').value = borrowStatus;
        }

        function deleteRow(borrowId) {
            console.log(`Attempting to delete row with Borrow ID: ${borrowId}`);
            fetch(`delete_borrow.php?id=${borrowId}`, { method: 'GET' })
                .then(response => response.json())
                .then(data => {
                    console.log('Data received from server:', data);
                    if (data.success) {
                        console.log(`Successfully deleted row with Borrow ID: ${borrowId}`);
                        fetchBorrowDetails();
                    } else {
                        console.error('Failed to delete', data.error);
                        alert('Failed to delete: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', fetchBorrowDetails);
    </script>
</body>
</html>
