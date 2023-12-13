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
    <input type="text" name="dates" id="dates" required>
    <input type="hidden" name="selected_dates" id="selected_dates">

    <label for="open_time">Open Time:</label>
    <input type="text" name="open_time" id="open_time" required>

    <label for="close_time">Close Time:</label>
    <input type="text" name="close_time" id="close_time" required>

    <button type="submit">Save</button>
</form>

<!-- 初始化 flatpickr -->
<script>
    function adjustFieldsBasedOnDates(selectedDates, instance) {
        // 在这里添加你的逻辑，根据日期范围进行相应的调整
        console.log('Selected dates before form submission:', selectedDates);
        
        // 示例：根据选择的日期范围设置其他字段的值
        // 注意：selectedDates 是一个包含开始和结束日期的数组
        if (selectedDates.length > 0) {
            const startDate = instance.formatDate(selectedDates[0], "Y-m-d");
            const endDate = instance.formatDate(selectedDates[selectedDates.length - 1], "Y-m-d");

            // 示例逻辑：根据选择的日期范围设置其他字段的值
            console.log(`Selected date range: ${startDate} to ${endDate}`);
            // 在这里添加逻辑，根据日期范围设置其他字段的值
        }
        document.getElementById('selected_dates').value = selectedDates.map(date => instance.formatDate(date, "Y-m-d")).join(',');
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

    // 在 flatpickr 的配置中，修改 onChange 回调函数
    flatpickr("#dates", {
    enableTime: false,
    mode: "multiple", // 修改为 multiple 模式
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        // 直接将选中的日期设置为隐藏字段的值
        document.getElementById('selected_dates').value = dateStr;

        // 在选择日期后调整其他字段
        adjustFieldsBasedOnDates(selectedDates, instance);
    }
});

    // 在表单提交之前检查并处理数据
    document.querySelector('form').addEventListener('submit', function (event) {
    // 获取选择的日期范围
    const selectedDates = document.getElementById('dates').value;

    // 防止表单实际提交，以便你可以检查和调整数据
    event.preventDefault();

    // 继续提交表单
    this.submit();
});


    flatpickr("#open_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "10:00", // 对于 open_time 的默认时间
        onClose: function (selectedDates, dateStr, instance) {
            // 在选择时间后调整其他字段
            adjustFieldsBasedOnTime(dateStr, 'open');
        }
    });

    flatpickr("#close_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: "19:00", // 对于 close_time 的默认时间
        onClose: function (selectedDates, dateStr, instance) {
            // 在选择时间后调整其他字段
            adjustFieldsBasedOnTime(dateStr, 'close');
        }
    });
</script>
</body>
</html>
