@extends('layouts.app')

@section('content')
<div class="container no_max_width">
    <div class="row">
        <div class="col-md-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Currency(USD)</th>
                        <th scope="col">Latest Rate</th>
                        <th scope="col"> Change </th>
                    </tr>
                </thead>
                <tbody id="table-to-refresh">

                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="row mb-5">
                <div id="chartContainer" style="height: 550px; width: 100%;"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Buy Coin</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Coin Type">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount</label>
                            <input type="text" class="form-control" id="text" placeholder="Amount">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Buy</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sell Coin</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Coin Type">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount</label>
                            <input type="text" class="form-control" id="text" placeholder="Amount">
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Sell</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Currency(USD)</th>
                        <th scope="col">Latest Rate</th>
                    </tr>
                </thead>
                <tbody id="buyTable">
                </tbody>
            </table>

            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Currency(USD)</th>
                        <th scope="col">Latest Rate</th>
                    </tr>
                </thead>
                <tbody id="sellTable">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var trHTML = "";
        for (var i = 0; i < 9; i++) {
            trHTML += '<tr><td>' + 'dummy' + '</td><td>' + 'dummy' + '</td></tr>';
        }
        $('#buyTable').append(trHTML);
        $('#sellTable').append(trHTML);
        setInterval(function () {
            var str = getCryptoIDs();
            $.ajax({
                url: "https://api.coingecko.com/api/v3/coins/markets",
                type: "GET", //send it through get method
                data: {
                    ids: str,
                    vs_currency: "usd",
                    order: "market_cap_desc",
                    price_change_percentage: "1h"
                },
                success: function (response) {
                    var trHTML = "";
                    for (x in response) {
                        //console.log(response[x].symbol +" "+response[x].current_price+" "+response[x].price_change_percentage_1h_in_currency);
                        //console.log(response[x]);
                        var change = response[x].price_change_percentage_1h_in_currency;
                        if (change != null)
                            change = change.toFixed(3);
                        else
                            change = 0;
                        if (change > 0) {
                            trHTML += '<tr><td>' + response[x].symbol.toUpperCase() +
                                '</td><td>' + response[x].current_price +
                                '</td> <td style="color: green">' + change + '</td></tr>';
                        } else if (change < 0) {
                            trHTML += '<tr><td>' + response[x].symbol.toUpperCase() +
                                '</td><td>' + response[x].current_price +
                                '</td> <td style="color: red">' + change + '</td></tr>';
                        } else {
                            trHTML += '<tr><td>' + response[x].symbol.toUpperCase() +
                                '</td><td>' + response[x].current_price +
                                '</td> <td>' + change + '</td></tr>';
                        }
                    }
                    $('#table-to-refresh').children('tr').remove();
                    $('#table-to-refresh').append(trHTML);
                },
                error: function (xhr) {
                    //Do Something to handle error
                    console.log(xhr);
                }
            });
        }, 1000);
    });

</script>
<script>
    function getCryptoIDs() {
        var coins = ['bitcoin', 'ethereum', 'litecoin', 'ripple', 'bitcoin-cash', 'eos', 'binancecoin', 'tether',
            'stellar', 'cardano', 'tron', 'huobi-token', 'monero', 'dash', 'iota', 'ontology', 'neo',
            'basic-attention-token', 'ethereum-classic', 'bitcoin-cash-sv'
        ];
        var coinsStr = "";
        for (x in coins) {
            coinsStr += (coins[x] + ',');
        }
        coinsStr = coinsStr.substring(0, coinsStr.length - 1);
        return coinsStr;
    }

</script>
<script type="text/javascript">
    window.onload = function () {
        var dps1 = [],
            dps2 = [];
        var stockChart = new CanvasJS.StockChart("chartContainer", {
            theme: "dark2",
            exportEnabled: true,
            title: {
                text: "Exchange Rate"
            },
            subtitles: [{
                text: "Bitcoin Price (in USD)"
            }],
            charts: [{
                axisX: {
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                axisY: {
                    prefix: "$"
                },
                data: [{
                    type: "candlestick",
                    yValueFormatString: "$#,###.##",
                    dataPoints: dps1
                }]
            }],
            navigator: {
                data: [{
                    dataPoints: dps2
                }],
                slider: {
                    minimum: new Date(2018, 04, 01),
                    maximum: new Date(2018, 06, 01)
                }
            }
        });
        $.getJSON("https://canvasjs.com/data/docs/btcusd2018.json", function (data) {
            for (var i = 0; i < data.length; i++) {
                dps1.push({
                    x: new Date(data[i].date),
                    y: [Number(data[i].open), Number(data[i].high), Number(data[i].low), Number(
                        data[i].close)]
                });
                dps2.push({
                    x: new Date(data[i].date),
                    y: Number(data[i].close)
                });
            }
            stockChart.render();
        });
    }

</script>
@endsection
