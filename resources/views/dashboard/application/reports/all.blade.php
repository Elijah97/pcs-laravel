<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DRD - Petty Cash System - Dashboard</title>
    <style type="text/css">
        /* table td,
        table th {
            border: 1px solid rgb(244, 244, 244);
        } */
        * {
            font-family: sans-serif !important;
            /* Change your font family */
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 12px;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #4e5c46;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #4e5c46;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        header {
            border-bottom: rgb(224, 224, 224) solid 2px;
        }

        .header {
            background: #4e5c46;
            padding: 5px;
            border-radius: 4px;
            color: #ffffff;
        }

        caption {
            font: bold 100% sans-serif;
            text-align: center;
            text-transform: uppercase;
            padding: 15px;
            margin-bottom: 10px;
        }

        caption h1 {
            text-align: center;
            text-decoration: underline
        }
    </style>

</head>

<body>


    <div class="container-fluid Main_Content pad32">
        <div class="row">

            <div class="col-12">
                <div class="col-12 mabo32 pad0">

                    <div class="col-12 M_Card_16">
                        <header>
                            <div class="header">
                                <h1>REPORT</h1>
                            </div>
                            <center>
                                <img alt="" style="margin-top: 20px"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}"
                                    width="100" height="100">
                                <h1 style="font-size: 14px">Ministry of Defence <br /><br />
                                    Defence Research and Development
                                </h1>
                            </center>
                        </header>
                        <table class="content-table" style="table-layout:fixed; width: 100%">
                            <caption>
                                <h1>APPLICATIONS REPORT</h1>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col" style="width:5%;">#</th>
                                    <th scope="col" style="width:10%;">Rank</th>
                                    <th scope="col">Names</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Application Title</th>
                                    <th scope="col" style="width:10%;">Department</th>
                                    <th scope="col">Date Applied</th>
                                    <th scope="col" style="width:5%;">Qty</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Reviewed By</th>
                                    <th scope="col">Approved By</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <span style="display: none">{{ $index = 1 }}</span>
                                <span style="display: none">{{ $total = 0 }}</span>
                                @foreach ($applications as $app)
                                    <span style="display: none">{{ $total = $total + $app->totalPrice }}</span>
                                    <tr>
                                        <td scope="row">{{ $index++ }}</td>
                                        <td>{{ $app->rank }}</td>
                                        <td>{{ $app->names }}</td>
                                        <td>{{ $app->phone }}</td>
                                        <td>{{ $app->title }}</td>
                                        <td>{{ $app->department }}</td>
                                        <td>{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                                        <td>{{ $app->qty }}</td>
                                        <td>{{ $app->totalPrice }} Rwf</td>
                                        <td>
                                            @if ($app->reviewerId == '')
                                                ---
                                                @else{{ $app->reviewerRank . ' ' . $app->reviewerName }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($app->approverId == '')
                                                ---
                                                @else{{ $app->approverRank . ' ' . $app->approverName }}
                                            @endif
                                        </td>
                                        @if ($app->reviewStatus == 0 && $app->approveStatus == 0)
                                            <td>Pending for review</td>
                                        @elseif($app->reviewStatus == 2)
                                            <td>Review revoked</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 0)
                                            <td>Pending for approve</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 1)
                                            <td style="color: #4ab658">Request approved</td>
                                        @elseif($app->reviewStatus == 1 && $app->approveStatus == 2)
                                            <td style="color: #cf5858">Request revoked</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h1 style="margin-top: 64px">
                            Total: {{ number_format($total) }} Rwf</h1>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/wow.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>
