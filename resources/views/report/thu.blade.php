@extends('layouts.app')

@section('main')
    <div class="container" style="margin-top: 30px">
        <h2>Báo cáo thu</h2>

        <form action="{{ route('admin.report.generate') }}" method="POST">
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

        @isset($chartData)
            @if ($chartType === 'month')
                <h4 style="margin-top: 50px">Kết quả từ {{ $startDate }} đến {{ $endDate }}</h4>
                <div id="monthly-chart"></div>
            @elseif ($chartType === 'year')
            <h4 style="margin-top: 50px">Kết quả từ {{ $startDate }} đến {{ $endDate }}</h4>
            <div id="yearly-chart"></div>
            @endif
        @endisset
    </div>

    @isset($chartData)
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @if ($chartType === 'month')
            <script>
                var options = {
                    chart: {
                        type: 'bar',
                    },
                    series: [{
                        name: 'Đã thu',
                        data: @json($chartData['values'])
                    }],
                    xaxis: {
                        categories: @json($chartData['labels'])
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('vi-VN').format(value);
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#monthly-chart"), options);
                chart.render();
            </script>
        @elseif ($chartType === 'year')
            <script>
                var options = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: [{
                        name: 'Đã thu',
                        data: @json($chartData['values'])
                    }],
                    xaxis: {
                        categories: @json($chartData['labels'])
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return new Intl.NumberFormat('vi-VN').format(value);
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#yearly-chart"), options);
                chart.render();
            </script>
        @endif
    @endisset

@endsection
