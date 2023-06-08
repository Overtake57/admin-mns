<?php
// Ajout d'une classe
function addClass(PDO $conn, string $className, string $classDesc): void
{
    $sql = 'INSERT INTO tblclass (className, classDesc) VALUES (:className, :classDesc)';

    $query = $conn->prepare($sql);

    $query->bindValue(':className', $className, PDO::PARAM_STR);
    $query->bindValue(':classDesc', $classDesc, PDO::PARAM_STR);

    $query->execute();
}

// Ajout d'un élève
function addUser(PDO $conn, User $user): void
{
    $sql = 'INSERT INTO tbluser (userSurname, userName, userAge, userPhone, userMail, userCity, userStreet, userCp, classId, userPwd) VALUES (:userSurname, :userName, :userAge, :userPhone, :userMail, :userCity, :userStreet, :userCp, :classId, :userPwd)';

    $query = $conn->prepare($sql);

    $query->bindValue(':userSurname', $user->surname, PDO::PARAM_STR);
    $query->bindValue(':userName', $user->name, PDO::PARAM_STR);
    $query->bindValue(':userAge', $user->age, PDO::PARAM_INT);
    $query->bindValue(':userPhone', $user->phone, PDO::PARAM_STR);
    $query->bindValue(':userMail', $user->email, PDO::PARAM_STR);
    $query->bindValue(':userCity', $user->city, PDO::PARAM_STR);
    $query->bindValue(':userStreet', $user->street, PDO::PARAM_STR);
    $query->bindValue(':userCp', $user->cp, PDO::PARAM_STR);
    $query->bindValue(':classId', $user->className, PDO::PARAM_INT);
    $query->bindValue(':userPwd', $user->passwordHash, PDO::PARAM_STR);

    $query->execute();
}
// Récupération des classes
function getClasses(PDO $conn): array
{
    $sql = "SELECT * FROM tblclass";
    $query = $conn->query($sql);
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
    return $classes;
}

// Récupération des élèves
function getStudents(PDO $conn): array
{
    $sql = "SELECT u.userId, u.userName, u.userSurname, c.className
            FROM tbluser u
            INNER JOIN tblclass c ON u.classId = c.classId";
    $query = $conn->query($sql);
    $students = $query->fetchAll(PDO::FETCH_ASSOC);
    return $students;
}

// Récupération d'un élève par son ID
function getStudentById(PDO $conn, int $studentId):  ? array
{
    $sql = "SELECT * FROM tbluser WHERE userId = :studentId";
    $query = $conn->prepare($sql);
    $query->bindValue(':studentId', $studentId, PDO::PARAM_INT);
    $query->execute();
    $student = $query->fetch(PDO::FETCH_ASSOC);
    return $student ?: null;
}

// Mise à jour des détails d'un élève
function updateStudentDetails(PDO $conn, int $studentId, string $surname, string $name, int $age, string $phone, string $email, string $city, string $street, string $cp, int $className): void
{
    $sql = 'UPDATE tbluser
            SET userSurname = :surname,
                userName = :name,
                userAge = :age,
                userPhone = :phone,
                userMail = :email,
                userCity = :city,
                userStreet = :street,
                userCp = :cp,
                classId = :className
            WHERE userId = :studentId';
    $query = $conn->prepare($sql);

    $query->bindValue(':surname', $surname, PDO::PARAM_STR);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':age', $age, PDO::PARAM_INT);
    $query->bindValue(':phone', $phone, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':city', $city, PDO::PARAM_STR);
    $query->bindValue(':street', $street, PDO::PARAM_STR);
    $query->bindValue(':cp', $cp, PDO::PARAM_STR);
    $query->bindValue(':className', $className, PDO::PARAM_INT);
    $query->bindValue(':studentId', $studentId, PDO::PARAM_INT);

    $query->execute();
}

// Récupérer les détails d'une classe par son identifiant
function getClassById(PDO $conn, int $classId):  ? array
{
    $query = "SELECT * FROM tblclass WHERE classId = :classId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
    $stmt->execute();

    $class = $stmt->fetch(PDO::FETCH_ASSOC);

    return $class ?: null;
}

// Mettre à jour les détails d'une classe dans la base de données
function updateClass(PDO $conn, int $classId, string $className, string $classDesc): void
{
    $query = "UPDATE tblclass SET className = :className, classDesc = :classDesc WHERE classId = :classId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
    $stmt->bindParam(':className', $className, PDO::PARAM_STR);
    $stmt->bindParam(':classDesc', $classDesc, PDO::PARAM_STR);
    $stmt->execute();
}

//TODO Archiver une classe dans la base de données
// function archiveClass(PDO $conn, int $classId): void
// {
//     $query = "UPDATE tblclass SET isArchived = 1 WHERE classId = :classId";
//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
//     $stmt->execute();
// }

//TODO Restaurer une classe archivée dans la base de données
// function restoreClass(PDO $conn, int $classId): void
// {
//     $query = "UPDATE tblclass SET isArchived = 0 WHERE classId = :classId";
//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':classId', $classId, PDO::PARAM_INT);
//     $stmt->execute();
// }

function randomPassword($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

function passwordHash($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

class User
{
    public $surname;
    public $name;
    public $age;
    public $phone;
    public $email;
    public $city;
    public $street;
    public $cp;
    public $className;
    public $passwordHash;

    public function __construct($surname, $name, $age, $phone, $email, $city, $street, $cp, $className, $passwordHash)
    {
        $this->surname = $surname;
        $this->name = $name;
        $this->age = $age;
        $this->phone = $phone;
        $this->email = $email;
        $this->city = $city;
        $this->street = $street;
        $this->cp = $cp;
        $this->className = $className;
        $this->passwordHash = $passwordHash;
    }
}
