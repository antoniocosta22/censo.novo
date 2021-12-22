<?php
$id_soli = $_GET['soli'];
?>

<script src="./js/swalert.js"></script>
<script>
    swal({
  title: "Você tem certeza?",
  text: "Cancelamento de solicitação!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        swal("Solicitação cancelada", {
        icon: "success",
        }).then( () => {
            location.href = "principal.php?p=usuario/cancelar.php&obs=<?=$id_soli?>"
        });
    } else {
        swal("Cancelada!").then( () => {
                            history.back();
                        })
    }
    });
</script>