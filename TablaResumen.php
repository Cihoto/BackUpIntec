<!DOCTYPE html>
<html lang="en">
<?php  include_once('./includes/head.php')?>
<body>

    <?php include_once('./includes/footer.php')?>
    <?php include_once('./includes/footerScriptsJs.php')?>
    <script src="/js/valuesValidator/validator.js"></script>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function(event){
        let tr = document.getElementsByTagName('td')
        const chile = new Intl.NumberFormat("es-CL", { currency: "CLP", style: "currency" })
        // console.log(tr);

        for(let i = 0 ; i< tr.length ; i++){
            // console.log(Number.isInteger(tr[i].textContext));
            console.log(tr[i].textContent);
            console.log("ISNUMERIC",isNumeric(tr[i]));
            if(isNumeric(parseInt(tr[i]))){
                console.log("CONVERTED",chile.format(tr.textContext))
            }
        }
    })
</script>
</html>