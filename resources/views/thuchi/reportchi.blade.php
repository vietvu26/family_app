@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 30px">
        <h2 >Báo cáo chi</h2>

        <form action="{{ route('admin.creport.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="start_date">Từ ngày:</label>
                <input type="date" id="start_date" name="start_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_date">Đến ngày:</label>
                <input type="date" id="end_date" name="end_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Xem báo cáo</button>
        </form>

        @isset($startDate, $endDate)
            <h4>Kết quả từ {{ $startDate }} đến {{ $endDate }}</h4>
            <!-- Đây là nơi để hiển thị biểu đồ cột -->
            <div id="column-chart"></div>
        @endisset
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Đoạn script để vẽ biểu đồ cột sử dụng thư viện ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Thu nhập',
                data: [30, 40, 45, 50, 49, 60, 70, 91, 125]
            }],
            xaxis: {
                categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9']
            }
        }

        var chart = new ApexCharts(document.querySelector("#column-chart"), options);
        chart.render();
    </script>
@endsection
