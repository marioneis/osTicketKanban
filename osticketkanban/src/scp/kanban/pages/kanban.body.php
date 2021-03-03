<?php
include("controladores/geradorPagina.php");
include_once("controladores/acessaBD.php");
#include_once("verificaSession.php");
$data = conectaTicket();
$divAberto = '';
$divAtendimento = '';
$divEncerrado = '';


    foreach ($data as $row) {    
        if ($row['isanswered'] == 0 && is_null($row['closed'])) {
            $divAberto = $divAberto.criaCardAberto($row);
        } elseif ($row['isanswered'] == 1 && is_null($row['closed']) ) {
            $divAtendimento = $divAtendimento.criaCardAtendimento($row);
        } elseif (! is_null($row['closed'])) {
            $divEncerrado = $divEncerrado.criaCardEncerrado($row);
        };
    };
?>
<body>
    <div class="board">
        <div class="aberto">
            <div class="tituloColuna">Tickets Abertos</div>
            <?php echo $divAberto ?>
        </div>
        <div class="atendimento">
            <div class="tituloColuna">Tickets em atendimento</div>
            <?php echo $divAtendimento ?>
        </div>
        <div class="encerrado">
            <div class="tituloColuna">Tickets encerrados no dia</div>
            <?php echo $divEncerrado ?>
            
        </div>

    </div>






<?php
include('kanban.footer.php');
?>
</body>

</html>