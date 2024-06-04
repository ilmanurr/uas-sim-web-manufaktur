<!-- resources/views/layouts/home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selamat Datang di <span style="font-weight: bold; font-style:italic">Rafli Collections Information Sistem</span>
    </h1>
    <div class="mt-4">
        <a href="{{ route('bahanbaku.create') }}" class="btn btn-success">Tambah Bahan Baku</a>
        <a href="{{ route('ketersediaan.create') }}" class="btn btn-success">Tambah Ketersediaan</a>
        <a href="{{ route('pemesanan.create') }}" class="btn btn-success">Tambah Pemesanan</a>
    </div>

    <div class="mt-4">
        <canvas id="bahanBakuChart" data-labels="{{ json_encode($bahanBaku->pluck('nm_bahanbaku')->toArray()) }}"
            data-data="{{ json_encode($bahanBaku->pluck('jml_persediaan')->toArray()) }}">
        </canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('bahanBakuChart').getContext('2d');

    // Ambil data dari atribut data- pada elemen canvas
    var labels = JSON.parse(ctx.canvas.getAttribute('data-labels'));
    var data = JSON.parse(ctx.canvas.getAttribute('data-data'));

    // Generate random colors for each bar
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var backgroundColors = labels.map(() => getRandomColor());
    var borderColors = backgroundColors.map(color => color);

    var bahanBakuChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Persediaan',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed.y + ' unit';
                            return label;
                        }
                    }
                },
                legend: {
                    display: true,
                    labels: {
                        generateLabels: function(chart) {
                            var data = chart.data;
                            return data.labels.map(function(label, index) {
                                return {
                                    text: `${label} - ${data.datasets[0].data[index]} unit`,
                                    fillStyle: data.datasets[0].backgroundColor[index],
                                    strokeStyle: data.datasets[0].borderColor[index],
                                    lineWidth: 1,
                                    hidden: false,
                                    index: index
                                };
                            });
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection