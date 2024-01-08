<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
<body>
    <div class="container">
        <h1>Booking Details</h1>
        <form method="POST" action="{{ route('bookings.store') }}">
    @csrf

    <div>{{ Auth::user()->id }}</div>
    <input type="hidden" id="user_id_input" name="user_id" value="{{ Auth::user()->id }}">
    <div class="form-group">
        <label for="service_id">Service</label>
        <select id="service_id" type="text" class="form-control @error('service_id') is-invalid @enderror" name="service_id" value="{{ old('service_id') }}" required autocomplete="service_id" autofocus>
            <option value="">-- Select Service --</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
       
    </div>
    

    <span id="serviceDuration"></span>
        <div class="form-group">
        <label for="booking_date">Booking Date </label>
        <input id="booking_date" type="date" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date" value="{{ old('booking_date') }}" required autocomplete="booking_date" autofocus>
        @error('booking_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <span id="openTime"></span>
        <span id="closeTime"></span>
        <span id="availableLines"></span>
        <div id="selectedTimeLabel" style="display:none;"></div>
    <div class="form-group" id="timeSlotContainer" style="height:280px; width: 700px; overflow:scroll; border: 1px solid #ddd;">
    <label for="booking_time">Booking Time </label>
        <!-- 时间槽内容 -->
    </div>
    <input type="hidden" id="booking_datetime_input" name="booking_datetime">
    
    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
        @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>  

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="text" pattern="^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
            title="请输入有效的电子邮件地址" class="form-control @error('Email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
        @error('Email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="note">Note</label>
        <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note" autocomplete="note" autofocus>{{ old('note') }}</textarea>
        @error('note')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary" id="submitBtn">Book</button>
</form>
</html>


<script>
var serviceDuration;

$('#service_id').change(function () {
        // 获取选择的服务 ID
        var selectedServiceId = $(this).val();
        
        // 发送 AJAX 请求，获取服务的持续时间
        $.ajax({
            type: 'GET',
            url: '/getServiceDuration/' + selectedServiceId,
            success: function (response) {
                serviceDuration = response.duration;

                // 在页面上显示服务的持续时间
                var serviceDurationElement = document.getElementById('serviceDuration');
                if (serviceDurationElement) {
                    serviceDurationElement.textContent = "Service Duration: " + serviceDuration;
                } else {
                    console.error("Element with id 'serviceDuration' not found.");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

function getDuration() {
    return serviceDuration; // 返回全局的 serviceDuration
}
getDuration();

    document.addEventListener("DOMContentLoaded", function () {
    var timeSlotContainer = document.getElementById('timeSlotContainer');
    var bookingDateInput = document.getElementById('booking_date');
    // time slot select
    var timeSlotSelect = document.getElementById('timeSlotSelect');
    // 隐藏时间槽容器
    timeSlotContainer.style.display = 'none';

    // 设置最小日期值
    var today = new Date();
    var nextDay = new Date(today);
    nextDay.setDate(today.getDate() + 1);
    var formattedNextDay = nextDay.toISOString().slice(0, -8);
    document.getElementById('booking_date').min = formattedNextDay;

    // 监听日期选择框的变化
    bookingDateInput.addEventListener('change', function () {
        // 获取选择的日期
        timeSlotContainer.innerHTML = '';
        var selectedDate = this.value;  
    
            
        // 发送 AJAX 请求，获取时间槽数据
        $.when(
            $.ajax({
                type: 'GET',
                url: '/getOpenCloseTime/' + selectedDate,
            }),
            $.ajax({
                type: 'GET',
                url: '/getAvailableIndustrialLines/' + selectedDate,
            })
        ).done(function (openCloseResponse, linesResponse) {
            // 处理获取时间槽数据的响应
            var openCloseData = openCloseResponse[0];
            if (openCloseData.error) {
                // 显示错误消息
                console.error(openCloseData.error);
            } else {
     
                // 操作正常情况下的响应
                var openTime = new Date(selectedDate + ' ' + openCloseData.open_time);
                var closeTime = new Date(selectedDate + ' ' + openCloseData.close_time);
                //var duration = openCloseData.duration;
                
                // 在页面上显示开放、关闭时间和持续时间
                var openTimeElement = document.getElementById('openTime');
                var closeTimeElement = document.getElementById('closeTime');
              

                openTimeElement.textContent = "Open Time: " + openTime;
                closeTimeElement.textContent = "Close Time: " + closeTime;
    

                // 处理获取工业线数量的响应
                var linesData = linesResponse[0];
                var availableLines = linesData.availableLines;
                // 在页面上显示工业线数量
                var linesElement = document.getElementById('availableLines');
                linesElement.textContent = "Available Industrial Lines: " + availableLines;


                  // 显示时间槽容器
                timeSlotContainer.style.display = 'block';

                    // 清空时间槽容器
                timeSlotContainer.innerHTML = '';

                // 使用 openTime 的副本初始化 currentTime
                var currentTime = new Date(openTime);
               
                while (currentTime < closeTime) {
                    var timeslotDiv = document.createElement('div');
                    timeslotDiv.classList.add('timeslot');

                    // 获取当前时间槽的值
                    timeslotDiv.textContent = formatTime(currentTime);
                    timeSlotContainer.appendChild(timeslotDiv);

                    // 保存当前时间，以便稍后调整
                    var previousTime = new Date(currentTime);
                    // 增加时间槽间隔
                    currentTime.setMinutes(currentTime.getMinutes() + getDuration());
                  
                    // 检查是否超过或等于结束时间，如果是，则停止循环
                    if (currentTime >= closeTime) {
                        break;
                    }
                }
             
            }

       
    

        }).fail(function (error) {
            console.log(error);
        });
    });
            
    function formatTime(date) {
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        return hours + ':' + minutes;
    }

    $('#timeSlotContainer').on('click', '.timeslot', function() {
        // 获取点击的时间槽内容
        var selectedTime = $(this).text();

        // 创建Booking Time标签
        var bookingTimeLabel = $('<label for="booking_time">Booking Time: </label>');
        var bookingTimeValue = $('<span>' + selectedTime + '</span>');

        // 清空并添加Booking Time标签
        $('#selectedTimeLabel').empty().append(bookingTimeLabel).append(bookingTimeValue);

        // 显示新标签
        $('#selectedTimeLabel').show();
    });


});


function resetDateTable() {
    // 清空表格内容
    $('#dateTable').empty();

    // 重新加载日期表的数据，此处模拟加载
    loadDateTable();
}

function loadDateTable() {
    // 模拟加载数据的操作，例如向表格中添加一些行
    var table = $('#dateTable');

    // 这里假设你有一个包含日期数据的数组，你需要根据实际情况修改这部分逻辑
    var dateData = ['2024-01-01', '2024-01-02', '2024-01-03'];

    // 遍历日期数据，添加到表格中
    dateData.forEach(function (date) {
        // 将日期格式化为 "dd/mm/yyyy"
        var formattedDate = formatDate(date);

        // 创建表格行并添加到表格中
        var row = '<tr><td>' + formattedDate + '</td></tr>';
        table.append(row);
    });
}

function formatDate(dateString) {
    // 将日期字符串解析为 Date 对象
    var dateObject = new Date(dateString);

    // 获取日期、月份和年份
    var day = dateObject.getDate();
    var month = dateObject.getMonth() + 1; // 注意：月份是从0开始的，所以要加1
    var year = dateObject.getFullYear();

    // 使用 padStart 方法确保月份和日期是两位数
    var formattedDay = day.toString().padStart(2, '0');
    var formattedMonth = month.toString().padStart(2, '0');

    // 返回格式化后的日期字符串
    return formattedDay + '/' + formattedMonth + '/' + year;
}

$('#submitBtn').on('click', function(event) {
    // 阻止默认的提交行为
    event.preventDefault();

    // 获取选择的服务 ID
    var selectedServiceId = $('#service_id').val();

    // 获取选择的日期和时间
    var selectedDate = $('#booking_date').val();
    var selectedTime = $('#selectedTimeLabel span').text();

    // 结合日期和时间
    var bookingDatetime = selectedDate + ' ' + selectedTime;

    // 设置隐藏字段的值
    $('#booking_datetime_input').val(bookingDatetime);

    // 获取其他表单字段的值
    var name = $('#name').val();
    var phone_number = $('#phone_number').val();
    var email = $('#email').val();
    var note = $('#note').val();
    var userId = $('#user_id_input').val();
            // Check if the response contains the user_id    
                $('#service_id').val(selectedServiceId);
                $('#booking_datetime_input').val(bookingDatetime);
                $('#name').val(name);
                $('#phone_number').val(phone_number);
                $('#email').val(email);
                $('#note').val(note);
                console.log('Selected Service ID: ', selectedServiceId);
                console.log('Booking Datetime: ', bookingDatetime);
                console.log('Name: ', name);
                console.log('Phone Number: ', phone_number);
                console.log('Email: ', email);
                console.log('Note: ', note);
                console.log('User ID: ', userId);
                
                $('form').submit();
});

   
</script>



<style>
     body {
        font-family: 'Roboto';
    }

    .days {
        width: 1000px;
    }

    .day {
        width: 120px;
        height: 230px;
        background-color: #efeff6;
        padding: 10px;
        float: left;
        margin-right: 7px;
        margin-bottom: 5px;
    }

    .datelabel {
        margin-bottom: 15px;
    }

    .timeslot {
        background-color: #00c09d;
        width: auto;
        height: 20px;
        color: white;
        padding: 7px;
        margin-top: 5px;
        font-size: 14px;
        border-radius: 3px;
        vertical-align: center;
        text-align: center;
    }

    .timeslot:hover {
        background-color: #2CA893;
        cursor: pointer;
    }
</style>
