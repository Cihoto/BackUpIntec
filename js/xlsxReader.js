class Excel{

    constructor(content){
        this.content = content;
    }
    header(){
        return new row(this.content[0]);
        //return this.content[0];
    }
    rows(){
        return new rowCollection(this.content.slice(1,this.content.length));
    }
}

class rowCollection{
    constructor(rows){ 
        this.rows = rows;
    }
  
    first(){
        return  new row(this.rows[0]);
    }
    get(index)
    {
        return new row(this.rows[index]);
    }
    count(){
        return this.rows.length;
    }
}

class row{
    constructor(row)
    {
        this.row = row;
    }
    trackid(){
        return this.row[2];
    }
    documentNumber(){
        return this.row[0];
    }
    cliente(){
        return this.row[3];
    }
    customrow(index){
        return this.row[index];
    }
}

function getArrayLength(countableArray){
    var count = 0;
    for(var key in countableArray) if(countableArray.hasOwnProperty(key)) count++;
    return count;
}

const excelInput = document.getElementById('excel_input');
async function xlsxReadandWrite(arrayHead){

    // try{
        const content = await readXlsxFile(excelInput.files[0])
        const arrayCount = getArrayLength(arrayHead.xlsxData)
        const excel = new Excel(content);
        let rows = excel.rows();
        const headers = excel.header();
        
        let xlsxHead =[];
        let xslxType = [];
        let xlsxRow = [];
        let xlsxNull = [];
        let xslxMinLength = [];
        let xlsxMaxLength = [];

        console.table(arrayHead);
        console.table (headers);



        //ARRAY HEADERS EXCEL
        headers.row.forEach((element, index) => {

            if(index < arrayCount){
                xlsxHead.push(element)
            }

        })

        //ARRAY DATATYPE

        arrayHead.xlsxData.forEach((type, index) => {

            if(index < arrayCount){
                xslxType.push(type.type)
            }

        });


        /*ARRAY FILAS, CONTENER CONTENIDO DE CADA FILA DEL EXCEL A CANTIDAD DE COLUMNAS, IGNORAR LAS QUE 
        ESTEN FUERA DEL arrayCount*/

        rows.rows.forEach((row, index) => {
            let newRow =[]

            row.forEach((rowElement,index) => {
                if(index < arrayCount){
                    newRow.push(rowElement)
                }
            });
            xlsxRow.push(newRow)
        });

        //ARRAY IF IS NULL
        arrayHead.xlsxData.forEach((nulloption, index) => {
            if(index < arrayCount){
                xlsxNull.push(nulloption.notNull)
            }
        });

        //ARRAY MIN LENGTH

        arrayHead.xlsxData.forEach((data, index) => {
            if(index < arrayCount){
                xslxMinLength.push(data.minlength)
            }
        });
        //ARRAY MAX LENGTH

        arrayHead.xlsxData.forEach((data, index) => {
            if(index < arrayCount){
                xlsxMaxLength.push(data.maxLength)
            }
        });

        //COMPARAR HEADERS CONTENIDOS EN EL EXCEL Y LOS PREDEFINIDOS

        let counterErrHead = 0;

        arrayHead.xlsxData.forEach((arh,index) => {

            let name = arh.name;
            console.log(`COMPARAR ${name} con ${xlsxHead[index]}`);
            if(name !== xlsxHead[index]){
                counterErrHead ++
                console.log('-------------------------------------');
                console.log('SE SUMA 1 ERROR');
            }
        })
        console.log("",counterErrHead);
        
        console.log("ARRAY HEAD COMING", arrayHead.xlsxData );
        console.log("ARRAY HEAD ", xlsxHead);
        console.log(counterErrHead);

        if(counterErrHead == 0){
            let cell = ""
            let ifNull=""
            let td = ""
            let table="";
            let tHead;
            let tBody;
            let minlength;
            let maxlength;

            tHead = `<tr>`
            xlsxHead.forEach(theadElement => {
                tHead += `<td>${theadElement}</td>`
            });
            tHead += `</tr>`    


            let rowCount  = xlsxRow.length;
            for(i = 0 ; i < rowCount ; i++){
                td += `<tr>`
                cell = xlsxRow[i]

                for (j = 0 ; j < arrayCount ; j ++){

                    ifNull = xlsxNull[j]
                    minlength = xslxMinLength[j]
                    maxlength = xlsxMaxLength[j]

                    let tdName = xlsxHead[j]
                    let tdType = xslxType[j]
                    let tdCell = cell[j]
                    let tdNull = ifNull
                    let nullValidated = false

                    let tdTitle = "";
                    let valueTypeVerification;

                    let nullcheck = isNull(tdCell)

                    if(!tdNull && nullcheck){

                        nullValidated = true
                        tdTitle = "Ingrese un valor";
                        valueTypeVerification = true

                    }else{
                        if(tdType === "int"){
    
                            valueTypeVerification = isNumeric(tdCell)
                            if(!valueTypeVerification){
                                tdTitle = "Debe ingresar un número"
                            }else{
                                tdTitle = ""
                            }
                        }
                        if(tdType === "string"){
                            valueTypeVerification = false
                        }
                    }

                    let boolType;
                    if(nullValidated){
                        boolType = false
                    }else{

                        if(tdType == "int"){
                            boolType = true
                        }
                        if(tdType == "string"){
                            boolType = false
                        }
                        
                    }
                    
                    let tdTest = ""
                    if(boolType === valueTypeVerification){
                        if(tdCell == null){
                            tdCell = ""
                        }
                        td += `<td class="${tdName}" title="${tdTitle}"  contenteditable>${tdCell}</td>`
                        tdTest = `<td class="${tdName}" title="${tdTitle}"  contenteditable>${tdCell}</td>`
                    }else{
                        if(tdCell == null){
                            tdCell = ""
                        }
                        td += `<td class="${tdName} err" title="${tdTitle}" contenteditable>${tdCell}</td>`
                        tdTest = `<td class="${tdName} err" title="${tdTitle}" contenteditable>${tdCell}</td>`
                    }

                }
                td += `</tr>`
            }

            tBody = td;
            table = [tHead , tBody]
            return table


        }else{
            console.log("EL ARCHIVO CARGADO NO ES EL CORRESPONDIENTE");
        }
    // }catch(error){
        
    //     console.log(error);
        
    //     swal.fire({
    //         title : "Ups",
    //         text : "El archivo cargado no es el correcto, Prueba descargando nuestro Excel tipo ",
    //         icon: "error",
    //         showConfirmButton: true,
    //         timer : 3000})
    // }
}