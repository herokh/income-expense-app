@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-black-50">Report Summary</h1>
    <div>
        <strong>Last top 100 records</strong>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Type</th>
                <th scope="col">Datetime</th>
                <th scope="col">Amount</th>
                <th scope="col">Note</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($transactions as $t)
                <tr>
                    <td>
                        @if($t->transaction_type == 'income')
                            <i class="nav-icon fas fa-coins"></i> Income
                        @else
                            <i class="nav-icon fas fa-file-invoice"></i> Expense
                        @endif
                    </td>
                    <td>{{ $t->transaction_datetime->format('Y-m-d') }}</td>
                    <td>{{ $t->amount }}</td>
                    <td>{{ $t->note }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-6">
            <div>
                <strong>Last 7 days summary</strong>
                <canvas id="last7Days" data-dataset="{{ json_encode($last7Days) }}"></canvas>
            </div>
        </div>
        <div class="col-6">
            <div>
                <strong>Last 4 months summary</strong>
                <canvas id="last4Months" data-dataset="{{ json_encode($last4Months) }}"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('third_party_scripts')
<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@push('page_scripts')
<script>

    const last7DaysDataset = $('#last7Days').data('dataset');
    const last7DaysData = {
        labels: last7DaysDataset.map(x => dayjs(x.transaction_datetime).format('YYYY-MM-DD')),
        datasets: [{
            label: 'Total income amount',
            borderColor: 'rgb(255, 99, 132)',
            data: last7DaysDataset.map(x => x.total_income_amount),
        },
        {
            label: 'Total expense amount',
            borderColor: 'rgb(100, 181, 246)',
            data: last7DaysDataset.map(x => x.total_expense_amount),
        }]
    };

    const last7DaysConfig = {
        type: 'line',
        data: last7DaysData,
        options: {}
    };

    const last4MonthsDataset = $('#last4Months').data('dataset');
    const last4MonthsData = {
        labels: last4MonthsDataset.map(x => dayjs(x.transaction_year + '-' + x.transaction_month + '-1').format('YYYY-MM')),
        datasets: [{
            label: 'Total income amount',
            borderColor: 'rgb(255, 99, 132)',
            data: last4MonthsDataset.map(x => x.total_income_amount),
        },
        {
            label: 'Total expense amount',
            borderColor: 'rgb(100, 181, 246)',
            data: last4MonthsDataset.map(x => x.total_expense_amount),
        }]
    };


    const last4MonthsConfig = {
        type: 'line',
        data: last4MonthsData,
        options: {}
    };

    new window.Chart(
        document.getElementById('last7Days'),
        last7DaysConfig
    );

    new window.Chart(
        document.getElementById('last4Months'),
        last4MonthsConfig
    );
</script>
@endpush
