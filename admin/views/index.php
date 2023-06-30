<?php
include "../_protect.php";
$title = "Gestion des élèves";
$link = "../../assets/style/adminAccueil.css";
include "../includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connexion/connect.php";
require_once "../php/function.php";

$role = $_SESSION["user"]["role"];

if ($role === "super_admin") {
    $students = getAdminStudents($conn);
} elseif ($role === "admin") {
    $students = getUserStudents($conn);
} else {
    $students = array();
}
?>

<div id="container-eleves">
    <div>
        <li><button><a href="./ajoutUtilisateur.php"> <i class="fa-solid fa-user-plus"></i></a></button></li>
    </div>
    <div>
        <input type="text" id="searchInput" placeholder="Rechercher un élève">
    </div>
</div>

<div id="container-main">
    <div id="main-tab">
        <table class="tableau">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
                <th>Outils</th>
            </tr>
            <?php
$index = 0;
if (!empty($students)) {
    foreach ($students as $row) {
        echo "<tr>";
        echo "<td>" . $row["userSurname"] . "</td>";
        echo "<td>" . $row["userName"] . "</td>";
        echo "<td>" . $row["className"] . "</td>";
        echo "<td>";
        echo '<form action="addMissing.php" method="post">';
        echo '<input type="hidden" name="userId" value="' . $row["userId"] . '">';
        echo '<button type="submit" name="absentBtn">Absent</button>';
        echo '</form>';
        echo '<a href="./modificationUtilisateur.php?studentId=' . $row["userId"] . '" class="button">Modifier</a>';
        echo "</td>";
        echo "</tr>";
        $index++;
    }
} else {
    echo "<tr><td>aucun élève trouvé</td></tr>";
}
?>
        </table>
    </div>
</div>

<script src="../../assets/javascript/script.js"></script>
<script src="../../assets/javascript/search.js"></script>
<script>
    const searchInput = document.getElementById('searchInput');
    const students = <?php echo json_encode($students); ?>;

    function filterStudents() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredStudents = students.filter((student) => {
            return (
                student.userSurname.toLowerCase().includes(searchTerm) ||
                student.userName.toLowerCase().includes(searchTerm) ||
                student.className.toLowerCase().includes(searchTerm)
            );
        });

        updateStudentsTable(filteredStudents);
    }

    function updateStudentsTable(filteredStudents) {
        const tableBody = document.querySelector('#main-tab .tableau tbody');
        tableBody.innerHTML = '';

        if (filteredStudents.length > 0) {
            filteredStudents.forEach((student) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.userSurname}</td>
                    <td>${student.userName}</td>
                    <td>${student.className}</td>
                    <td>
                        <form action="addMissing.php" method="post">
                            <input type="hidden" name="userId" value="${student.userId}">
                            <button type="submit" name="absentBtn">Absent</button>
                        </form>
                        <a href="./modificationUtilisateur.php?studentId=${student.userId}" class="button">Modifier</a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        } else {
            const noResultsRow = document.createElement('tr');
            noResultsRow.innerHTML = '<td colspan="4">Aucun élève trouvé</td>';
            tableBody.appendChild(noResultsRow);
        }
    }

    searchInput.addEventListener('input', filterStudents);
</script>

</body>
</html>
