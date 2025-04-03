<html>
<head>
<title>{{$title}}</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex-direction: column;
        }
        .header {
            background-color: #d32f2f;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: 10px;
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

        
    </style>

{{$slot}}
</head>
<body>
 
           