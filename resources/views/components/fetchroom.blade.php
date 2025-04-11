<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$title}}</title>
  <style>
    /* General Styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Full height of viewport */
    }

    .container {
      width: 400px;
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .header {
      background-color: #d32f2f;
      color: #fff;
      padding: 15px;
      text-align: center;
      font-weight: bold;
      font-size: 18px;
    }

    .content {
      padding: 20px;
      background-color: #f4f4f4;
    }

    .form-group {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: bold;
      color: #333;
      margin-right: 10px;
    }

    .form-group select {
      width: 60%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .cancel-button, .confirm-button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      width: 48%;
    }

    .cancel-button {
      background-color: #d32f2f;
      color: #fff;
    }

    .cancel-button:hover {
      background-color: #a00000;
    }

    .confirm-button {
      background-color: #007bff;
      color: #fff;
    }

    .confirm-button:hover {
      background-color: #0056b3;
    }

    a{
        text-decoration: none;
    }
  </style>
   <!-- Hiển thị thông báo nếu có -->
   @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
   {{$slot}}
</body>
<script>
function fetchRooms() {
    const roomTypeSelect = document.querySelector('select[name="room-type"]');
    const selectedType = roomTypeSelect.value;

    const roomNumberSelect = document.querySelector('select[name="room-number"]');
    roomNumberSelect.innerHTML = '<option value="">Chọn phòng</option>'; // reset dropdown

    if (selectedType) {
        fetch(`/ajax/fetch-rooms?room_type=${selectedType}`)
            .then(response => response.json())
            .then(rooms => {
                if (rooms.error) {
                    alert(rooms.error); // Nếu có lỗi từ server
                    return;
                }

                // Thêm các phòng vào dropdown
                rooms.forEach(room => {
                    const option = document.createElement('option');
                    option.value = room;
                    option.textContent = room;
                    roomNumberSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Lỗi khi tải danh sách phòng:', error);
            });
    }
}

function transferRoom() {
    // Giả sử bạn gửi yêu cầu chuyển phòng thành công
    alert("Chuyển phòng thành công!");
}
</script>
</html>


