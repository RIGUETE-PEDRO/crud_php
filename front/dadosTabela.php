<tbody>
    <?php
    include '../back/PropertiesConf.php';

    $sql = "SELECT * FROM TAREFAS ORDER BY ORDEM";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            // Define a classe da linha inteira com base no custo
            $classe = ($row['CUSTO'] > 999) ? "custo-alto" : "custo-baixo";

            echo "<tr class='$classe'>";
            echo "<td>" . htmlspecialchars($row['NOME']) . "</td>";
            echo "<td>" . number_format($row['CUSTO'], 2, ',', '.') . "</td>";
            echo "<td>" . date("d/m/Y", strtotime($row['DATA_LIMITE'])) . "</td>";
            echo "<td>
                    <a href='/back/prioridade.php?id=" . $row['ID'] . "&acao=down'><img src='img/seta.svg' class='seta-down acoes'></a>
                    <a href='/back/prioridade.php?id=" . $row['ID'] . "&acao=up'><img src='img/seta.svg' class='seta-up acoes'></a>
                    <a href='/back/editar.php?id=" . $row['ID'] . "'><img src='img/edit.svg' class='editar acoes' ></a>
                    <a href='#' class='excluir acoes' onclick='abrirConfirmacaoExclusao(" . $row['ID'] . ")'><img src='img/delete.svg'></a>
                    
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhuma tarefa encontrada</td></tr>";
    }

    $conn->close();
    ?>
</tbody>
