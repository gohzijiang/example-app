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
        <div id="available_lines_count">
        </div>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf

            <div class="form-group">
                <label for="service_id">Service</label>
                <select id="service_id" type="text" class="form-control @error('service_id') is-invalid @enderror" name="service_id" value="{{ old('service_id') }}" required autocomplete="service_id" autofocus>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="booking_datetime">Booking Date and Time</label>
                <input id="booking_datetime" type="datetime-local" class="form-control @error('booking_datetime') is-invalid @enderror" name="booking_datetime" value="{{ old('booking_datetime') }}" required autocomplete="booking_datetime" autofocus>
                @error('booking_datetime')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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
                <label for="address">Address</label>
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                @error('address')
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
            
            <button type="submit" class="btn btn-primary">Book</button>

           
                
</body>
</html>


<script>

var openTime = '{{ session('openTime') }}';
var closeTime = '{{ session('closeTime') }}';
    document.addEventListener("DOMContentLoaded", function () {
        // 监听日期选择框的变化
        document.getElementById('booking_datetime').addEventListener('change', function() {
            // 获取选择的日期
            var selectedDate = this.value;

            // 发送 AJAX 请求，获取当天的工业线数量
            $.ajax({
                type: 'GET',
                url: '/getAvailableIndustrialLines/' + selectedDate,
                success: function (response) {
                    var availableLines = response.availableLines;

                    // 更新页面上显示的工业线数量
                    document.getElementById('available_lines_count').innerText = availableLines;
                },
                error: function (error) {
                    console.log(error);
                }
            });           
        });
    });

   

    document.addEventListener("DOMContentLoaded", function () {
        // 监听预约时间输入框的变化
        document.getElementById('booking_datetime').addEventListener('change', function() {
            // 获取选择的日期和时间
            var selectedDateTime = new Date(this.value);
            // 将 openTime、closeTime 和 closeTimeBeforeOneHour 转换为 Date 对象
            var closeTimeBeforeOneHour = document.getElementById('closeTimeBeforeOneHour').value;
            var openTimeObj = new Date('1970-01-01 ' + openTime);
            var closeTimeObj = new Date('1970-01-01 ' + closeTime);
            var closeTimeBeforeOneHourObj = new Date('1970-01-01 ' + closeTimeBeforeOneHour);
            
            // 检查选择的时间是否在 openTime 和 closeTime 之间，且最迟只能选择 closeTime 的前一个小时
            if (selectedDateTime < openTimeObj || selectedDateTime > closeTimeObj || selectedDateTime > closeTimeBeforeOneHourObj) {
                alert('请选择在 ' + openTime + ' 和 ' + closeTimeBeforeOneHour + ' 之间的时间。');
                // 清空选择的时间
                this.value = '';
            }
        });
    });
</script>