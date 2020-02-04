<?
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
$status = isset($_GET['status']) ? $_GET['status'] : 0;
$Valorglobal = $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$tipoReparo = null;
?>
<script src="../jquery/jquery-3.4.1.js"></script>
<script lang="javascript">
        $(document).ready(function(){
            function atualiza(){
                $.ajax({
                    url: '../listas/ordemServico.php',
                    type : 'post',
                    /*data:$('#servicoOs').serialize(),*/
                    data: 'id=<?echo$Valorglobal?>',
                    success: function(data){
                        $('#home').html(data);
                    }
                });
            }
            atualiza();
        });
    </script>
    <script lang="javascript">
        $(document).ready(function(){
            function atualiza(){
                $.ajax({
                    url: '../listas/historicoOs.php',
                    type : 'post',
                    data: 'id=<?echo$Valorglobal?>',
                    success: function(data){
                        $('#profile').html(data);
                    }
                });
            }
            atualiza();
        });
    </script>
    <script lang="javascript">
        $(document).ready(function(){
            function atualiza(){
                $.ajax({
                    url: '../listas/historicoPecas.php',
                    type : 'post',
                    /*data:$('#servicoOs').serialize(),*/
                    data: 'id=<?echo$Valorglobal?>',
                    success: function(data){
                        $('#contact').html(data);
                    }
                });
            }
            atualiza();
        });
    </script>
<body>
    <div class="container border-config">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ordem Serviço</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Histórico</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Histórico Peças</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
    
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <h4>Ainda em implantação</h4>
  </div>
 
</div>
</div>
</body>