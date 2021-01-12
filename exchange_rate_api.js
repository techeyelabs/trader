$(document).ready(function () {
    $.ajax({
        url: "https://api.coinpaprika.com/v1/coins/btc-bitcoin/ohlcv/historical/",
        type: "GET", //send it through get method
        data: {
            start: "2020-01-09",
            end: "2021-01-07",
            limit: 365
        },
        success: function (response) {
            viewData(response);
        },
        error: function (xhr) {
            //Do Something to handle error
            console.log(xhr);
        }
    });
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
                    var change = response[x]
                        .price_change_percentage_1h_in_currency;
                    if (change != null)
                        change = change.toFixed(3);
                    else
                        change = 0;
                    if (change > 0) {
                        trHTML += '<tr><td>' + response[x].symbol
                            .toUpperCase() +
                            '</td><td>' + response[x].current_price +
                            '</td> <td style="color: green">' + change +
                            '</td></tr>';
                    } else if (change < 0) {
                        trHTML += '<tr><td>' + response[x].symbol
                            .toUpperCase() +
                            '</td><td>' + response[x].current_price +
                            '</td> <td style="color: red">' + change +
                            '</td></tr>';
                    } else {
                        trHTML += '<tr><td>' + response[x].symbol
                            .toUpperCase() +
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
    setInterval(function () {
        $.ajax({
            url: "https://api.coinpaprika.com/v1/coins/btc-bitcoin/ohlcv/historical/",
            type: "GET", //send it through get method
            data: {
                start: "2020-01-09",
                end: "2021-01-07",
                limit: 365
            },
            success: function (response) {
                viewData(response);
            },
            error: function (xhr) {
                //Do Something to handle error
                console.log(xhr);
            }
        });
    }, 43200000);
    // function viewResponse(response){
    //       console.log(response);
    // }
    function getCryptoIDs() {
        var coins = ['bitcoin', 'ethereum', 'litecoin', 'ripple', 'bitcoin-cash', 'eos',
            'binancecoin',
            'tether',
            'stellar', 'cardano', 'tron', 'huobi-token', 'monero', 'dash', 'iota', 'ontology',
            'neo',
            'basic-attention-token', 'ethereum-classic', 'bitcoin-cash-sv'
        ];
        var coinsStr = "";
        for (x in coins) {
            coinsStr += (coins[x] + ',');
        }
        coinsStr = coinsStr.substring(0, coinsStr.length - 1);
        return coinsStr;
    }
});