<html>
<head>
<title>{{$title}}</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            width: 100%;
    max-width: 900px;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
        }
        .header {
        background-color: #d32f2f;
        color: #fff;
        padding: 15px;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }
        .section {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            border: 1px solid;
            background: #DEE1E6;
            width: 90%;
            margin: auto;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(180deg, #DEE1E6 0%, #9095A0 100%);
            display: inline-block;
        }
        .customer-info, .registration-info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .customer-info .column, .registration-info .column {
            flex: 1;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .buttons .cancel {
            background: #f44336;
            color: #fff;
            margin-right: 10px;
        }
        .buttons .confirm {
            background: #0E3D99;
            color: #fff;
        }

        .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex; /* Ensure it's visible */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .modal {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 60%;
        max-width: 800px; /* Adjust width as needed */
    }

    

    </style>


{{$slot}}

</head>
<body>
<script> 
   
    //hàm xử lý kiểm tra xem ngày ra có lớn hơn ngày vào không.
        function validateDates() {
            const checkin = new Date(document.getElementById('checkin').value);
            const checkout = new Date(document.getElementById('checkout').value);
            if (checkin >= checkout) {
                alert("Ngày ra phải lớn hơn ngày vào!");
                return false;
            }
            return true;
        }

       

</script>



 
           