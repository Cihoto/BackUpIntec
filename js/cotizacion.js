
// NEEDS GLOBAL VARIABLE EMPRESA_ID 
$('#generateQuotes').on('click',function(){

    const date =  new Date();
    const month = date.getMonth();
    const year = date.getFullYear();
    const day = date.getDay();

    console.log("date",date);
    console.log("date",month);
    console.log("date",year);
    console.log("date",day);

    const fileNameData = {
        'month' :month,
        'year' :year,
        'day' :day
    }


    console.log("ESTOY GENERANDO UNA COTIZACIÓN",_categoriesandsubcategories);
    console.log("ESTOY GENERANDO UNA COTIZACIÓN",totalPerItem.equipos);
    console.log("ESTOY GENERANDO UNA COTIZACIÓN",_selectedProducts);
    console.log("ESTOY GENERANDO UNA COTIZACIÓN",_selectedOthersProducts);

    let personal = "";
    let tr = "";

    let tableContent = totalPerItem.equipos.map((itemProd)=>{
        tr += `<tr class="categorieQuote">
            <td>${itemProd.categorie}</td>
            <td></td>
            <td>${CLPFormatter(itemProd.value)}</td>
        </tr>`;
        _selectedProducts.forEach((selectedProd)=>{
            if(selectedProd.categoria === itemProd.categorie){
                tr += `<tr>
                    <td style="text-align:end;">${selectedProd.quantityToAdd}</td>
                    <td>${selectedProd.nombre}</td>
                    <td></td>
                </tr>`;
            }
        })
        
        const productos = _selectedProducts.filter((productos)=>{
            return productos.categoria === itemProd.categorie;
        });

        return {
            'categoria': itemProd.categorie,
            'total_categoria':CLPFormatter(itemProd.value),
            'productos': productos
        }
    });
    let totalOtros = 0;
    const otherProdsFormatted = _selectedOthersProducts.map((other)=>{
        totalOtros += other.total;

        return {
            'nombre':other.detalle,
            'quantityToAdd':other.cantidad
        }
    })

    tableContent.push(
        {
            'categoria': "Otros",
            'total_categoria':CLPFormatter(totalOtros),
            'productos': otherProdsFormatted
        }
    )
    console.log("12837192837198237",tableContent);

    let table =`<table id="quoteDetailsTable">
        <thead>
        <tr>
            <th  style="background-color: #069B99; width: 200px;padding: 15px; border-radius: 15px 0px 0px 0px;" colspan="2">
                <p style="color: var(--White, #FCFCFC);
                font-feature-settings: 'clig' off, 'liga' off;
                font-family: Roboto;
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                text-align: start;
                line-height: 24px;
                margin: 0px;
                letter-spacing: 0.17px;">
                    Descripción
                </p>
            </th>
            <th style="background-color: #2C2D33; width: 15%; border-radius: 0px 15px 0px 0px;"> 
                <p style="color: var(--White, #FCFCFC);
                font-feature-settings: 'clig' off, 'liga' off;
                font-family: Roboto;
                font-size: 24px;
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
        ${tr}
        </tbody>
        <tfoot>
        </tfoot>
    </table>`;

    let totalEquipos = 0;
    let totalOthers = 0;
    totalPerItem.equipos.forEach((equipos)=>{
        totalEquipos +=  parseInt(equipos.value);
    });
    _selectedOthersProducts.forEach((other)=>{
        totalOthers += parseInt(other.total);

    });
    let totalVenta = totalEquipos + totalOthers;
    let iva = parseInt(totalVenta) * 0.19;
    let totalPlusIva = totalVenta + iva;


    const quote_resume =`<table id="invoice-table-resume">
        <thead>
            <tr>
                <th style="" class="quote-resume-heading p-15"><p>Total neto del servicio:</p></th>
                <th style="text-align:center;" >${CLPFormatter(totalVenta)}</th>
            </tr>
            <tr>
                <th style="" class="quote-resume-heading p-15"><p>IVA:</p></th>
                <th style="text-align:center;" >${CLPFormatter(iva)}</th>
            </tr>
            <tr class="totalVenta">
                <th style="" class="quote-resume-heading total-quote p-15"><p>Total:</p></th>
                <th style="text-align:center;" id="subNTotalResume">${CLPFormatter(totalPlusIva)}</th>
            </tr>
        </thead>
    </table>`


console.log("_selectedClient",_selectedClient);

    $.ajax({
        type: "POST",
        url: "ws/BussinessDocuments/quotesGenerator.php",
        dataType: 'json',
        data:JSON.stringify({
            'empresa_id':EMPRESA_ID,
            'table' : table,
            'fileNameData' : fileNameData,
            'table_Content':tableContent,
            'totalQuoteResume':quote_resume,
            'clientData' : _selectedClient
        }),
        success: function(response) {
            console.log("response", response);

            let a = `<a target="_blank" id="dwnload" href="./ws/BussinessDocuments/documents/buss${EMPRESA_ID}/quotes/Cotización-101010-2-2023.pdf"></a>`
                    // <a href="./ws/BussinessDocuments/documents/buss${empresa_id}/"></a>
            $('#downloadPdf').append(a);
            $('#dwnload')[0].click();


        },error:  function(error){
            console.log("error",error.responseText)
        }
    })

})

