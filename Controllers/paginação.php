<?php
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();

   $sql = " SELECT * FROM Estoque WHERE 1=1 ";
   $sql.= $descricao != "" ? " AND descricao LIKE '%$descricao%' " : "";
   $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";
   
   //echo $sql; //descomentar para exibir a query para efetuar testes
   
   $resultado_id = mysqli_query($link, $sql);
   
   if($resultado_id){
   
       echo '<table class="table">';
           echo '<thead>';
               echo '<tr>';
                   echo '<th>ID</th>';
                   echo '<th>DESCRIÇÃO</th>';
                   echo '<th>PREÇO</th>';
                   echo '<th>FOTO</th>';
               echo '</tr>';
           echo '</thead>';
   
           while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
               echo '<tbody>';
                   echo '<tr>';
                       echo '<td>'.$registro['id'].'</td>';
                       echo '<td>'.$registro['descricao'].'</td>';
                       echo '<td>'.$registro['preco'].'</td>';
                       echo '<td><img src="imagens/'.$registro['foto'].'" width="75" height="75" /></td>';
                   echo '</tr>';
               echo '</tbody>';
           }
        echo '</table>';
   
   
        //como o offset (página) inicia em zero, ajusto para que visualmente seja indicado o início em seu respectivo valor +1
        $offset++;
        //descobre a quantidade de páginas com base no total de registros / dividido pela quantidade de registros por página
        $total_paginas = ceil($total_registros / $registros_por_pagina); // a função ceil() arredonda o resultado para o inteiro superior mais próximo
        echo "Página ".ceil($offset / $registros_por_pagina)." de $total_paginas Total de registros: $total_registros";
   
        echo "<br />";
   
        //cria os links de paginação
        $pagina_atual = ceil($offset / $registros_por_pagina); //localiza a pagna atual
   
        for($i = 1; $i <= $total_paginas; $i++) {    
           
           $classe_botao = $pagina_atual == $i ? 'btn-primary' : 'btn-default'; //aplica a classe para o botão da página atual
           echo '<button class="btn '.$classe_botao.' paginar" data-pagina_clicada="'.$i.'">'.$i.'</button>';
        }
   
        echo "<br /><br />";
   
   } else {
       echo 'Erro na consulta dos registros!';
   }
   


?>