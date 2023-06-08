<?php
// Ajout d'une classe
function addClass($conn, $className, $classDesc)
{
    $sql = 'INSERT INTO tblclass (className, classDesc) VALUES (:className, :classDesc)';

    $query = $conn->prepare($sql);

    $query->bindValue(':className', $className, PDO::PARAM_STR);
    $query->bindValue(':classDesc', $classDesc, PDO::PARAM_STR);

    $query->execute();
}

// Ajout d'un élève
function addUser($conn, $surname, $name, $age, $phone, $email, $city, $street, $cp, $className)
{
    $sql = 'INSERT INTO tbluser (userSurname, userName, userAge, userPhone, userMail, userCity, userStreet, userCp, classId) SELECT :userSurname, :userName, :userAge, :userPhone, :userMail, :userCity, :userStreet, :userCp, classId FROM tblclass WHERE classId = :classId';
    $query = $conn->prepare($sql);

    $query->bindValue(':userSurname', $surname, PDO::PARAM_STR);
    $query->bindValue(':userName', $name, PDO::PARAM_STR);
    $query->bindValue(':userAge', $age, PDO::PARAM_STR);
    $query->bindValue(':userPhone', $phone, PDO::PARAM_STR);
    $query->bindValue(':userMail', $email, PDO::PARAM_STR);
    $query->bindValue(':userCity', $city, PDO::PARAM_STR);
    $query->bindValue(':userStreet', $street, PDO::PARAM_STR);
    $query->bindValue(':userCp', $cp, PDO::PARAM_STR);
    $query->bindValue(':classId', $className, PDO::PARAM_INT);
    $query->execute();
}

// Récupération des classes
function getClasses($conn)
{
    $sql = "SELECT * FROM tblclass";
    $query = $conn->query($sql);
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
    return $classes;
}

// Récupération des élèves
function getStudents($conn)
{
    $sql = "SELECT u.userName, u.userSurname, c.className
            FROM tbluser u
            INNER JOIN tblclass c ON u.userId = c.classId";
    $result = $conn->prepare($sql);
    $result->execute();

    $students = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $students[] = $row;
    }

    $result->closeCursor();
    return $students;
}

// Suppression d'une classe
function deleteClass($conn, $classId)
{
    $deleteQuery = $conn->prepare("DELETE FROM tblclass WHERE classId = :classId");
    $deleteQuery->bindValue(':classId', $classId, PDO::PARAM_INT);
    $deleteQuery->execute();
}
