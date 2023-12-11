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
<!-- 修改表单 -->
<form method="post" action="{{ route('saveBusiness') }}">
    @csrf

    <label for="industrial_lines">Industrial Lines:</label>
    <input type="number" name="industrial_lines" id="industrial_lines" min="1" max="4" value="2" required>

    <!-- 多个日期选择 -->
    <label for="dates">Select Dates:</label>
    <input type="text" name="dates[]" id="dates" required>
    <input type="hidden" name="selected_dates" id="selected_dates">

    <label for="open_time">Open Time:</label>
    <input type="text" name="open_time" id="open_time" required>

    <label for="close_time">Close Time:</label>
    <input type="text" name="close_time" id="close_time" required>

    <button type="submit">Save</button>
</form>

<!-- 初始化 flatpickr -->
<script>

function adjustFieldsBasedOnDates(selectedDates) {
        // 在这里添加你的逻辑，根据多选日期进行相应的调整
        console.log('Selected dates:', selectedDates);

        // 示例：根据选择的日期设置其他字段的值
        // 注意：selectedDates 是一个包含多个日期的数组
        // 这里只是个例子，你需要根据实际需求来调整逻辑

        if (selectedDates.includes("2023-12-15")) {
            // 如果选择了特定日期，设置其他字段的值
            document.getElementById('industrial_lines').value = 3;
            document.getElementById('open_time').value = '11:00';
            document.getElementById('close_time').value = '20:00';
        } else {
            // 其他日期的调整，可以根据需要自行处理
            document.getElementById('industrial_lines').value = 2;
            document.getElementById('open_time').value = '10:00';
            document.getElementById('close_time').value = '19:00';
        }
    }

    function adjustFieldsBasedOnTime(dateStr, type) {
    // 获取时间的小时和分钟
    const [hours, minutes] = dateStr.split(':').map(Number);

    // 示例逻辑：如果时间在特定范围内，设置其他字段的值
    if (type === 'open' && hours >= 10 && hours < 12) {
        document.getElementById('industrial_lines').value = 3;
    } else if (type === 'close' && hours >= 19 && hours < 21) {
        document.getElementById('industrial_lines').value = 3;
    } else {
        // 其他时间范围的处理，可以根据需要自行调整
        document.getElementById('industrial_lines').value = 2;
    }

    // 这里可以添加更多的逻辑，根据时间调整其他字段的值
    // ...

    console.log(`Adjusted fields based on ${type} time: ${dateStr}`);
}

   

flatpickr("#dates", {
    enableTime: false,
    mode: "multiple",
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function(selectedDates, dateStr, instance) {
        // 确保 selectedDates 始终是数组
        selectedDates = Array.isArray(selectedDates) ? selectedDates : [selectedDates];
        // 更新隐藏的 input，将选定的日期以逗号分隔的字符串形式存储
        document.getElementById('selected_dates').value = selectedDates.join(',');
        // 在选择日期后调整其他字段
        adjustFieldsBasedOnDates(selectedDates);
    }
});


    flatpickr("#open_time", {
    
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "10:00", // 对于 open_time 的默认时间
        onClose: function(selectedDates, dateStr, instance) {
            // 在选择时间后调整其他字段
            adjustFieldsBasedOnTime(dateStr, 'open');
        }
    });

    flatpickr("#close_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "19:00", // 对于 close_time 的默认时间
        onClose: function(selectedDates, dateStr, instance) {
            // 在选择时间后调整其他字段
            adjustFieldsBasedOnTime(dateStr, 'close');
        }
    });

   
</script>
