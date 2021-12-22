<?php
$id_obss = $_GET['obss'];
?>

<script src="./js/swalert.js"></script>
<script>
    swal({
  title: "Você tem certeza?",
  text: "Exclusão de observação!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        swal("OBS deletada", {
        icon: "success",
        }).then( () => {
            location.href = "principal.php?p=metas/delete.php&obs=<?=$id_obss?>"
        });
    } else {
        swal("Cancelada!").then( () => {
                            history.back();
                        })
    }
    });
</script>