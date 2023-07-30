@extends('layouts.admin')

@section('content')
    <h2>Szép napot!</h2>

    <div class="row row-cols-2 row-cols-md-3">
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-calendar-day display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $countListingsToday }}</h3>
                        <span class="small">Mai álláshirdetés</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-briefcase display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $countListings }}</h3>
                        <span class="small">Összes álláshirdetés</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-circle-xmark display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $countListingsNotUsed }}</h3>
                        <span class="small">Nem használt álláshirdetés</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-check-double display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $countListingsFull }}</h3>
                        <span class="small">Teljesen kategorizált hirdetések</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-percent display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $percentageOfNotUsedListings }}%</h3>
                        <span class="small">Nem használt álláshirdetések</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body d-flex flex-row">
                    <div class="align-self-center ps-3 pe-4">
                        <i class="fas fa-circle-exclamation display-6 text-primary-emphasis"></i>
                    </div>
                    <div>
                        <h3>{{ $errorsToday }}</h3>
                        <span class="small">Mai scraper hibák</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2">
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <div style="width: 100%;"><canvas id="joblistings_by_days"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <div style="width: 100%;"><canvas id="joblistings_by_crawlers"></canvas></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.2/chart.umd.js" integrity="sha512-KIq/d78rZMlPa/mMe2W/QkRgg+l0/GAAu4mGBacU0OQyPV/7EPoGQChDb269GigVoPQit5CqbNRFbgTjXHHrQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Job Listings Daily Chart
        let dataJobListingsDaily = @json($jobListingsDaily);

        let configJobListingsDaily = {
            type: 'bar',
            data: {
                labels: dataJobListingsDaily.map(row => row.created_date),
                datasets: [
                    {
                        label: 'Álláshirdetések száma',
                        data: dataJobListingsDaily.map(row => row.value)
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Álláshirdetések naponta'
                    }
                }
            },
        };

        let chartJobListingsDaily = new Chart(document.getElementById('joblistings_by_days'), configJobListingsDaily);


        // Listings by Crawler Pie Chart
        let dataJobListingsByCrawler = @json($jobListingsCrawler);

        let configJobListingsByCrawler = {
            type: 'pie',
            data: {
                labels: dataJobListingsByCrawler.map(row => row.crawler),
                datasets: [
                    {
                        label: 'Álláshirdetések száma',
                        data: dataJobListingsByCrawler.map(row => row.value)
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Álláshirdetések forrásonként'
                    }
                }
            },
        };

        let chartJobListingsByCrawler = new Chart(document.getElementById('joblistings_by_crawlers'), configJobListingsByCrawler);
    </script>
@endpush
