const ACCEPTED_MIME_TYPES = ["application/zip",
    "application/x-7z-compressed",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.ms-excel",
    "text/plain",
    "application/vnd.rar",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "application/vnd.ms-powerpoint",
    "application/pdf",
    "image/*",
    "text/csv",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/gzip",
    "audio/mpeg",
    "video/mp4",
    "video/mpeg"];
let _allmyUploadedFiles = [];

$('#createProject').on('click', function () {
    // $('#addDocuments').trigger('click');
})

$('#addDocuments').on('click', async function (e) {

    // e.preventDefault();

    // var formData = new FormData();
    // const FILES = $('#archivo')[0].files;

    // console.log("formData", formData);
    // for (let i = 0; i < FILES.length; i++) {
    //     formData.delete('files');
    //     formData.append('files', FILES[i]);

    //     if (ACCEPTED_MIME_TYPES.includes(FILES[i].type)) {
    //         const fileExists = _allmyUploadedFiles.find((file)=>{
    //             return file.name === FILES[i].name;
    //         });
    //         if(fileExists){
    //             const responseReplaceFile = await getReplaceFileResponse(FILES[i]);
    //             if(!responseReplaceFile){
    //                 continue
    //             }
    //         }
    //         await $.ajax({
    //             url: "ws/BussinessDocuments/files.php",
    //             type: 'POST',
    //             data: formData,
    //             contentType: false,
    //             processData: false,
    //             success: function (response) {
    //                 _allmyUploadedFiles.push({
    //                     'name':FILES[i].name,
    //                     'size':FILES[i].size,
    //                     'type':FILES[i].type
    //                 })       
    //             },
    //             error: function (xhr, status, error) {
    //                 alert(xhr.responseText);
    //             }
    //         });
    //     } else {
    //         Toastify({
    //             text: `El archivo ${FILES[i].name} no es admitido por el sistema, su extensión está restringida`,
    //             duration: 4000
    //         }).showToast();
    //     }

    // }

    // $('#archivo').val("");
});

async function saveSelectedFilesInServer(){
    // e.preventDefault();
    var formData = new FormData();
    const FILES = $('#archivo')[0].files;

    console.log("formData", formData);
    for (let i = 0; i < FILES.length; i++) {
        formData.delete('files');
        formData.append('files', FILES[i]);

        if (ACCEPTED_MIME_TYPES.includes(FILES[i].type)) {
            const fileExists = _allmyUploadedFiles.find((file)=>{
                return file.name === FILES[i].name;
            });
            if(fileExists){
                const responseReplaceFile = await getReplaceFileResponse(FILES[i]);
                if(!responseReplaceFile){
                    continue
                }
            }
            await $.ajax({
                url: "ws/BussinessDocuments/files.php",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    _allmyUploadedFiles.push({
                        'name':FILES[i].name,
                        'size':FILES[i].size,
                        'type':FILES[i].type
                    })       
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        } else {
            Toastify({
                text: `El archivo ${FILES[i].name} no es admitido por el sistema, su extensión está restringida`,
                duration: 4000
            }).showToast();
        }

    }

    $('#archivo').val("");
    console.log("TERMINE DE GUYARDAR LOS ARCHIBVOS EN EL SERVIDOR")
}

async function getReplaceFileResponse(file){
 return await Swal.fire({
    title: `El archivo ${file.name} ya existe en este evento, ¿Deseas reemplazarlo?`,
    showDenyButton : true,
    showCancelButton: false,
    confirmButtonText: "Reemplazar archivo",
    denyButtonText: `Omitir este archivo`
    }).then(async(result) => {
    if (result.isConfirmed) {
       return true
    } else if (result.isDenied) {
        return false
    }
    });
}