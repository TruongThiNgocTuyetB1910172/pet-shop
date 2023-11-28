@extends('admin.layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $newOrders }}</h3>

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('order-new.index') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $bounceRate }}<sup style="font-size: 20px">%</sup></h3>

                            <p>Tỷ lệ giao hàng thành công</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('order-success.index') }}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $users }}</h3>

                            <p>Người dùng đăng kí</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('user.index') }}" class="small-box-footer">Xem chi tết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{  CurrencyHelper::format($monthlyRevenue) }}</h3>

                            <p>Doanh thu tháng: {{ $month }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="row">
                   <div class="col-6">
                       <div class="card-header">Biểu đổ thống kê doanh thu trong tháng</div>
                       <div class="card-body">
                           <form  action="{{ route('filterGetChartOnlyMonth.revenue') }}">
                               <div class="row py-3">
                                   <div class="col-lg-3">
                                       <input  class="form-control date-picker" name="startDate"  id="startDate" placeholder="Ngày bắt đầu">
                                       @error('startDate')
                                       <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                       @enderror
                                   </div>
                                   <div class="col-lg-3">
                                       <input class="form-control date-picker" name="endDate" id="endDate" placeholder="Ngày kết thúc">
                                       @error('endDate')
                                       <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                       @enderror
                                   </div>
                                   <div class="col-lg-3">
                                       <button class="btn btn-primary" type="button" id="filterBtn">Lọc</button>
                                   </div>
                               </div>
                           </form>
                           <canvas id="revenueChartOnlyMonth"></canvas>
                       </div>
                   </div>
                    <div class="col-6">
                        <div class="card-header">Biểu đồ thống kê doanh thu trong năm</div>
                        <div class="card-body">
                            <form action="{{ url('filterGetRevenueByYear.revenue') }}">
                             <div class="row py-3">
                                 <div class="col-lg-3">
{{--                                     <label for="year" class="form-group">Chọn năm:</label>--}}
                                     <select name="year" id="year" class="form-control">
                                         <option>Chọn năm</option>
                                         <option value="2021">2021</option>
                                         <option value="2022">2022</option>
                                         <option value="2023">2023</option>
                                     </select>
                                 </div>
                                 <div class="col-lg-9">
                                     <button class="btn btn-primary" type="button" id="btnFilter">Lọc</button>
                                 </div>

{{--                                 <label for="year" class="form-group">Chọn năm:</label>--}}
{{--                                 <select name="year" id="year" class="form-control">--}}
{{--                                     <option value="2021">2021</option>--}}
{{--                                     <option value="2022">2022</option>--}}
{{--                                     <option value="2023">2023</option>--}}
{{--                                 </select>--}}
{{--                                 <button class="btn btn-primary" type="button" id="btnFilter">Lọc</button>--}}
                             </div>
                            </form>
                            <canvas id="revenueChartOnlyYear"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col-6">
                       <div class="card-header">Biểu đồ thống kê sản phẩm được bán</div>
                       <div class="card-body" style="width: 500px;height: 500px">
                           <canvas id="productChartOnlyYear"></canvas>
                       </div>
                   </div>
                    <div class="col-6">
                        <div class="card-header">Biểu đồ thống kê khách hàng</div>
                        <div class="card-body" style="width: 500px;height: 500px">
                            <canvas id="getTopCustomersChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card-header">Biểu đồ thống kê trạng thái đơn hàng</div>
                        <div class="card-body" style="width: 500px;height: 500px">
                            <canvas id="orderStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $('.date-picker').flatpickr({
            altInput: true,
            dateFormat: 'Y-m-d H:i',
        });

        $(document).ready(function() {
            var getId = document.getElementById('revenueChartOnlyMonth');

            var chart = new Chart(getId, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Doanh thu',
                        data: [],
                    }]
                },
            });

            function loadChart(startDate, endDate) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('getChartOnlyMonth.revenue') }}',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(response) {
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    }
                });
            }

            $('#filterBtn').click(function(e) {
                e.preventDefault();

                var startAt = $('#startDate').val();
                var endAt = $('#endDate').val();
                console.log(startAt)
                console.log(endAt)

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('filterGetChartOnlyMonth.revenue') }}',
                    data: {
                        startDate: startAt,
                        endDate: endAt,
                    },
                    success: function(response) {
                        // console.log(response)
                        chart.data.labels = response.labels
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });

            loadChart();
        });

    </script>

    <script>
        $(document).ready(function() {
            var getId = document.getElementById('revenueChartOnlyYear');

            var chart = new Chart(getId, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Doanh thu',
                        data: [],
                    }]
                },
            });

            function loadChart(year) {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('getRevenueByYear.revenue') }}',
                    data: {
                        year: year
                    },
                    success: function(response) {
                        chart.data.labels = response.labels;
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    }
                });
            }

            $('#btnFilter').click(function(e) {
                e.preventDefault();

                var year = $('#year').val();

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('filterGetRevenueByYear.revenue') }}',
                    data: {
                        year: year
                    },
                    success: function(response) {
                        chart.data.labels = response.labels;
                        chart.data.datasets[0].data = response.data;
                        chart.update();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            loadChart();
        });
    </script>
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $.ajax({--}}
{{--                type: 'GET',--}}
{{--                dataType: 'json',--}}
{{--                url: '{{ route('getRevenueByYear.revenue') }}',--}}
{{--                success: function(response) {--}}
{{--                    const ctx = document.getElementById('revenueChartOnlyYear');--}}

{{--                    new Chart(ctx, {--}}
{{--                        type: 'bar',--}}
{{--                        data: {--}}
{{--                            labels: response.labels,--}}
{{--                            datasets: [{--}}
{{--                                label: 'Doanh thu',--}}
{{--                                data: response.data,--}}
{{--                                borderWidth: 1--}}
{{--                            }]--}}
{{--                        },--}}
{{--                        options: {--}}
{{--                            scales: {--}}
{{--                                y: {--}}
{{--                                    beginAtZero: true--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <script>
            $(document).ready(function() {
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('productChartOnlyYear.sellingBest') }}',
                    success: function(response) {
                        const ctx = document.getElementById('productChartOnlyYear');

                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: response.labels,
                                datasets: [{
                                    label: ' Phần trăm',
                                    data: response.data,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                });
            });
        </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '{{ route('user.getTopCustomersChart') }}',
                success: function(response) {
                    const ctx = document.getElementById('getTopCustomersChart');

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: response.labels,
                            datasets: [{
                                label: 'Lượt mua',
                                data: response.data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    console.log(response.labels)
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '{{ route('order.getOrderStatusData') }}',
                success: function(response) {
                    const ctx = document.getElementById('orderStatusChart');

                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: response.labels,
                            datasets: [{
                                label: 'Đơn hàng',
                                data: response.data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
