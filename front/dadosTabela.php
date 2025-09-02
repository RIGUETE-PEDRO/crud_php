<tbody>
    <?php
    include '../back/PropertiesConf.php';


    $sql = "SELECT * FROM TAREFAS ORDER BY ORDEM";
    $result = $conn->query($sql);
    $tarefas = $result->fetch_all(MYSQLI_ASSOC);
    $total_tarefas = count($tarefas);

    if ($total_tarefas > 0) {
     
        foreach ($tarefas as $index => $row) {
            $id = $row['ID'];
            $classe_custo = ($row['CUSTO'] > 999) ? "custo-alto" : "custo-baixo";

            echo "<tr id='linha-{$id}' class='{$classe_custo}' data-id='{$id}'>";
            
          
            echo "<td><span class='texto texto-nome'>".htmlspecialchars($row['NOME'])."</span><input type='text' class='campo-edicao' value='".htmlspecialchars($row['NOME'])."' style='display:none;'></td>";
            echo "<td><span class='texto texto-custo'>".number_format($row['CUSTO'], 2, ',', '.')."</span><input type='number' step='0.01' class='campo-edicao' value='".$row['CUSTO']."' style='display:none;'></td>";
            echo "<td><span class='texto texto-data'>".date("d/m/Y", strtotime($row['DATA_LIMITE']))."</span><input type='date' class='campo-edicao' value='".$row['DATA_LIMITE']."' style='display:none;'></td>";
            
            echo "<td class='acoes'>";
          
            
            if ($index < $total_tarefas - 1) {
                echo "<a href='/back/prioridade.php?id={$id}&acao=down'><img src='img/seta.svg' class='seta-down acoes-icone' style='margin-left: 50px;'></a>";
            }else{
                echo "<span style='display:inline-block; width:32px; margin-left: 50px;'></span>";
            }
        
            if ($index > 0) {
                echo "<a href='/back/prioridade.php?id={$id}&acao=up'><img src='img/seta.svg' class='seta-up acoes-icone' style='margin-right: 50px;'></a>";
            }else{
                echo "<span style='display:inline-block; width:32px; margin-right: 50px;'></span>";
            }
            
         
            echo "<img src='img/edit.svg' class='acoes-icone icone-editar' onclick='alternarEdicao({$id})'>";
            echo "<img src='img/save.svg' class='acoes-icone icone-salvar' onclick='salvarEdicao({$id})' style='display:none;'>";
            echo "<img src='img/close.svg' class='acoes-icone icone-cancelar' onclick='alternarEdicao({$id})' style='display:none;'>";
            echo "<a href='#' onclick='abrirConfirmacaoExclusao({$id})'><img src='img/delete.svg' class='acoes-icone'></a>";
           
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhuma tarefa encontrada</td></tr>";
    }

    $conn->close();
    ?>
</tbody>