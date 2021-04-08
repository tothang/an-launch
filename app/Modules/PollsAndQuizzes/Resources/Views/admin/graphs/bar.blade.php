@extends('layouts.admin.plain', ['noNav' => true])

@section('content')

    <div class="chart-title">
        <img class="chart-logo" src="{{ asset('img/logos/drpg-pa-white.svg') }}" width="440" alt="Chart Logo">
    </div>

    <div class="banner__light">
        <h1 style="font-size: 42px;">{{ $pollAndQuizQuestion->title }}</h1>
    </div>

    <div class="chart-wrap" style="position: relative;">
        <canvas id="myChart"></canvas>
    </div>

@endsection

@push('js')
<script>
    function resize(){
        $("#myChart").outerHeight($(window).height()-$("#myChart").offset().top- Math.abs($("#myChart").outerHeight(true) - $("#myChart").outerHeight()));
    }
    $(document).ready(function(){
        resize();
        $(window).on("resize", function(){
            resize();
        });
    });

    var ctx = document.getElementById("myChart");
    var data = {!! $pollAndQuizQuestion->percentage()->toJson() !!};

    var label = {!! $pollAndQuizQuestion->answers->pluck('value')->map(function ($title) {
        return \Str::limit($title, 30);
    })->toJson() !!};

    var labelFormatted = new Array();
    for(var i = 0; i < label.length; i++) {
        // Add additional code here, such as:
        var formatted = formatLabel(label[i], 14);
        labelFormatted.push(formatted);
    }
    var config = {
        type: 'bar',
        data: {
            labels: labelFormatted,
            datasets: [{
                data: [],
                backgroundColor: {!! $colours->toJson() !!},
                borderColor: {!! $colours->toJson() !!},
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                defaultFontColor: "#fff",
                yAxes: [{
                    scaleLabel: {
                        display: false,
                        labelString: 'Percentage',
                        fontSize: 32,
                        fontColor: "#fff",
                    },
                    ticks: {
                        beginAtZero:true,
                        max:100,
                        stepSize: 50,
                        fontSize: 42,
                        fontColor: "#fff",
                        fontFamily: "Arial"
                    },
                    gridLines : {
                        color: "#fff",
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines : {
                        display: false,
                        color: "#fff"
                    },
                    ticks: {
                        fontSize: 42,
                        fontColor: "#fff",
                        fontFamily: "Arial",
                        autoSkip: false
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: false,
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.yLabel;
                    }
                }
            },
            hover: {
                enabled: false,
                animationDuration: 0
            },
            animation: {
                duration: 2500,
                easing: 'easeInOutQuad',
                onComplete: function() {
                    this.chart.controller.draw();
                    drawValue(this, 1, {{ $pollAndQuizQuestion->show_decimals }});
                }
            }
        }
    };
    var myChart = new Chart(ctx, config);

    $(function() {
        $('body').keypress(function () {

            for(var i = 0; i <= config.data.labels.length; i++){
                config.data.datasets[0].data[i] = data[i];
            }

            myChart.update();

        });
    });

    function formatLabel(str, maxwidth){
        var sections = [];
        var htmlStr = decodeHtml(str);
        var words = htmlStr.split(" ");
        var temp = "";

        words.forEach(function(item, index){
            if(temp.length > 0)
            {
                var concat = temp + ' ' + item;

                if(concat.length > maxwidth){
                    sections.push(temp);
                    temp = "";
                }
                else{
                    if(index == (words.length-1))
                    {
                        sections.push(concat);
                        return;
                    }
                    else{
                        temp = concat;
                        return;
                    }
                }
            }

            if(index == (words.length-1))
            {
                sections.push(item);
                return;
            }

            if(item.length < maxwidth) {
                temp = item;
            }
            else {
                sections.push(item);
            }

        });

        return sections;
    }

    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }

    // Font color for values inside the bar
    var insideFontColor = '0,0,0';
    // Font color for values above the bar
    var outsideFontColor = '255,255,255';
    // How close to the top edge bar can be before the value is put inside it
    var topThreshold = 70;

    var modifyCtx = function(ctx) {
        ctx.font = Chart.helpers.fontString(60, 'normal', Chart.defaults.global.defaultFontFamily);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        return ctx;
    };

    var fadeIn = function(ctx, obj, x, y, black, step) {
        var ctx = modifyCtx(ctx);
        var alpha = 0;
        ctx.fillStyle = black ? 'rgba(' + outsideFontColor + ',' + step + ')' : 'rgba(' + insideFontColor + ',' + step + ')';
        ctx.fillText(obj, x, y);
    };

    var drawValue = function(context, step, show_decimals) {
        var ctx = context.chart.ctx;

        context.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
                var textY = (model.y > topThreshold) ? model.y - 10 : model.y + 70;
                fadeIn(ctx, parseFloat(dataset.data[i].toFixed(show_decimals))+'%', model.x, textY, model.y > topThreshold, step);
            }
        });
    };

</script>
@endpush
