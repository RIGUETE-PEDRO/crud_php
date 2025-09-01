<tbody>
<?php
include '../back/PropertiesConf.php';

$sql = "SELECT * FROM TAREFAS ORDER BY ORDEM";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['NOME']) . "</td>";
        echo "<td>" . number_format($row['CUSTO'], 2, ',', '.') . "</td>";
        echo "<td>" . date("d/m/Y", strtotime($row['DATA_LIMITE'])) . "</td>";
        echo "<td>
                <a href='editar.php?id=".$row['ID']."'><button class='editar'>Editar</button></a>
                <a href='excluir.php?id=".$row['ID']."'><button class='excluir'>Excluir</button></a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhuma tarefa encontrada</td></tr>";
}

$conn->close();
?>
</tbody>
