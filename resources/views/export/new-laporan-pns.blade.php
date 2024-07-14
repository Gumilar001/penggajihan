<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <meta name="author" content="Fadhlan Minallah" />
    <style type="text/css">
        html {
            font-family: Calibri, Arial, Helvetica, sans-serif;
            font-size: 11pt;
            background-color: white
        }

        a.comment-indicator:hover+div.comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
            padding: 0.5em
        }

        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.5em;
            height: 0.5em
        }

        div.comment {
            display: none
        }

        table {
            border-collapse: collapse;
            page-break-after: always
        }

        .gridlines th {
            border: 1px dotted black
        }

        .b {
            text-align: center
        }

        .e {
            text-align: center
        }

        .f {
            text-align: right
        }

        .inlineStr {
            text-align: left
        }

        .n {
            text-align: right
        }

        .s {
            text-align: left
        }

        td.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style1 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style1 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style2 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style2 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style4 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style4 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style6 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style6 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style7 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style7 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style8 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style8 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style9 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style9 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #009999
        }

        th.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #009999
        }

        td.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #009999
        }

        th.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #009999
        }

        td.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        th.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        td.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        th.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        td.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        th.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #E2EEDA
        }

        td.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        th.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        td.style16 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        th.style16 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        td.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        th.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFCC
        }

        td.style18 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        th.style18 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        td.style19 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        th.style19 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        td.style20 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        th.style20 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 2px solid #000000 !important;
            border-top: 2px solid #000000 !important;
            border-left: 2px solid #000000 !important;
            border-right: 2px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFF00
        }

        td.style21 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: white
        }

        th.style21 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: white
        }

        td.style22 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFFF
        }

        th.style22 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: #FFFFFF
        }

        td.style23 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: white
        }

        th.style23 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 12pt;
            background-color: white
        }

        table.sheet0 col.col0 {
            width: 23.72222195pt
        }

        table.sheet0 col.col1 {
            width: 143.68888724pt
        }

        table.sheet0 col.col2 {
            width: 80.65555463pt
        }

        table.sheet0 col.col3 {
            width: 80.65555463pt
        }

        table.sheet0 col.col4 {
            width: 143.01110947pt
        }

        table.sheet0 col.col5 {
            width: 39.98888843pt
        }

        table.sheet0 col.col6 {
            width: 288.05555225pt
        }

        table.sheet0 col.col7 {
            width: 185.71110898pt
        }

        table.sheet0 col.col8 {
            width: 179.61110905pt
        }

        table.sheet0 col.col9 {
            width: 91.49999895pt
        }

        table.sheet0 col.col10 {
            width: 31.85555519pt
        }

        table.sheet0 col.col11 {
            width: 42.02222174pt
        }

        table.sheet0 col.col12 {
            width: 69.13333254pt
        }

        table.sheet0 col.col13 {
            width: 79.29999909pt
        }

        table.sheet0 col.col14 {
            width: 81.3333324pt
        }

        table.sheet0 col.col15 {
            width: 89.46666564pt
        }

        table.sheet0 col.col16 {
            width: 56.93333268pt
        }

        table.sheet0 col.col17 {
            width: 65.74444369pt
        }

        table.sheet0 col.col18 {
            width: 138.26666508pt
        }

        table.sheet0 col.col19 {
            width: 184.35555344pt
        }

        table.sheet0 col.col20 {
            width: 80.65555463pt
        }

        table.sheet0 col.col21 {
            width: 75.23333247pt
        }

        table.sheet0 col.col22 {
            width: 99.63333219pt
        }

        table.sheet0 col.col23 {
            width: 85.39999902pt
        }

        table.sheet0 col.col24 {
            width: 99.63333219pt
        }

        table.sheet0 col.col25 {
            width: 111.15555428pt
        }

        table.sheet0 col.col26 {
            width: 97.59999888pt
        }

        table.sheet0 col.col27 {
            width: 94.8888878pt
        }

        table.sheet0 col.col28 {
            width: 118.61110975pt
        }

        table.sheet0 col.col29 {
            width: 122.67777637pt
        }

        table.sheet0 col.col30 {
            width: 94.8888878pt
        }

        table.sheet0 col.col31 {
            width: 94.21111003pt
        }

        table.sheet0 col.col32 {
            width: 43.37777728pt
        }

        table.sheet0 col.col33 {
            width: 43.37777728pt
        }

        table.sheet0 col.col34 {
            width: 43.37777728pt
        }

        table.sheet0 col.col35 {
            width: 43.37777728pt
        }

        table.sheet0 col.col36 {
            width: 43.37777728pt
        }

        table.sheet0 col.col37 {
            width: 43.37777728pt
        }

        table.sheet0 col.col38 {
            width: 43.37777728pt
        }

        table.sheet0 col.col39 {
            width: 43.37777728pt
        }

        table.sheet0 col.col40 {
            width: 43.37777728pt
        }

        table.sheet0 col.col41 {
            width: 43.37777728pt
        }

        table.sheet0 col.col42 {
            width: 43.37777728pt
        }

        table.sheet0 col.col43 {
            width: 43.37777728pt
        }

        table.sheet0 col.col44 {
            width: 43.37777728pt
        }

        table.sheet0 col.col45 {
            width: 43.37777728pt
        }

        table.sheet0 col.col46 {
            width: 43.37777728pt
        }

        table.sheet0 col.col47 {
            width: 43.37777728pt
        }

        table.sheet0 col.col48 {
            width: 43.37777728pt
        }

        table.sheet0 col.col49 {
            width: 43.37777728pt
        }

        table.sheet0 col.col50 {
            width: 43.37777728pt
        }

        table.sheet0 col.col51 {
            width: 43.37777728pt
        }

        table.sheet0 col.col52 {
            width: 43.37777728pt
        }

        table.sheet0 col.col53 {
            width: 43.37777728pt
        }

        table.sheet0 col.col54 {
            width: 43.37777728pt
        }

        table.sheet0 tr {
            height: 15pt
        }

        table.sheet0 tr.row1 {
            height: 15pt
        }

        table.sheet0 tr.row2 {
            height: 47.4pt
        }

        td {
            padding: 0 1rem;
        }

        .row2 td {
            white-space: nowrap;
        }

        .wrap {
            white-space: normal !important;
        }
    </style>
</head>

<body>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <col class="col18">
        <col class="col19">
        <col class="col20">
        <col class="col21">
        <col class="col22">
        <col class="col23">
        <col class="col24">
        <col class="col25">
        <col class="col26">
        <col class="col27">
        <col class="col28">
        <col class="col29">
        <col class="col30">
        <col class="col31">
        <col class="col32">
        <col class="col33">
        <col class="col34">
        <col class="col35">
        <col class="col36">
        <col class="col37">
        <col class="col38">
        <col class="col39">
        <col class="col40">
        <col class="col41">
        <col class="col42">
        <col class="col43">
        <col class="col44">
        <col class="col45">
        <col class="col46">
        <col class="col47">
        <col class="col48">
        <col class="col49">
        <col class="col50">
        <col class="col51">
        <col class="col52">
        <col class="col53">
        <col class="col54">
        <tbody>
            <tr class="row0">
                <td class="column0 style1 s style2 header" colspan="13">
                    Data Laporan Penggajihan PNS
                </td>
            </tr>
            <tr class="row0">
                <td class="column0 style1 s style2 header" colspan="13">Tanggal : {{$dateNow}}</td>
            </tr>
            <tr class="row0">
                <td class="column0">&nbsp;</td>
                <td class="column1">&nbsp;</td>
                <td class="column2">&nbsp;</td>
                <td class="column3">&nbsp;</td>
                <td class="column4">&nbsp;</td>
                <td class="column5">&nbsp;</td>
                <td class="column6">&nbsp;</td>
                <td class="column7">&nbsp;</td>
                <td class="column8">&nbsp;</td>
                <td class="column9">&nbsp;</td>
                <td class="column10">&nbsp;</td>
                <td class="column11">&nbsp;</td>
                <td class="column12">&nbsp;</td>
                <td class="column13">&nbsp;</td>
                <td class="column14">&nbsp;</td>
                <td class="column15">&nbsp;</td>
                <td class="column16">&nbsp;</td>
                <td class="column17">&nbsp;</td>
                <td class="column18">&nbsp;</td>
                <td class="column19">&nbsp;</td>
                <td class="column20">&nbsp;</td>
                <td class="column21">&nbsp;</td>
                <td class="column22">&nbsp;</td>
                <td class="column23">&nbsp;</td>
                <td class="column24">&nbsp;</td>
                <td class="column25">&nbsp;</td>
                <td class="column26">&nbsp;</td>
                <td class="column27">&nbsp;</td>
                <td class="column28">&nbsp;</td>
                <td class="column29">&nbsp;</td>
                <td class="column30">&nbsp;</td>
            </tr>
            <tr class="row1">
                <td class="column0">&nbsp;</td>
                <td class="column1">&nbsp;</td>
                <td class="column2">&nbsp;</td>
                <td class="column3">&nbsp;</td>
                <td class="column4">&nbsp;</td>
                <td class="column5">&nbsp;</td>
                <td class="column6">&nbsp;</td>
                <td class="column7">&nbsp;</td>
                <td class="column8">&nbsp;</td>
                <td class="column9">&nbsp;</td>
                <td class="column10">&nbsp;</td>
                <td class="column11">&nbsp;</td>
                <td class="column12">&nbsp;</td>
                <td class="column13">&nbsp;</td>
                <td class="column14">&nbsp;</td>
                <td class="column15">&nbsp;</td>
                <td class="column16">&nbsp;</td>
                <td class="column17">&nbsp;</td>
                <td class="column18">&nbsp;</td>
                <td class="column19">&nbsp;</td>
                <td class="column20">&nbsp;</td>
                <td class="column21">&nbsp;</td>
                <td class="column22">&nbsp;</td>
                <td class="column23">&nbsp;</td>
                <td class="column24">&nbsp;</td>
                <td class="column25">&nbsp;</td>
                <td class="column26">&nbsp;</td>
                <td class="column27">&nbsp;</td>
                <td class="column28">&nbsp;</td>
                <td class="column29">&nbsp;</td>
                <td class="column30">&nbsp;</td>
            </tr>
            <tr class="row2">
                <td class="column0 style10 s">NO</td>
                <td class="column6 style10 s">NAMA PNS</td>
                <td class="column3 style10 s">TUNJANGAN SUAMI / ISTRI</td>
                <td class="column3 style10 s">TUNJANGAN ANAK</td>
                <td class="column1 style10 s">TUNJANGAN UMUM</td>
                <td class="column4 style10 s">TUNJANGAN BERAS</td>
                <td class="column8 style10 s">TUNJANGAN JABATAN</td>
                <td class="column9 style11 s">PEMBULATAN</td>
                <td class="column11 style12 s">PENGHASILAN KOTOR</td>
                <td class="column12 style13 s wrap">POTONGAN PENSIUNAN</td>
                <td class="column13 style14 s">POTONGAN BPJS</td>
                <td class="column14 style14 s">POTONGAN THT</td>
                <td class="column15 style14 s">POTONGAN SEWA RUMAH</td>
                <td class="column17 style16 s wrap">POTONGAN PAJAK PENGHASILAN</td>
                <td class="column18 style16 s">JUMLAH POTONGAN</td>
                <td class="column21 style16 s wrap">PENGHASILAN BERSIH</td>
            </tr>
            @foreach ($data as $key => $item)
                <tr class="row{{$key}}">
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$item['personel_id']['nama_pns']}}
                    </td>
                    <td>
                        {{$item['t_keluarga']}}
                    </td>
                    <td>
                        {{$item['t_anak']}}
                    </td>
                    <td>
                        {{$item['t_umum']}}
                    </td>
                    <td>
                        {{$item['t_beras']}}
                    </td>
                    <td>
                        {{$item['t_jabatan']}}
                    </td>
                    <td>
                        {{$item['pot_pembulatan']}}
                    </td>
                    <td>
                        {{$item['penghasilan_kotor']}}
                    </td>
                    <td>
                        {{$item['pot_pensiunan']}}
                    </td>
                    <td>
                        {{$item['pot_bpjs']}}
                    </td>
                    <td>
                        {{$item['pot_tht']}}
                    </td>
                    <td>
                        {{$item['pot_sewa_rmh']}}
                    </td>
                    <td>
                        {{$item['pot_pajak_penghasilan']}}
                    </td>
                    <td>
                        {{$item['jumlah_potongan']}}
                    </td>
                    <td>
                        {{$item['penghasilan_bersih']}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
