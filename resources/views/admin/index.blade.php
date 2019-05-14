@extends('layouts.sidebar')
@section('styles')
    <!-- Chart css -->
 <link href="{{ asset('css/chart.css') }}" rel="stylesheet">
@endsection
    @section('pageContent')
    <h1>Admin - Dashboard</h1>
    <canvas id="myChart" width="400" height="200"></canvas><hr>
    @endsection
@section('scripts')
    <!-- Chart js -->
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Posts', 'Users', 'Categories', 'Comments', 'Replies', 'Photos'],
                datasets: [{
                    label: 'Website Data',
                    data: [{{ $postCount }}, {{ $userCount }},{{ $categoryCount }},{{ $commentCount }},{{ $replyCount }},{{ $photoCount }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script>
@endsection
