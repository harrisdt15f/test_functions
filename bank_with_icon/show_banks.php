<!DOCTYPE html>
<html>
<head>
    <title>test_banks</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    <style type="text/css">

        .ico-bank {
            background-image: url(ui-bank.png);
            background-repeat: no-repeat;
            display: inline-block;
            width: 162px;
            height: 42px;
            border: 1px solid #c6c6c6;
            border-radius: 3px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        /*中国农业银行*/
        .ABC {
            /*background: url(0728/ny.png) 4px 5px no-repeat;
            */
            background-position: 23px 5px;
        }

        /*北京银行*/
        .BJBANK {
            background-position: 23px -36px;
        }

        .BOC {
            /*background: url(0728/zg.png) 4px 5px no-repeat;*/
            /*background-position: 23px 5px;*/
            background-position: 23px -68px;
        }

        .BSB {
            background-position: 23px -108px;
        }

        .CCB {
            background-position: 23px -141px;
        }

        .CEB {
            background-position: 23px -177px;
        }

        .CITIC {
            background-position: 23px -212px;
        }

        .CMB {
            /*background: url(0728/zs.png) 4px 5px no-repeat;*/
            background-position: 23px -248px;
        }

        .CMBC {
            /*background: url(0728/ms.png) 4px 5px no-repeat;*/
            background-position: 23px -284px;
        }

        .BOCOM {
            /*background: url(0728/jt.png) 4px 5px no-repeat;*/
            background-position: 23px -322px;
        }

        .EGBANK {
            background-position: 23px -360px;
        }

        .FJHXBC {
            background-position: 23px -396px;
        }

        .GDB {
            background-position: 23px -429px;
        }

        .HXBANK {
            background-position: 23px -468px;
        }

        .HZCB {
            background-position: 23px -504px;
        }

        .ICBC {
            background-position: 22px -535px;
        }

        .JHBANK {
            background-position: 23px -576px;
        }

        .JSBANK {
            background-position: 23px -612px;
        }

        .JXBANK {
            background-position: 23px -648px;
        }

        .NBBANK {
            background-position: 23px -684px;
        }

        .NBYZ {
            background-position: 23px -720px;
        }

        .PSBC {
            background-position: 23px -752px;
        }

        .SDB {
            background-position: 23px -792px;
        }

        .SHBANK {
            background-position: 23px -828px;
        }

        .SPABANK {
            background-position: 23px -864px;
        }

        .SPDB {
            /*background: url(0728/pd.png) 4px 5px no-repeat;*/
            background-position: 23px -897px;
        }

        .SXCB {
            background-position: 23px -936px;
        }

        .WZCB {
            background-position: 23px -972px;
        }

        .ZJNX {
            background-position: 23px -1008px;
        }

        .CIB {
            background-position: 23px -1040px;
        }

        .PAB {
            background-position: 23px -861px;
        }

        .HXB {
            background-position: 23px -465px;
        }

        .TENPAY {
            background-position: 23px -1082px;
        }
    </style>
</head>
<body>
<?php
$banks = [
    'ABC', 'BJBANK', 'BOC',
    'BSB', 'CCB', 'CEB',
    'CITIC', 'CMB', 'CMBC',
    'BOCOM', 'EGBANK', 'FJHXBC',
    'GDB', 'HXBANK', 'HZCB',
    'ICBC', 'JHBANK', 'JSBANK',
    'JXBANK', 'NBBANK', 'NBYZ',
    'PSBC', 'SDB', 'SHBANK',
    'SPABANK', 'SPDB', 'SXCB',
    'WZCB', 'ZJNX', 'CIB',
    'PAB', 'HXB', 'TENPAY',
];
$i = 1;
$container = <<<CONTAINTER
<div class="container">
    ~fluid~
</div>
CONTAINTER;
$container_fluid = <<<fluid
<div class="container-fluid">~row~</div>
fluid;
$row = <<<ROW
<div class="row">~col~</div>
ROW;
$col = <<<COL
<div class="col-sm ico-bank ~class~"></div>
COL;
$html_col = $html_row = $html_fluid = '';

foreach ($banks as $key => $value) {
    if ($i % 3 == 0) {
        echo $value . " <br>";
        $html_col .= str_replace('~class~', $value, $col);
        $html_row .= str_replace('~col~', $html_col, $row);
        $html_fluid .= str_replace('~row~', $html_row, $container_fluid);
        $html_col = $html_row = '';

    } else {
        echo $value . " ";
        $html_col .= str_replace('~class~', $value, $col);

    }
    $html = str_replace('~fluid~', $html_fluid, $container);
    $i++;
}

echo $html;
?>

</body>
</html>