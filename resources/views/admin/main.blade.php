<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
                        @if(auth()->user()->role == "Administrator")
                            {{ __("Welcome Back Admin!") }}
                        @else
                            {{ __("Welcome Back Petugas!") }}
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Container untuk dua chart -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Chart.js Bar Chart -->
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Bar Chart</h3>
                    <canvas id="chartjs-bar"></canvas>
                </div>

                <!-- ApexCharts Pie Chart -->
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Pie Chart</h3>
                    <div id="apexcharts-pie"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Chart.js dan ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function renderCharts() {
            // ========== Chart.js Bar Chart ==========

            let ctx = document.getElementById("chartjs-bar").getContext("2d");

            // Hapus chart jika sudah ada sebelumnya
            if (window.barChart) {
                window.barChart.destroy();
            }

            window.barChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar"],
                    datasets: [{
                        label: "Last year",
                        backgroundColor: "#4F46E5",
                        borderColor: "#4F46E5",
                        hoverBackgroundColor: "#4F46E5",
                        hoverBorderColor: "#4F46E5",
                        data: [54, 67, 41],
                        barPercentage: 1.75,
                        categoryPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // ========== ApexCharts Pie Chart ==========
            let pieChartEl = document.querySelector("#apexcharts-pie");

            if (pieChartEl) {
                // Hapus chart jika sudah ada sebelumnya
                if (window.pieChart) {
                    window.pieChart.destroy();
                }

                let pieOptions = {
                    chart: {
                        height: 350,
                        type: "pie",
                    },
                    dataLabels: { enabled: false },
                    series: [44, 55, 13, 33],
                    labels: ["Product A", "Product B", "Product C", "Product D"]
                };

                window.pieChart = new ApexCharts(pieChartEl, pieOptions);
                window.pieChart.render();
            }
        }

        document.addEventListener("DOMContentLoaded", renderCharts);
    </script>
</x-app-layout>
