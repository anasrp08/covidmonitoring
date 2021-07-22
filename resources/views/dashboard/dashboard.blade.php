@extends('layouts.app')

@section('title')
<title>Dashboard - Peruri Covid</title>
@endsection
<style>
    #mapkrw {
        height: 600px;

        /* width: 600px; */
    }

    #mapjkt {
        height: 600px;
        margin-bottom: 5rem;
        /* width: 600px; */
    }

    .custom .leaflet-popup-tip,
    .custom .leaflet-popup-content-wrapper {
        background: #033075;
        color: #fff;
    }

    .fontDetail {
        color: #fff;
        width: 18rem;
        font-style: bold;
        font-size: 13px;
    }

    td {
        white-space: nowrap;
    }

</style>

@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="clock"></i></div>
                        {{-- Dashboard Covid Case Peruri --}}
                    </h1>
                    {{-- <div class="page-header-subtitle">Summary Dashboard Covid Case Peruri</div> --}}
                    <div class="page-header-subtitle" id='tanggal'>

                        <span class="font-weight-900 text-warning" id='day'></span>
                        {{-- &middot; September 20, 2020 &middot; 12:16 PM --}}
                    </div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    {{-- <button class="btn btn-white btn-sm line-height-normal p-3" id="reportrange">
                    <i class="mr-2 text-primary" data-feather="calendar"></i>
                    <span></span>
                    <i class="ml-1" data-feather="chevron-down"></i>
                </button> --}}
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<style>


</style>
<div class="row">
    <div class="col-xxl-12 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-xxl-12">
                        <div class="text-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                            <h1 class="text-primary">Welcome Back!</h1>
                            <p class="text-gray-700 mb-0">Summary Dashboard Covid Case Peruri</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid"
                            src="{{ asset('/sb-admin-pro/dist/assets/img/freepik/statistics-pana.svg')}}"
                            style="max-width: 26rem;" /></div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.summary')


<!-- Example Charts for Dashboard Demo-->
@include('dashboard.chart_bar')
@endsection
@section('scripts')

<script src="{{ asset('/sb-admin-pro/dist/assets/demo/date-range-picker-demo.js')}}"></script>

<script>
    $(document).ready(function () {


        var mapKRW = L.map('mapkrw', {
            center: [-6.00, 107.00],
            zoom: 15
        }).setView([-6.3633402764649825, 107.30693018200354], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapKRW);

        var mapJKT = L.map('mapjkt', {
            center: [-6.00, 107.00],
            zoom: 20
        }).setView([-6.24096, 106.79959], 20);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapJKT);
        // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYW5hc3JwMDgiLCJhIjoiY2tyOTZna3cwNDY3NDMxbzZ2bnRvZ3ZzciJ9.3DkPyDPh4PWQmJObOzcgOg', {
        //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        //     maxZoom: 18,
        //     id: 'mapbox/streets-v11',
        //     tileSize: 512,
        //     zoomOffset: -1,
        //     accessToken: 'pk.eyJ1IjoiYW5hc3JwMDgiLCJhIjoiY2tyOTZna3cwNDY3NDMxbzZ2bnRvZ3ZzciJ9.3DkPyDPh4PWQmJObOzcgOg'
        // }).addTo(mapKRW);
        // $("a[href='#peruri_jakarta']").on('shown.bs.tab', function (e) { 
        //     mapJKT.invalidateSize();
        // });
        $("a[href='#activities2']").on('shown.bs.tab', function (e) {
            mapJKT.invalidateSize();
        });
        $("a[href='#peruri_krw']").on('shown.bs.tab', function (e) {
            mapKRW.invalidateSize();
        });


        // var marker = L.marker([-6.363310, 107.307274]).addTo(mapKRW);
        var circleSDM = [-6.36377, 107.30797];
        var gedWTP = [-6.36809, 107.30572]


        var latMako = [
            [
                [-6.36077, 107.3084],
                [-6.36102, 107.3084],
                [-6.36103, 107.30842],
                [-6.36112, 107.30842],
                [-6.36112, 107.30848],
                [-6.36076, 107.30848]
            ]
        ];
        var gedLiniA = [
            [
                [-6.36337, 107.30497],
                [-6.36151, 107.30596],
                [-6.36191, 107.30675],
                [-6.36376, 107.30574]
            ]
        ];


        var gedungUtilitas = [
            [
                [-6.36343, 107.30475],
                [-6.36396, 107.3057],
                [-6.36452, 107.30542],
                [-6.36411, 107.30477],
                [-6.36342, 107.30475]
            ]
        ];
        var gedungPengolahanLimbah = [
            [
                [-6.36422, 107.30476],
                [-6.36561, 107.30488],
                [-6.36462, 107.3054]
            ]
        ];

        var gedungLiniB = [
            [
                [-6.36706, 107.30395],
                [-6.36588, 107.3047],
                [-6.3662, 107.30545],
                [-6.36746, 107.30472]
            ]
        ];

        var gudangTengah = [
            [
                [-6.36738, 107.30409],
                [-6.36785, 107.30385],
                [-6.36811, 107.30434],
                [-6.36762, 107.30458]
            ]
        ];
        var gedungArsip = [
            [
                [-6.3687, 107.30479],
                [-6.36879, 107.30495],
                [-6.36918, 107.30474],
                [-6.36911, 107.30457]
            ]
        ];

        var gedungPengadaan = [
            [
                [-6.36802, 107.30343],
                [-6.36838, 107.30415],
                [-6.36879, 107.30397],
                [-6.36839, 107.30323]
            ]
        ];
        var gudangTasganu = [
            [
                [-6.37022, 107.3048],
                [-6.37033, 107.30502],
                [-6.37079, 107.3048],
                [-6.37069, 107.30458]
            ]
        ];
        var gedungLiniInternational = [
            [
                [-6.37002, 107.30439],
                [-6.37021, 107.30479],
                [-6.37068, 107.30453],
                [-6.37047, 107.30416]
            ]
        ];
        var gedungUgam = [
            [
                [-6.37102, 107.302],
                [-6.36964, 107.30295],
                [-6.36985, 107.30335],
                [-6.37134, 107.30258]
            ]
        ];
        var gedungCekai = [
            [
                [-6.37059, 107.30409],
                [-6.37133, 107.3056],
                [-6.37172, 107.3054],
                [-6.37093, 107.30388]
            ]
        ];
        var gedungTasganu = [
            [
                [-6.37111, 107.30389],
                [-6.37188, 107.30532],
                [-6.37258, 107.30494],
                [-6.37182, 107.30355]
            ]
        ];
        var gedungPusyantek = [
            [
                [-6.37247, 107.30291],
                [-6.37293, 107.30386],
                [-6.37338, 107.30367],
                [-6.37295, 107.30269]
            ]
        ];

        //jakarta
        var gedUtama = [
            [
                [-6.24047, 106.80003],
                [-6.24047, 106.80033],
                [-6.24118, 106.80032],
                [-6.24118, 106.79915],
                [-6.24107, 106.79914],
                [-6.24105, 106.80004]
            ]
        ];


        var gedExproduksi = [
            [
                [-6.24033, 106.80002],
                [-6.24104, 106.80003],
                [-6.24108, 106.79901],
                [-6.24034, 106.79899]
            ]
        ];
        var gedDepjul = [
            [
                [-6.24134, 106.80068],
                [-6.2415, 106.80069],
                [-6.24151, 106.80045],
                [-6.24134, 106.80044],
            ]
        ];

        var gedPelita = [
            [
                [-6.24145, 106.79991],
                [-6.24144, 106.80007],
                [-6.24178, 106.80007],
                [-6.24177, 106.79991]
            ]
        ];

        var gedAngkutan = [
            [
                [-6.24173, 106.80023],
                [-6.24174, 106.80043],
                [-6.24184, 106.80044],
                [-6.24183, 106.80023]
            ]
        ];
        var gedDepjul2 = [
            [
                [-6.24193, 106.79931],
                [-6.24193, 106.79967],
                [-6.24212, 106.79967],
                [-6.24211, 106.79931]
            ]
        ];
        var colorRed = '#b71c1c'
        var colorYellow = '#ffeb3b'
        var colorOrange = '#f57c00'
        var colorGreen = '#388e3c'
        var areaMako = setPolygonRadius(latMako, colorGreen, '', mapKRW, 'Gedung Mako & Damkar')
        var areaLiniA = setPolygonRadius(gedLiniA, colorGreen, '', mapKRW, 'Gedung LINI A')
        var areaUtilitas = setPolygonRadius(gedungUtilitas, colorGreen, '', mapKRW, 'Gedung Utilitas')
        var areaLimbah = setPolygonRadius(gedungPengolahanLimbah, colorGreen, '', mapKRW, 'Gedung Pengelolan Limbah')
        var areaLiniB = setPolygonRadius(gedungLiniB, colorGreen, '', mapKRW, 'Gedung LINI B')
        var areaGudTengah = setPolygonRadius(gudangTengah, colorGreen, '', mapKRW, 'Gudang Tengah')
        var areaArsip = setPolygonRadius(gedungArsip, colorGreen, '', mapKRW, 'Gedung Arsip')
        var areaPengadaan = setPolygonRadius(gedungPengadaan, colorGreen, '', mapKRW, 'Gedung Pengadaan')
        var areaGudangTasganu = setPolygonRadius(gudangTasganu, colorGreen, '', mapKRW, 'Gudang Tasganu')
        var areaLiniInternational = setPolygonRadius(gedungLiniInternational, colorGreen, '', mapKRW,
            'Gedung Lini International')
        var areaUgam = setPolygonRadius(gedungUgam, colorGreen, '', mapKRW, 'Gedung UGAM')
        var areaCekai = setPolygonRadius(gedungCekai, colorGreen, '', mapKRW, 'Gedung Cekai')
        var areatasganu = setPolygonRadius(gedungTasganu, colorGreen, '', mapKRW, 'Gedung Tasganu')
        var areaPusyantek = setPolygonRadius(gedungPusyantek, colorGreen, '', mapKRW, 'Gedung Pusyantek')
        var areaSDM = setCircleRadius(circleSDM, colorRed, 40, 'tes', mapKRW, 'Gedung SDM')
        var areaWTP = setCircleRadius(gedWTP, colorRed, 40, 'tes12', mapKRW, 'Gedung WTP')

        //jakarta
        var arrArea=[
            'Mako & Damkar',
            'Gedung SDM',
            'Gedung Lini A',
            'Gedung Utilitas',
            'Area Pengolahan Limbah',
            'Gedung Lini B',
            'Gedung WTP',
            'Gedung Arsip',
            'Gudang Tengah',
            'Gedung Pengadaan',
            'Gudang Tasganu',
            'Gedung Lini Internasional',
            'Gedung Cekai',
            'Gedung Tasganu',
            'Gedung Ugam',
            'Gedung Pusyantek',
            'Gedung Utama Palatehan',
            'Depjul',
            'Gedung Pelita',
            'Angkutan',
            'Depjul 2'
        ]


        
        function getDataMap() {
            var paramDataMap = {
                startDate: 'tes',


            }
            $.ajax({
                url: "{{route('data.map')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataMap,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    console.log(data)
                    var dataMap = data.dataMap  
                  
                //    var index = dataMap.map(function (img) { return img.gedung; }).indexOf('Angkutan');
                //    console.log(index); 
                    for (i = 0; i < dataMap.length; i++) {
                        switch (dataMap[i].gedung) {
                            case 'Depjul':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaDepjul = setPolygonRadius(gedDepjul, generateColor(dataMap[i].total), dataMap[i],
                                    mapJKT, 'Gedung Depjul')
                                break;
                            case 'Depjul 2':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaDepjul2 = setPolygonRadius(gedDepjul2, generateColor(dataMap[i].total), dataMap[
                                    i], mapJKT, 'Gedung Depjul 2')
                                break;
                            case 'Angkutan':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaAngkutan = setPolygonRadius(gedAngkutan, generateColor(dataMap[i].total), dataMap[
                                    i], mapJKT, 'Gedung Angkutan')
                                break;
                            case 'Gedung Pelita':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaPelita = setPolygonRadius(gedPelita, generateColor(dataMap[i].total), dataMap[i],
                                    mapJKT, 'Gedung Pelita')
                                break;
                            case 'Gedung Ex.Produksi':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaExproduksi = setPolygonRadius(gedExproduksi, generateColor(dataMap[i].total),
                                    dataMap[i], mapJKT, 'Gedung Ex.Produksi')
                                break;
                            case 'Gedung Utama Palatehan':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaUtama = setPolygonRadius(gedUtama, generateColor(dataMap[i].total), dataMap[i],
                                    mapJKT, 'Gedung Utama Palatehan')
                                break;
                                case 'Mako & Damkar':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaMako = setPolygonRadius(latMako, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Mako & Damkar')
                                break;
                                case 'Gedung SDM':
                                var colorArea = generateColor(dataMap[i].total)
                                
                                var areaSDM = setCircleRadius(circleSDM, generateColor(dataMap[i].total), 40,  dataMap[i], mapKRW, 'Gedung SDM')
                                break;
                                case 'Gedung Lini A':
                                console.log(dataMap[i].total >= 10)
                                var colorArea = generateColor(dataMap[i].total)
                               
                                var areaLINIA = setPolygonRadius(gedLiniA, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Lini A')
                                break;
                                case 'Gedung Utilitas':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaUtilitas = setPolygonRadius(gedungUtilitas, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Utilitas')
                                break;
                                case 'Area Pengolahan Limbah':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaLimbah = setPolygonRadius(gedungPengolahanLimbah, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Area Pengolahan Limbah')
                                break;
                                case 'Gedung Lini B':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaLINIB = setPolygonRadius(gedungLiniB, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Lini B')
                                break;
                                case 'Gedung WTP':
                                var colorArea = generateColor(dataMap[i].total)
                             
                                var areaWTP = setCircleRadius(gedWTP, generateColor(dataMap[i].total), 40, dataMap[i], mapKRW, 'Gedung WTP')

                                break;
                                case 'Gedung Arsip':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaARSIP = setPolygonRadius(gedungArsip, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Arsip')
                                break;
                                case 'Gudang Tengah':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaTengah = setPolygonRadius(gudangTengah, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gudang Tengah')
                                break;
                                case 'Gedung Pengadaan':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaPengadaan= setPolygonRadius(gedungPengadaan, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Pengadaan')
                                break;
                                case 'Gudang Tasganu':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaGudTasganu = setPolygonRadius(gudangTasganu, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gudang Tasganu')
                                break;
                                case 'Gedung Lini Internasional':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaInternasional = setPolygonRadius(gedungLiniInternational, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Lini Internasional')
                                break;
                                case 'Gedung Cekai':
                                
                                var colorArea = generateColor(dataMap[i].total)
                                console.log(dataMap[i].total >= 10)
                                var areaCekai = setPolygonRadius(gedungCekai, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Cekai')
                                break;
                                case 'Gedung Tasganu':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaTasganu = setPolygonRadius(gedungTasganu, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW, 'Gedung Tasganu')
                                break;
                                case  'Gedung Ugam':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaUgam = setPolygonRadius(gedungUgam, generateColor(dataMap[i].total), dataMap[i],
                                mapKRW,  'Gedung Ugam')
                                break;
                                case  'Gedung Pusyantek':
                                var colorArea = generateColor(dataMap[i].total)
                                var areaPusyantek= setPolygonRadius(gedungPusyantek, generateColor(dataMap[i].total), dataMap[i],
                                    mapKRW,  'Gedung Pusyantek')
                                break;
                                 



                            default:
                                break;
                        }
 
                    } 
                }
            })
        }

        function generateColor(jumlahkasus) {
 
            var colorRed = '#b71c1c'
            var colorYellow = '#ffeb3b'
            var colorOrange = '#f57c00'
            var colorGreen = '#388e3c'
            var jumlah = parseInt(jumlahkasus)
            var color=null

            if (jumlah == 0) {
                 color=colorGreen
            }else   if (jumlah >= 1 && jumlah<= 5) {
                 color=colorYellow
            }else  if (jumlah >= 5 && jumlah<=10) {
                 color=colorOrange
            }else if (jumlah >= 10) {
                color=colorRed
            }
            return color

        }

        function setCircleRadius(circle, color, radius, dataPopUp, map, tooltip) {
            var circle = L.circle(circle, {
                color: color,
                fillColor: color,
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);

            // specify popup options 
            var dataLantai1 = '-'
            var dataLantai2 = '-'
            var dataLantai3 = '-'
            var dataLantaiGround = '-'
            var customPopup =
                "<b style='font-size: 15px;'>" + tooltip + ": " + dataPopUp.total + " </b><br/>" +
                "<table  width: 100%;>" +
                "<tbody style='font-color:#fff;'>" +

                "<tr>" +
                "<td class='fontDetail'><b>Lt. Ground</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.ground + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 1</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_1 + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 2</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_2 + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 3</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_3 + "</td>" +
                "</tbody>" +
                "</table>";

            // specify popup options 
            var customOptions = {
                'maxWidth': '500',
                'width': '500',
                'className': 'custom'
            }


            circle.bindPopup(customPopup, customOptions)
            circle.bindTooltip(tooltip).openTooltip()
        }
        // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        function setPolygonRadius(LongLat, color, dataPopUp, map, tooltip) {
            var polygon = L.polygon(
                LongLat, {
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.5
                }).addTo(map);
            var customOptions = {
                'maxWidth': '400',
                'width': '300',
                'className': 'custom'
            }
            var dataLantai1 = '-'
            var dataLantai2 = '-'
            var dataLantai3 = '-'
            var dataLantaiGround = '-'

            var customPopup =
                "<b style='font-size: 15px;'>" + tooltip + ": " + dataPopUp.total + " </b><br/>" +
                "<table  width: 100%;>" +
                "<tbody style='font-color:#fff;'>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. Ground</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.ground + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 1</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_1 + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 2</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_2 + "</td>" +
                "</tr>" +
                "<tr>" +
                "<td class='fontDetail'><b>Lt. 3</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.lantai_3 + "</td>" +
                    "</tr>" +
                    "<tr>" +
                "<td class='fontDetail'><b>Pos 1</td>" +
                "<td class='fontDetail'><b>: " + dataPopUp.pos_1 + "</td>" +
                    "</tr>" +
                "</tbody>" +
                "</table>";
            polygon.bindPopup(customPopup, customOptions);
            polygon.bindTooltip(tooltip).openTooltip()

        }


        // for ( var i=0; i < markers.length; ++i ) 
        // {
        //    L.marker( [markers[i].lat, markers[i].lng] )
        //       .bindPopup( '<a href="' + markers[i].url + '" target="_blank" rel="noopener">' + markers[i].name + '</a>' )
        //       .addTo( map );
        // }

        moment.locale('id');
        $('#day').text(moment().format('LLLL'))
        //     $('#mode').bootstrapToggle({
        //         width: '100%',
        // });
        var valChecked = true
        var startDate
        var endDate
        $('#mode').change(function () {
            valChecked = $(this).prop('checked')
            getGrafik(startDate, endDate);
            getPersebaran(startDate, endDate);
            //   alert($(this).prop('checked'))
        })
        var ctxAkumulasi = areaChart.comp(document.getElementById("akumulasi"), 'Akumulasi Covid Case')
        var ctxCaseByDate = areaChart.comp(document.getElementById("casebydate"), 'Case By Day Covid')

        var ctxbarchart = barChart.comp(document.getElementById("bar_overview"), 'Perkembangan Kasus Aktif')
        ctxbarchart.height = 500
        var ctxSembuh = barChart.comp(document.getElementById("sembuh_overview"), 'Perkembangan Kesembuhan')
        ctxSembuh.height = 500


        var ctxarea_kerja = barChart.comp(document.getElementById("area_kerja"), 'Kasus Aktif Per Area Kerja')
        ctxarea_kerja.height = 300
        var ctxunit_kerja = barChart.comp(document.getElementById("unit_kerja"), 'Kasus Aktif Per Unit Kerja')
        ctxunit_kerja.height = 400



        var ctxDirektorat = pieChart.comp(document.getElementById("pie_direktorat"),
            'Persebaran Kasus Aktif Direktorat ', 6, '#pie_direktorat')
        var ctxDivisi = pieChart.comp(document.getElementById("pie_divisi"), 'Persebaran Kasus Aktif Divisi', 7,
            '#pie_divisi')
        var ctxDomisili = pieChart.comp(document.getElementById("pie_domisili"),
            'Persebaran Tempat Perawatan Kasus Aktif',
            8, '#pie_domisili')
        var ctxLokIsoman = pieChart.comp(document.getElementById("pie_lokasi_isolasi"),
            'Persebaran Isolasi Kasus Aktif',
            9, '#pie_lokasi_isolasi')
        var ctxKlaster = pieChart.comp(document.getElementById("pie_klaster"), 'Persebaran Klaster Kasus Aktif',
            10, '#pie_klaster')
        var ctxStatusVaksin = pieChart.comp(document.getElementById("pie_statusvaksin"),
            'Persebaran Status Vaksin Kasus Aktif', 11, '#pie_statusvaksin')
        var ctxGejala = pieChart.comp(document.getElementById("pie_gejala"),
            'Tingkat Gejala Kasus Aktif', 12, '#pie_gejala')




        // function updateData(chart, labels, data,color) {
        //     chart.data.labels = labels
        //     chart.data.datasets[0].backgroundColor = color
        //     chart.data.datasets[0].data = data
        //     chart.update();
        // }
        $('#chartrange').on('apply.daterangepicker', function (ev, picker) {
            startDate = picker.startDate.format('YYYY-MM-DD')
            endDate = picker.endDate.format('YYYY-MM-DD')


            getGrafik(startDate, endDate);
            getAreaKerjaAktif(startDate, endDate)
            getPersebaran(startDate, endDate);
        });

        $('#datesembuh').on('apply.daterangepicker', function (ev, picker) {
            startDate = picker.startDate.format('YYYY-MM-DD')
            endDate = picker.endDate.format('YYYY-MM-DD')
            getGrafikKesembuhan(startDate, endDate)
        });
        // Get the chart's base64 image string

        $('#download_bar').on('click', function () {
            downloadChart(ctxbarchart, 'bar_kasus_aktif.png')
        });
        $('#download_dir').on('click', function () {
            downloadChart(ctxDirektorat, 'pie_direktorat_kasus_aktif.png')
        });
        $('#download_div').on('click', function () {
            downloadChart(ctxDivisi, 'pie_divisi_kasus_aktif.png')
        });
        $('#download_domisili').on('click', function () {
            downloadChart(ctxDomisili, 'pie_kota_kasus_aktif.png')
        });
        $('#download_isolasi').on('click', function () {
            downloadChart(ctxLokIsoman, 'pie_perawatan_kasus_aktif.png')
        });
        $('#download_klaster').on('click', function () {
            downloadChart(ctxKlaster, 'pie_kalster_kasus_aktif.png')
        });
        $('#download_vaksin').on('click', function () {
            downloadChart(ctxStatusVaksin, 'pie_vaksin_kasus_aktif.png')
        });
        $('#download_gejala').on('click', function () {
            downloadChart(ctxGejala, 'pie_gejala_kasus_aktif.png')
        });
        $('#download_gedung').on('click', function () {
            downloadChart(ctxarea_kerja, 'bar_gedung_kasus_aktif.png')
        });
        $('#download_unit').on('click', function () {
            downloadChart(ctxunit_kerja, 'bar_unit_kasus_aktif.png')
        });





        var canvas = document.getElementById("pie_direktorat");
        canvas.onclick = function (evt) {
            var activePoints = ctxDirektorat.getElementsAtEvent(evt);
            if (activePoints[0]) {
                var chartData = activePoints[0]['_chart'].config.data;
                var idx = activePoints[0]['_index'];
                console.log(chartData)
                var direktorat = chartData.labels[idx];
                var value = chartData.datasets[0].data[idx];

                // var url = "http://example.com/?label=" + label + "&value=" + value;

                getDivisi(startDate, endDate, direktorat)
            }
        };

        var canvas1 = document.getElementById("pie_domisili");
        canvas1.onclick = function (evt) {
            var activePoints = ctxDomisili.getElementsAtEvent(evt);
            if (activePoints[0]) {
                var chartData = activePoints[0]['_chart'].config.data;
                var idx = activePoints[0]['_index'];
                console.log(chartData)
                var domisili = chartData.labels[idx];
                var value = chartData.datasets[0].data[idx];

                // var url = "http://example.com/?label=" + label + "&value=" + value;

                getPersebaranPerawatan(startDate, endDate, domisili)
            }
        };

        var canvas3 = document.getElementById("area_kerja");
        canvas3.onclick = function (evt) {
            var activePoints = ctxarea_kerja.getElementsAtEvent(evt);
            if (activePoints[0]) {
                var chartData = activePoints[0]['_chart'].config.data;
                var idx = activePoints[0]['_index'];

                var gedung = chartData.labels[idx];
                var value = chartData.datasets[0].data[idx];
                console.log(gedung)
                // var url = "http://example.com/?label=" + label + "&value=" + value;

                getUnitKerjaAktif(startDate, endDate, gedung)
            }
        };


        getDatabanner()
        getGrafikSummary()
        getDataMap()

        function downloadChart(ctx, filename) {
            var a = document.createElement('a');
            a.href = ctx.toBase64Image();
            a.download = filename;
            a.click();
        }

        function getDatabanner() {
            var paramDataBanner = {
                date: '-'

            }
            $.ajax({
                url: "{{route('data.banner')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataBanner,
                contentType: false,
                processData: false,
                success: function (data) {

                    $('#terkonfirmasi').text(data.dataTerkonfirmasi);
                    $('#aktif').text(data.dataKasusAktif);
                    $('#sembuh').text(data.dataSembuh);
                    $('#meninggal').text(data.dataMeninggal);
                }
            })
        }

        function getGrafik(startDate, endDate) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                // mode:valChecked

            }
            $.ajax({
                url: "{{route('data.grafik_bar')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    var dataValues = data.dataValues
                    var dataKeys = data.dataKeys
                    var maxValue = data.maxValue
                    barChart.updateData(ctxbarchart, dataValues, dataValues, dataKeys, maxValue)
                }
            })
        }

        function getGrafikKesembuhan(startDate, endDate) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                // mode:valChecked

            }
            $.ajax({
                url: "{{route('data.kesembuhan')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    var dataValues = data.dataValues
                    var dataKeys = data.dataKeys
                    var maxValue = data.maxValue
                    barChart.updateData(ctxSembuh, dataValues, dataValues, dataKeys, maxValue)
                }
            })
        }


        function getAreaKerjaAktif(startDate, endDate) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                // mode:valChecked

            }
            $.ajax({
                url: "{{route('data.areakerja_aktif')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    var dataValues = data.dataValues
                    var dataKeys = data.dataKeys
                    var maxValue = data.maxValue
                    var bars = ctxarea_kerja.data.datasets[1].data;



                    barChart.updateDataMaxColor(ctxarea_kerja, dataValues, dataValues, dataKeys,
                        maxValue)
                    var dataset = ctxarea_kerja.data.datasets[1];
                    for (var i = 0; i < dataset.data.length; i++) {
                        if (dataset.data[i] == maxValue) {
                            console.log(dataset)
                            // chart.data.datasets[1].backgroundColor[2] 
                            dataset.backgroundColor[i] = "#F44336";
                        } else {
                            dataset.backgroundColor[i] = "rgba(0, 97, 242, 1)";

                        }
                    }
                    ctxarea_kerja.update();

                }
            })
        }

        function getUnitKerjaAktif(startDate, endDate, gedung) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                gedung: gedung

            }
            $.ajax({
                url: "{{route('data.unitkerja_aktif')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    var dataValues = data.dataValues
                    var dataKeys = data.dataKeys
                    var maxValue = data.maxValue
                    barChart.updateDataMaxColor(ctxunit_kerja, dataValues, dataValues, dataKeys,
                        maxValue)
                    var dataset = ctxunit_kerja.data.datasets[1];
                    for (var i = 0; i < dataset.data.length; i++) {
                        if (dataset.data[i] == maxValue) {
                            console.log(dataset)
                            // chart.data.datasets[1].backgroundColor[2] 
                            dataset.backgroundColor[i] = "#F44336";
                        } else {
                            dataset.backgroundColor[i] = "rgba(0, 97, 242, 1)";

                        }
                    }
                    ctxunit_kerja.update();
                }
            })
        }



        function getGrafikSummary() {
            var paramDataGrafik = {
                mode: '-',
                // endDate: endDate,
                // mode:valChecked

            }
            $.ajax({
                url: "{{route('data.summary')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    var dataAkumulasi = data.dataAkumulasi
                    var dataCaseByDate = data.dataCaseByDate
                    var dataKeys = data.dataKeys
                    var maxValuesByDate = data.maxValuesByDate
                    var maxValuesAkumulasi = data.maxValuesAkumulasi
                    areaChart.updateData(ctxAkumulasi, dataAkumulasi, dataKeys, maxValuesAkumulasi,
                        ["#ff5722"])
                    areaChart.updateData(ctxCaseByDate, dataCaseByDate, dataKeys, maxValuesByDate, [
                        "#4CAF50"
                    ])

                }
            })
        }


        function getDivisi(startDate, endDate, direktorat) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                direktorat: direktorat

            }
            $.ajax({
                url: "{{route('data.divisi')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    console.log(data)
                    pieChart.updateData(ctxDivisi, data.keyDivisi, data.valuesDivisi, data
                        .colorDivisi)


                }
            })
        }

        function getPersebaranPerawatan(startDate, endDate, domisili) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                domisili: domisili

            }
            $.ajax({
                url: "{{route('data.domisili')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    console.log(data)

                    pieChart.updateData(ctxLokIsoman, data.keyTmptPerawatan, data
                        .valuesTmptPerawatan, data.colorTmptPerawatan)



                }
            })
        }

        function getPersebaran(startDate, endDate) {
            var paramDataGrafik = {
                startDate: startDate,
                endDate: endDate,
                // mode:valChecked

            }
            $.ajax({
                url: "{{route('data.persebaran')}}",

                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paramDataGrafik,
                // contentType: false,
                // processData: false, 
                success: function (data) {
                    console.log(data)

                    pieChart.updateData(ctxDirektorat, data.keyDirektorat, data.valuesDirektorat,
                        data.colorDirektorat)

                    pieChart.updateData(ctxDomisili, data.keyIsolasi, data.valuesIsolasi, data
                        .colorIsolasi)
                    // pieChart.updateData(ctxLokIsoman, data.keyTmptPerawatan, data
                    //     .valuesTmptPerawatan, data.colorTmptPerawatan)
                    pieChart.updateData(ctxKlaster, data.keyKlaster, data.valuesKlaster, data
                        .colorKlaster)
                    pieChart.updateData(ctxStatusVaksin, data.keyVaksin, data.valuesVaksin, data
                        .colorVaksin)
                    pieChart.updateData(ctxGejala, data.keyGejala, data.valuesGejala, data
                        .colorGejala)




                }
            })
        }

    })

</script>
@endsection

{{-- var bottleCanvas = document.getElementById('pie_direktorat');
var designCanvas = document.getElementById('pie_divisi');
var canvas = document.getElementById('canvas');

var bottleContext = canvas.getContext('2d');
bottleContext.drawImage(designCanvas, 0, 0);
bottleContext.drawImage(bottleCanvas, 0, 100);

var dataURL = bottleCanvas.toDataURL("image/png");
var link = document.createElement('a');
link.download = "bottle-design.png";
link.href = bottleCanvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
link.click(); --}}
