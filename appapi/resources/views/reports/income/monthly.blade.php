@extends('layout')
@section('content')
    <div class="container login mt-0">

        <div class="row" style="margin-bottom: 20px; margin-top: 20px">
            <div class="col-sm-2">
                {{-- <div class="row-sm">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('img/back.png') }}" alt="PawfectMatch" width="auto" height="35px"></a>
                </div> --}}
            </div>
            <div class="col-sm-8 text-center">
                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">VIEW REPORTS</div>
            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="container mt-0">
            <div class="row">
                <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
                    <h3 style="color: white; font-weight: bold;">Transactions</h3>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/reports/bookings') }}"> <button class="btn btn-sidenav">Booking</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/reports/adoptions') }}"> <button class="btn btn-sidenav">Adoption</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/reports/agreements') }}"> <button class="btn btn-sidenav">Agreement</button></a>
                    </div>
                    <h3 style="color: white; font-size: 25px; font-weight: bold;margin-top: 20px">Income Report</h3>

                    <div class="indicator-bg">
                        <a href="{{ url('/subscription-report') }}"><button
                                class="btn btn-sidenav">Subscription</button></a>
                    </div>
                </div>
                <div class="col-lg-10"
                    style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                    <div class="row">
                        <h1 style="text-align: center; color: white">Income Reports</h1>
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link  active" href="{{ url('/monthly-report') }}">Monthly</a>
                            </li>
                            <li class="nav-item "><a class="nav-link" href="{{ url('/annual-report') }}">Annually</a></li>
                        </ul>
                        <center>
                            <div style="width: 70%">
                                <canvas id="incomeChart" width="400" height="200"></canvas>
                            </div>
                            <table class="table w-50 ">
                                <thead>
                                    <tr>
                                        <th scope="col">Month</th>
                                        <th scope="col">Total Income</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthlyIncome as $income)
                                        <tr>
                                            <td>{{ $income->month }}</td>
                                            <td>{{ $income->total_income }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td><strong>{{ $monthlyIncome->sum('total_income') }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                        </center>
                        <script>
                            // Parse PHP data to JavaScript
                            var monthlyIncomeData = @json($monthlyIncome);

                            // Prepare data for Chart.js
                            // var labels = monthlyIncomeData.map(item => item.month);
                            var data = monthlyIncomeData.map(item => item.total_income);
                            var labels = monthlyIncomeData.map(item => getMonthLabel(item.month));

                            // Function to get month label based on the month number
                            function getMonthLabel(monthNumber) {
                                var monthNames = [
                                    'January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November', 'December'
                                ];
                                return monthNames[monthNumber - 1];
                            }
                            // Create Chart.js chart
                            var ctx = document.getElementById('incomeChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Total Income',
                                        data: data,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
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
                        </script>
                    </div>
                    <div class="row">
                        {{-- <div id="list">
                            @include('reports.bookings.search.results')
                        </div> --}}
                    </div>


                </div>
            </div>


        </div>


    </div>
@endsection
