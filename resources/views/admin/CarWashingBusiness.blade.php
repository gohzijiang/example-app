<!-- resources/views/admin/CarWashingBusiness.blade.php -->
<!-- resources/views/admin/CarWashingBusiness.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Washing Business Setup</title>

    <!-- 引入 flatpickr 的样式和脚本 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

<h2>Car Washing Business Setup</h2>

<form method="post" action="{{ route('saveBusiness') }}">
    @csrf

    <label for="industrial_lines">Industrial Lines:</label>
    <input type="number" name="industrial_lines" id="industrial_lines" min="1" max="4" value="2" required>

    <label for="date">Select Date:</label>
    <input type="text" name="date" id="date" required>

    <label for="open_time">Open Time:</label>
    <input type="text" name="open_time" id="open_time" required>

    <label for="close_time">Close Time:</label>
    <input type="text" name="close_time" id="close_time" required>

    <button type="submit">Save</button>
</form>

<!-- 初始化 flatpickr -->
<script>
    flatpickr("#date", {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            // 在选择日期后调整其他字段
            adjustFieldsBasedOnDate(dateStr);
        }
    });

    flatpickr("#open_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "10:00"
    });

    flatpickr("#close_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "19:00"
    });

    // 调整其他字段的函数
    function adjustFieldsBasedOnDate(dateStr) {
        // 根据日期进行逻辑调整，这里只是一个示例
        if (dateStr === "2023-12-15") {
            // 在特定日期调整 industrial_lines、open_time、close_time 的值
            document.getElementById('industrial_lines').value = 3;
            document.getElementById('open_time').value = '11:00';
            document.getElementById('close_time').value = '20:00';
        } else {
            // 其他日期的调整
            document.getElementById('industrial_lines').value = 2;
            document.getElementById('open_time').value = '10:00';
            document.getElementById('close_time').value = '19:00';
        }
    }
</script>

</body>
</html>
