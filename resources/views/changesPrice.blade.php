<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion Form</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .styled-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .styled-input,
        .styled-select {
            width: 96%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 5px;
        }

        .styled-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            align-self: flex-end;
        }

        .styled-button:hover {
            background-color: #0056b3;
        }
    </style>


</head>

<body>
    <div class="form-container ">
        <form action="" method="" class="styled-form">
            @csrf
            <input type="text" style="display:none" class="styled-input" name="barcode" placeholder="barcode" value="">
            <input type="text" style="display:none" class="styled-input" name="name">
            <input type="text" style="display:none" id="b_value" name="b_value" value="">
            <div class="form-group">
                <label for="value">Giá trị thay đổi:</label>
                <input type="text" class="styled-input" id="value" name="value" value="" require>
            </div>
            <div class="form-group">
                <label for="value">Link thay đổi:</label>
                <input type="text" class="styled-input" id="value" name="value" value="" require>
            </div>
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" class="styled-input" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" class="styled-input" id="end_date" name="end_date" min="" required>
            </div>
            <div class="form-group">
                <label for="platform">Chọn kênh:</label>
                <select id="platform" name="platform" class="styled-select" style="width: 100% !important">
                    <option value="both" selected>Cả Hai</option>
                    <option value="web">Web</option>
                    <option value="pos">POS</option>
                </select>
            </div>
            <div class="" style="display: flex; justify-content:right; gap: 10px;">
                <button type="submit" class="styled-button" style="margin-top:15px">Submit</button>
                <button onclick="window.history.back();" class="styled-button">
                    Back
                </button>
            </div>
        </form>
    </div>
</body>

</html>