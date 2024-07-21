@extends('layouts.app')

@section('main')
<div class="container" style="margin-top: 30px">
    <h2>Báo cáo thu chi</h2>

    <form action="{{ route('admin.tcreport.generate') }}" method="POST">
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
        <h4 style="margin-top: 50px">Kết quả từ {{ $startDate }} đến {{ $endDate }}</h4>
        <div id="report-chart"></div>
        <table class="table table-bordered" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>{{ $chartType === 'month' ? 'Tháng' : 'Năm' }}</th>
                    <th>Thu</th>
                    <th>Chi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chartData['labels'] as $index => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td>{{ isset($chartData['thu_values'][$index]) ? number_format($chartData['thu_values'][$index], 0, ',', '.') . ' VND' : 'null' }}</td>
                        <td>{{ isset($chartData['chi_values'][$index]) ? number_format($chartData['chi_values'][$index], 0, ',', '.') . ' VND' : 'null' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endisset
</div>

@isset($chartData)
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [
                {
                    name: 'Thu',
                    data: @json($chartData['thu_values'])
                },
                {
                    name: 'Chi',
                    data: @json($chartData['chi_values'])
                }
            ],
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

        var chart = new ApexCharts(document.querySelector("#report-chart"), options);
        chart.render();
    </script>
@endisset

@endsection
