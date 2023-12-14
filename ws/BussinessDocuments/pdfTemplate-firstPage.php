<!DOCTYPE html>
<html lang="en">

<head>

    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* @page{
            margin-top: 100px;
            margin-bottom: 70px; 
        }
        header{
            position: fixed;
            left: 0px;
            right: 0px;
            height: 60px;
            margin-top: -55px;
        }
        footer{
            height: 50px;
            margin-bottom: -50px;
        } */


        @font-face {
            font-family:'Roboto',sans-serif;
            font-style: normal;
            font-weight: normal;
            src: url('./PDF_fonts/Roboto-Medium.ttf') format('truetype');
        }

        body{
            font-family: 'Roboto',sans-serif!important;
        }
        .svgLogo {
            position: absolute;
            margin-top: -45px
        }

        .right-logo {
            position: absolute;
            right: -125px;
            top: -46px;
        }

        .pdfHeader {
            position: absolute;
            top: -40px;
        }

        .header-data-container {
            /* justify-content: space-between; */
        }

        .contact-quote{
            width:  56px;
            height: 16px;
            color: #2C2D33;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            margin-top: 0px;
        }

        .contact-container{
            display: inline-block;
            width: 300px;
            height: 20px;
            
        }

        .contact-data{
            width: 224px;
            height: 16px;
            color: #53545C;
            font-size: 10px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-top: -30px;
            margin-left: 58px;
        }

        .dataQuote {
            width: 30%;
            border-right: 4px solid #10E5E1;
            border-radius: -8px;
            padding: 3px;
            /* background-color: red; */
            height: 100px;
        }

        .quote-client-name {
            color: #2C2D33;
            font-size: 14px;
            font-style: italic;
            font-weight: 600;
        }

        #quoteDetailsTable {
            margin-top: 320px;
            width: 700px;
            border-spacing: 0;
        }

        #quoteDetailsTable td {
            padding: 0px;
        }

        .categorieQuote td {
            padding: 4px;
            background-color: #EDF6F6;
        }

        .item-quote{
            color:  #53545C;
            font-feature-settings: 'clig' off, 'liga' off;
            font-size: 10px;
            font-style: normal;
            font-weight: 400;
            line-height: 143%; 
            letter-spacing: 0.17px;
        }
        .categorie-quote{
            color:  rgba(0, 0, 0, 0.87);
            font-feature-settings: 'clig' off, 'liga' off;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 143%; /* 17.16px */
            letter-spacing: 0.17px;
        }

        .tempContent {
            height: 900px;
            margin-bottom: 100px;
            width: 700px;
            background-color: rgba(255, 255, 255, 0);
        }

        .table-resume-container{
            position: relative;
            margin-left: 310px;
            margin-top: -100px;
        }

        #invoice-table-resume{
            /* margin-left: 450px; */
            /* margin: 0px; */
            width: 200px;
            border-spacing:0 ;
        }

        #invoice-table-resume th,#invoice-table-resume td{
            padding:15px;
        }

        .sideResumeMessage{
            width: 250px;
            margin-bottom: -300px;
            margin-left: 0px;
            color:  rgba(0, 0, 0, 0.87);
            font-feature-settings: 'clig' off, 'liga' off;
            font-size: 12px;
            font-style: italic;
            font-weight: 700;
            line-height: 143%; /* 14.3px */
            letter-spacing: 0.17px;
        }

        #invoice-table-resume .totalVenta{
            background-color: #10E5E1;

        }

        /* .totalVenta th{
            border-radius: 10px;
        } */


        .quote-resume-heading{
            text-align: right;
            width: 250px;
        }
        .quote-resume-heading p{
            color: var(--White, #FCFCFC);
            font-feature-settings: 'clig' off, 'liga' off;
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            text-align: start;
            line-height: 24px;
            margin: 0px;
            letter-spacing: 0.17px;
        }
        /* .total-quote{
            border-radius:7px 0px 0px 7px;
        }
        .subNTotalResume{
            text-align: center;
            border-radius:0px 7px 7px 0px
        } */

        #footer {
            text-align: right;
            border-top: 1px solid black;
            page-break-before: avoid;
        }

        .footerContent{
            position: absolute;
            margin-bottom: -30px;
        }

        footer{
            position: fixed;
            left: -45px;
            right: -45px;
            height: 100px;
            bottom: -45px;
        }

        .first-bottom{
            position: absolute;
            bottom: 0px;
            left: -45px;
        }

        .second-bottom{
            position: absolute;
            bottom: -2px;
            left: 72px;
            z-index: -1;
        }

        .third-bottom{
            position: absolute;
            bottom: 0px;
            left: 210px;
            z-index: -2;
        }
        .fourt-bottom{
            position: absolute;
            bottom: 0px;
            right: -79px;
        }
        .fifth-bottom{
            position: absolute;
            bottom: 0px;
            right: -14px;
        }

        .wspSection{
            width: 220px;
            position: absolute;
            top: 10px;
            left: 20px
        }
        .locationSection{
            width: 350px;
            position: relative;
            top: 10px;
            left: 260px
        }

        .netWorldSection{
            width: 150px;
            position: relative;
            top: -10px;
            left: 630px;
        }




    </style>
    <title>Document</title>
</head>

<body>

    <img class="svgLogo" style="left: -45px;" src="./PDF_svg/bar1.svg" alt="1asdasd">
    <img class="svgLogo" style="margin-left: 72px;z-index: -1;" src="./PDF_svg/bar2.svg" alt="2asdasdasd">
    <img class="svgLogo" style="margin-left: 210px;z-index: -2;" src="./PDF_svg/bar3.svg" alt="3asdqw2e12ed">
    <img class="right-logo" src="./PDF_svg/bar4.svg" alt="4d1d12">
    <img class="right-logo" width="100" style="right: -60px;" src="./PDF_svg/bar5.svg" alt="5d12d12">



    <section class="pdfHeader">
        <div>
            <img src="./PDF_images/intec-logo.png" alt="" width="220px" height="130px">
        </div>

        <div class="header-data-container">

            <div class="dataQuote" style="float: left;width: 300px;background-color: #EDF6F6;">
                <p class="data-head" style="color: var(--Text-primary, #2C2D33);
                                            font-size: 12px;
                                            font-style: normal;
                                            font-weight: 700;
                                            line-height: normal;">Cotización a</p>
                <p class="quote-client-name">{{ client_name }}</p>
                <p class="quote-client-name">{{ nombre_fantasia }}</p>
            </div>
            <div class="dataQuote" style="float:right; width: 300px;margin-left: 350px;">
                <p class="data-head" style="
                    color: var(--Text-primary, #2C2D33);
                    text-align: right;
                    font-size: 12px;
                    font-style: normal;
                    font-weight: 700;
                    line-height: normal;
                    letter-spacing: 0.6px;">
                    Cotización </p>
                    <table style="margin-left: 110px;margin-top: -5px;">
                        <thead>
                            <tr>
                                <th style="text-align: right;">Número:</th>
                                <th style="text-align: center;">{{ numquote }}</th>
                            </tr>
                            <tr>
                                <th style="text-align: right;">Fecha:</th>
                                <th style="text-align: center;">{{ today }}</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
    </section>
    <div style="float: left;width: 300px; margin-top:200px;">


        <div class="contact-container"><p class="contact-quote">Dirección:</p> <p class="contact-data">Gabriel Palma 814 112 A,Recoleta</p></div>
        <div class="contact-container"><p class="contact-quote">Teléfono:</p> <p class="contact-data">+56953098743</p></div>
        <div class="contact-container"><p class="contact-quote">Correo:</p> <p class="contact-data">coteloyola@hotmail.com</p></div>
        
        
    </div>

    <table id="quoteDetailsTable">
        <thead>
            <tr>
                <th style="background-color: #069B99; width: 80%;padding: 15px; border-radius: 15px 0px 0px 0px;text-align:start;" colspan="2">
                    <p style="color: #FCFCFC!important;
                    font-feature-settings: 'clig' off, 'liga' off;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    line-height: 24px;
                    margin: 0px 0px 0px -420px ;
                    letter-spacing: 0.17px;">
                        Descripción
                    </p>
                </th>
                <th style="background-color: #2C2D33; width: 20%; border-radius: 0px 15px 0px 0px;">
                    <p style="color: #FCFCFC!important;
                    font-feature-settings: 'clig' off, 'liga' off;
                    font-size: 16px;
                    font-style: normal;
                    font-weight: 500;
                    margin: 0px;
                    line-height: 24px; /* 171.429% */
                    letter-spacing: 0.17px;">
                        Total
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- {{ table }} -->

            <?php 

            // for ($i=0; $i <3 ; $i++) { 
                # code...
                foreach ($table_Content as $key => $item) {
                    echo "<tr class='categorieQuote'>
                        <td class='categorie-quote'  style='padding:6px;'><p style='margin: 0px 0px 0px 10px;'>". ucfirst($item->categoria)."</p></td>
                        <td class='categorie-quote' style='padding:6px;'></td>
                        <td class='categorie-quote' style='text-align: center;padding:6px'>$item->total_categoria</td>
                    </tr>";
                    foreach ($item->productos as $key => $prod) {
                        echo "<tr>
                            <td class='item-quote' style='text-align: right;'><p style='margin: 0px 20px 0px 0px;'>". $prod->quantityToAdd."</td>
                            <td class='item-quote' style='text-align: left;'> ".ucfirst($prod->nombre)."</p></td>
                            <td></td>
                        </tr>`;";
                    } 
                }
            // }
            ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>

    <div style="break-before: always;display: inline-block;height: 250px;margin-top: 30px;">

    <p class="sideResumeMessage">La cotización considera servicio completo con operadores</p>

    <div class="table-resume-container">
        {{ totalResumeTable }}
    </div>


    </div>
    <!-- <div id="footer">
        <p>Total: X.XX</p>
    </div> -->



    <!-- </main> -->
    <!-- <div class="icontopSection">
        <img class="svgLogo" style="left: -45px;" src="./PDF_svg/bar1.svg" alt="1asdasd">
        <img class="svgLogo"style="margin-left: 72px;z-index: -1;"  src="./PDF_svg/bar2.svg" alt="2asdasdasd">
        <img class="svgLogo" style="margin-left: 210px;z-index: -2;" src="./PDF_svg/bar3.svg" alt="3asdqw2e12ed">
        <img class="right-logo" src="./PDF_svg/bar4.svg" alt="4d1d12">
        <img class="right-logo" width="100" style="right: -60px;" src="./PDF_svg/bar5.svg" alt="5d12d12">
    </div> -->

    {{ footer }}

</body>

</html>