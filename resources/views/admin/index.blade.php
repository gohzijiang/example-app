@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

@guest
    @if (Route::has('login'))
        <script>
            window.location.href='{{ route('login') }}'
        </script>
    @endif
@else
    @if (Auth::user()->is_admin == 0)
        @if(Session::has('success'))           
            <div class="alert alert-success" role="alert">
                {{ Session::get('success')}}
            </div>       
        @endif 
    @endif
@endif
 
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">  
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&family=Catamaran:wght@500&display=swap" rel="stylesheet">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Search Form</title>
        <title>All Bookings</title>
    </head>
    <body>
        <h1>All Bookings</h1>
       <div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="navbar-nav" style="margin-top: 8px;">
                <form class="form-inline active-cyan-4" action="{{ route('search.ByUserName') }}" method="post">
                    @csrf
                    <input class="form-control form-control-sm ml-3 w-75 rounded-pill " type="text" placeholder="Find Booking By User" aria-label="Search" name="searchByUserName" id="searchByUserName">
                    <button class="btn btn-primary btn-sm" type="submit">Search</button>
                </form>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="navbar-nav" style="margin-top: 8px;">
                <form class="form-inline active-cyan-4" action="{{ route('search.ByDateTime') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="datepicker">Select Date: </label>
                        <input type="text" class="form-control" id="datepicker"  name="searchByDateTime" id="searchByDateTime" autocomplete="off">
                    </div>
                    <button class="btn btn-primary ml-2" type="submit">Search</button>
                </form>
            </ul>
        </div>
        @if(session('error'))
            <script>
                alert("{{ session('error') }}");
            </script>
        @endif
        <div class="col-md-3">
            <ul class="navbar-nav" style="margin-top: 8px;">
                <form id="combinedSearchForm" class="form-inline active-cyan-4" action="{{ route('search.ByUserNameAndDateTime') }}" method="post">
                    @csrf
                    <input type="hidden" name="searchByUserName" id="combinedSearchByUserName">
                    <input type="hidden" name="searchByDateTime" id="combinedSearchByDateTime">

                    <button class="btn btn-primary btn-sm" type="button" onclick="submitCombinedSearch()">Search By User and Date</button>
                </form>
            </ul>
        </div>
    </div>
            <div class="row">
                <table class="table">
                    <thead id="table-head">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Car Size</th>
                            <th>Date Time</th>
                            <th>License plate</th>
                            <th>phone_number </th>
                            <th>Email</th>
                            <th>Noted</th>
                            <th>Total price</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if($bookings->isEmpty())
                        @if(isset($searchByDateTime))
                            <p>No bookings available for {{ $searchByDateTime->format('Y-m-d') }}.</p>
                        @elseif(isset($searchByUserName))
                            <p>No bookings available for {{ $searchByUserName }}.</p>
                        @else
                            <p>No bookings available for today.</p>
                        @endif
                    @else
                            @foreach($bookings as $booking)
                                <tr>
                                    <!-- 如果您有服务的信息，可以通过 $booking->service 来获取 -->
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ optional($booking->user)->name }}</td>
                                    <td>{{ optional($booking->service)->name }}</td>
                                    <td>{{ $booking->booking_datetime  }}</td>
                                    <td>{{ $booking->Name }}</td>
                                    <td>{{ $booking->phone_number }}</td>
                                    <td>{{ $booking->Email }}</td>
                                    <td>{{ $booking->note }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                </tr>
                            @endforeach
                        @endif                       
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#searchForm').submit(function (e) {
            // 取消默认的表单提交行为
            e.preventDefault();

            // 获取选择的日期
            var selectedDate = $('#datepicker').val();

            // 发送 AJAX 请求到后端
            $.ajax({
                type: 'POST',
                url: '{{ route("search.ByDateTime") }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "bookingDateTime": selectedDate
                },
                success: function(response) {
                    // 处理后端返回的预订信息
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
    function submitCombinedSearch() {
    // 获取用户名和日期的值
    var userName = document.getElementById('searchByUserName').value;
    var searchByDateTimeElement = document.getElementById('datepicker');
    var searchByDateTime = searchByDateTimeElement.value;

    console.log(userName);
    console.log(searchByDateTime);
    
    if (userName.trim() === '') {
        alert('Please insert user name');
        return;  // 终止函数
    }
    if (searchByDateTime.trim() === '') {
        alert('Please insert the date');
        return;  // 终止函数
    }

    // 将值填入联合搜索表单的对应字段
    document.getElementById('combinedSearchByUserName').value = userName;
    document.getElementById('combinedSearchByDateTime').value = searchByDateTime;

    // 设置联合搜索表单的提交方法为 POST
    document.getElementById('combinedSearchForm').method = 'POST';

    document.getElementById('combinedSearchForm').submit();
}

</script>



@endsection