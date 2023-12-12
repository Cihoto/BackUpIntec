//CLOSE ALL TABS IN PROJECT ASSIGNMENTS
function CloseAllTabsOnProjectsAssigments(){

    $('#myTab .projectAssigmentTab').each((key,element)=>{
        if($(element).hasClass('active')){
            element.classList.remove("active")
        }
    })
    $('#myTabContent .tabAssigments').each((key,element)=>{
        if($(element).hasClass('active show')){
            $(element).removeClass('active show');
            $(element).addClass('fade');
        }
    })
}

// function GetAvailableVehicles(element){
//     let navItem = $(element).find('.projectAssigmentTab')
//     if($(navItem).hasClass('active')){
//         $(navItem).removeClass('active')
//         $('#vehicle').removeClass('active show').addClass('fade');
//     }else{

//         CloseAllTabsOnProjectsAssigments();
//         $(navItem).addClass('active')
//         $('#vehicle').removeClass('fade').addClass('active show');
//         $('#DragVehiculos').show();

//         let fechaInicio = $('#fechaInicio').val();
//         let fechaTermino = $('#fechaTermino').val();

//         DropVehiculos();
//         if(fechaInicio === "" || fechaTermino === ""){
//             Swal.fire({
//                 title: '',
//                 text: "Debes seleccionar el rango de fechas en las que se realizará este proyecto para poder ver los vehículos disponibles, ¿Deseas continuar y ver todos tus vehículos?",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonText: 'Ver todos los vehículos',
//                 cancelButtonText: 'Seleccionaré un rango de fechas'
//                 }).then((result) => {
//                 if (result.isConfirmed) {
//                     FillVehiculos(EMPRESA_ID);
//                 }else{
//                 }
//             })
//         }
//         if(fechaInicio !== "" && fechaTermino !== ""){
//             GetAvailableVehicles(EMPRESA_ID,fechaInicio,fechaTermino);    
//         }
//     }
// }



// function GetAvailableProducts(element){

//     let navItem = $(element).find('.projectAssigmentTab')
//     if($(navItem).hasClass('active')){
//         $(navItem).removeClass('active')
//         $('#products').removeClass('active show').addClass('fade');
//     }else{
        
//         CloseAllTabsOnProjectsAssigments();
//         $(navItem).addClass('active')
//         $('#products').removeClass('fade').addClass('active show');
    
//         if($('#fechaInicio').val() === "" || $('#fechaTermino').val() === ""){
    
//             Swal.fire({
//                 title: '',
//                 text: "Debes seleccionar el rango de fechas en las que se realizara este proyecto para poder ver los productos disponibles,Deseas continuar y ver todos tus productos sin asignar?",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonText: 'Ver todos los productos',
//                 cancelButtonText: 'Seleccionaré un rango de fechas'
//                 }).then((result) => {
//                 if (result.isConfirmed) {
//                     FillProductosAvailable(EMPRESA_ID,"all","","");
//                 }
//             })
//         }
    
//         if($('#fechaInicio').val() !== "" && $('#fechaTermino').val() !== ""){
//             FillProductosAvailable(EMPRESA_ID,"available",$('#fechaInicio').val(),$('#fechaTermino').val());
//         }
//     }
// }

// function GetAvailablePersonal(element){
//     let navItem = $(element).find('.projectAssigmentTab')
//     if($(navItem).hasClass('active')){
//         $(navItem).removeClass('active')
//         $('#personal').removeClass('active show').addClass('fade');
//     }else{
        
//         CloseAllTabsOnProjectsAssigments();
//         $(navItem).addClass('active')
//         $('#personal').removeClass('fade').addClass('active show');
    
//         if($('#fechaInicio').val() === "" || $('#fechaTermino').val() === ""){
    
//             Swal.fire({
//                 title: '',
//                 text: "Debes seleccionar el rango de fechas en las que se realizara este proyecto para poder ver los tecnicos disponibles,Deseas continuar y ver todos tus productos sin asignar?",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonText: 'Ver todos los productos',
//                 cancelButtonText: 'Seleccionaré un rango de fechas'
//                 }).then((result) => {
//                 if (result.isConfirmed) {
//                 }
//             })
//         }
//     }
// }
