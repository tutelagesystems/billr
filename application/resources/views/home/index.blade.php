@extends('layouts.master')

@section('javascript')
    <script>
        // test data for now
        var line_data = {
            labels: {!! $report_months !!},
            datasets: [
                {
                    label: "Spending",
                    fillColor: "#66c796",
                    strokeColor: "#fff",
                    data: {!! $report_amounts !!}
                }
            ]
        }


        // LINE CHART WIDGET
        var ctx2 = $("#myLineChart").get(0).getContext("2d");
        ctx2.canvas.height = 50;
        var myLineChart = new Chart(ctx2).Bar(line_data,
        {
            responsive:true,
            scaleShowGridLines : true,
            scaleGridLineColor : "#000",
            scaleShowLabels: false,
            showScale: false,
            datasetStroke : false,
            tooltipTemplate: "$<%= value %><%if (label){%> - <%=label%><%}%>"
        });
    </script>
@stop

@section('content')
<div class="container">
  <div class="row">

    @if(Session::has('notification_warning'))
        <div class="alert alert-warning">
            <h4>
                Warning!
            </h4>
            <p>
                You need to set your <strong>Days before receiving a Notification</strong> in your <a href="{{ URL::route('settings') }}">Settings</a> found under <strong>My Account</strong>.
            </p>
        </div>
    @endif

    <!-- Show Phone Version -->
    <div class="visible-xs">
        <!-- OVER DUE -->
        <div class="col-xs-6">
          <div class="hero-widget well well-sm">
            <div class="icon icon-sm">
              <i class="glyphicon glyphicon-exclamation-sign text-danger"></i>
            </div>
            <div class="text">
              <var><a href="{{ URL::route('bill') }}">{{ $overdueBills->count() }}</a></var>
              <label class="text-muted">overdue bills (${{ number_format($overdueBills->sum('amount'), 2) }})</label>
            </div>
            <div class="options">
              <a href="{{ URL::route('bill') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i> View</a>
            </div>
          </div>
        </div>

        <!-- DUE IN 30 -->
        <div class="col-xs-6">
          <div class="hero-widget well well-sm">
            <div class="icon icon-sm">
              <i class="glyphicon glyphicon-warning-sign"></i>
            </div>
            <div class="text">
              <var><a href="{{ URL::route('bill') }}">{{ $nextUnpaidBills->count() }}</a></var>
              <label class="text-muted">due in {{ Auth::user()->notification_days }} days (${{ number_format($nextUnpaidBills->sum('amount'), 2) }})</label>
            </div>
            <div class="options">
              <a href="{{ URL::route('bill.add') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Add</a>
            </div>
          </div>
        </div>
    </div>
    <!-- END PHONE VERSION -->

    <!-- Hide from Phone Version -->
    <div class="hidden-xs">
        <!-- OVER DUE -->
        <div class="col-sm-4">
          <div class="hero-widget well well-sm">
            <div class="icon">
              <i class="glyphicon glyphicon-exclamation-sign text-danger"></i>
            </div>
            <div class="text">
              <var><a href="{{ URL::route('bill') }}">{{ $overdueBills->count() }}</a></var>
              <label class="text-muted">overdue bills (${{ number_format($overdueBills->sum('amount'), 2) }})</label>
            </div>
            <div class="options">
                <a href="{{ URL::route('bill') }}" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i> View Bills</a>
            </div>
          </div>
        </div>

        <!-- DUE IN 30 -->
        <div class="col-sm-4">
          <div class="hero-widget well well-sm">
            <div class="icon">
              <i class="glyphicon glyphicon-warning-sign"></i>
            </div>
            <div class="text">
              <var><a href="{{ URL::route('bill') }}">{{ $nextUnpaidBills->count() }}</a></var>
              <label class="text-muted">due in {{ Auth::user()->notification_days }} days (${{ number_format($nextUnpaidBills->sum('amount'), 2) }})</label>
            </div>
            <div class="options">
              <a href="{{ URL::route('bill.add') }}" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Add Bill</a>
            </div>
          </div>
        </div>

        <!-- COMPANIES -->
        <div class="col-sm-4">
          <div class="hero-widget well well-sm">
            <div class="icon">
              <i class="glyphicon glyphicon-briefcase"></i>
            </div>
            <div class="text">
              <var><a href="{{ URL::route('company') }}">{{ Auth::user()->companies()->where('active', true)->count() }}</a></var>
              <label class="text-muted">companies</label>
            </div>
            <div class="options">
                @if(Auth::user()->canCreateCompany())
                    <a href="{{ URL::route('company.add') }}" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-plus"></i> Add Company</a>
                @else
                    <a href="{{ URL::route('subscription.subscribe') }}" class="btn btn-primary btn-lg"><i class="fa fa-credit-card"></i> Subscribe</a>
                @endif
            </div>
          </div>
        </div>
    </div>

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div id="line-chart-widget" class="panel">
        <div class="panel-heading">
          <h4 class="text-uppercase"><strong>Spending Overview (Monthly)</strong></h4>
        </div>
        <div class="panel-body">
          <canvas id="myLineChart"></canvas>
        </div>

      </div>
    </div>
  </div>
</div>

@stop