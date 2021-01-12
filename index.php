<?php
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Chart</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

</head>

<body>
    <div class="container-fluid">
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
                    <!-- <div id="chartContainer" style="height: 550px; width: 100%;"></div> -->
                    <!-- <div id="chartdiv" style="height: 550px; width: 100%; color: black;"></div> -->
                    <div id="controls" style="width: 100%; overflow: hidden;">
                        <div style="float: left; margin-left: 15px;">
                            From: <input type="text" id="fromfield" class="amcharts-input" />
                            To: <input type="text" id="tofield" class="amcharts-input" />
                        </div>
                        <div style="float: right; margin-right: 15px;">
                            <button id="b1m" class="amcharts-input">1m</button>
                            <button id="b3m" class="amcharts-input">3m</button>
                            <button id="b6m" class="amcharts-input">6m</button>
                            <button id="b1y" class="amcharts-input">1y</button>
                            <button id="bytd" class="amcharts-input">YTD</button>
                            <button id="bmax" class="amcharts-input">MAX</button>
                        </div>
                    </div>
                    <div id="chartdiv" style="width: 100%;height: 500px;max-width: 100%;"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Buy Coin</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Coin Type">
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
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Coin Type">
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
        <script src="exchange_rate_api.js"></script>
        <script src="custom_1.js"></script>
    </div>
</body>

</html>