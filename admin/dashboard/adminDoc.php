<?php
$title = "Documents";
$link = "../../assets/style/adminDocument.css";
session_start();
include "../includes/header.php";
?>
    <div id="container-eleves">
        <ul>
            <li>Nom de l'élève :</li>
            <li>Prénom de l'élève :</li>
            <li>Classe de l'élève :</li>
        </ul>
    </div>
    <div id="container-main">
        <div id="container-main1">
            <h2>Documents fournis :</h2>
            <table>
                <tr>
                    <th>type</th>
                    <th>date reçu</th>
                    <th>accepté</th>
                </tr>
                <tr>
                    <td>lm</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>Rib</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>cv</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <td>fiche paie</td>
                    <td>22/22/2022</td>
                    <td>Oui</td>
                </tr>
            </table>
        </div>
        <div id="container-main2">
            <h2>Documents restants a fournir :</h2>
            <table>
                <tr>
                    <th>type</th>
                </tr>
                <tr>
                    <td>permis</td>
                </tr>
                <tr>
                    <td>paie</td>
                </tr>
                <tr>
                    <td>cv</td>
                </tr>
                <tr>
                    <td>lm</td>
                </tr>
                <tr>
                    <td>passeport</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="../../assets/javascript/script.js"></script>
</body>

</html>
