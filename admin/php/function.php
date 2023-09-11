<?php

require_once "../../connexion/connect.php";
// Ajout d'une classe
function addClass(PDO $conn, string $className, string $classDesc): void
{
    $sql = 'INSERT INTO tblclass (className, classDesc) VALUES (:className, :classDesc)';
    $query = $conn->prepare($sql);
    $query->bindValue(':className', $className, PDO::PARAM_STR);
    $query->bindValue(':classDesc', $classDesc, PDO::PARAM_STR);
    $query->execute();
}

// Verification de doublon d'email
function checkDuplicateEmail(PDO $conn, string $email): bool
{
    $sql = 'SELECT COUNT(*) FROM tbluser WHERE userMail = :email';
    $query = $conn->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();

    $count = $query->fetchColumn();

    return $count > 0;
}

// Verification de doublon numero de telephone
function checkDuplicatePhone(PDO $conn, string $phone): bool
{
    $sql = 'SELECT COUNT(*) FROM tbluser WHERE userPhone = :phone';
    $query = $conn->prepare($sql);
    $query->bindValue(':phone', $phone, PDO::PARAM_STR);
    $query->execute();

    $count = $query->fetchColumn();

    return $count > 0;
}

// Ajout d'un élève
function addUser(PDO $conn, User $user, string $role, ?int $className = null): void
{
    $emailExists = checkDuplicateEmail($conn, $user->email);
    $phoneExists = checkDuplicatePhone($conn, $user->phone);

    if ($emailExists) {
        // Afficher un message d'erreur pour l'adresse e-mail existante
        echo "L'adresse e-mail existe déjà.";
        return;
    }

    if ($phoneExists) {
        // Afficher un message d'erreur pour le numéro de téléphone existant
        echo "Le numéro de téléphone existe déjà.";
        return;
    }

    $sql = 'INSERT INTO tbluser (userSurname, userName, userAge, userPhone, userMail, userCity, userStreet, userCp, classId, userPwd, role, userImage) VALUES (:userSurname, :userName, :userAge, :userPhone, :userMail, :userCity, :userStreet, :userCp, :classId, :userPwd, :role, :userImage)';

    $query = $conn->prepare($sql);

    $query->bindValue(':userSurname', $user->surname, PDO::PARAM_STR);
    $query->bindValue(':userName', $user->name, PDO::PARAM_STR);
    $query->bindValue(':userAge', $user->age, PDO::PARAM_INT);
    $query->bindValue(':userPhone', $user->phone, PDO::PARAM_STR);
    $query->bindValue(':userMail', $user->email, PDO::PARAM_STR);
    $query->bindValue(':userCity', $user->city, PDO::PARAM_STR);
    $query->bindValue(':userStreet', $user->street, PDO::PARAM_STR);
    $query->bindValue(':userCp', $user->cp, PDO::PARAM_STR);
    $query->bindValue(':userPwd', $user->passwordHash, PDO::PARAM_STR);
    $query->bindValue(':role', $role, PDO::PARAM_STR);
    $query->bindValue(':userImage', $user->userImage, PDO::PARAM_STR);

    // Bind the className parameter if it is provided
    if ($className !== null) {
        $query->bindValue(':classId', $className, PDO::PARAM_INT);
    } else {
        $query->bindValue(':classId', null, PDO::PARAM_NULL);
    }

    $query->execute();

    if (createUserFolder($user->surname, $user->name)) {
        echo "Dossier créé pour l'utilisateur : " . $user->surname . ' ' . $user->name;
    } else {
        echo "Échec de la création du dossier pour l'utilisateur : " . $user->surname . ' ' . $user->name;
    }
}

// Récupération des classes
function getClasses(PDO $conn): array
{
    $sql = "SELECT * FROM tblclass WHERE archived = 0";
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
function getStudentById(PDO $conn, int $studentId): ?array
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
function getClassById(PDO $conn, int $classId): ?array
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
    public $role;
    public $userImage;
    public function __construct($surname, $name, $age, $phone, $email, $city, $street, $cp, $className, $passwordHash, $userImage)
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
        $this->userImage = $userImage;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
}

function getUserByEmail($email, $conn)
{
    $sql = "SELECT * FROM tbluser WHERE userMail = :userMail";
    $query = $conn->prepare($sql);
    $query->bindValue(':userMail', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    return $user;
}
function getAdminStudents($conn, $searchTerm)
{
    $searchTerm = '%' . $searchTerm . '%';
    $sql = "SELECT u.*, c.className FROM tbluser u JOIN tblclass c ON u.classId = c.classId WHERE u.role = 'admin' AND (u.userSurname LIKE :search OR u.userName LIKE :search OR c.className LIKE :search)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Récupérer les détails d'un utilisateur par son identifiant
function getUserStudents($conn, $searchTerm)
{
    $searchTerm = '%' . $searchTerm . '%';
    $sql = "SELECT u.*, c.className FROM tbluser u JOIN tblclass c ON u.classId = c.classId WHERE u.role = 'user' AND (u.userSurname LIKE :search OR u.userName LIKE :search OR c.className LIKE :search)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Créer un dossier pour un utilisateur
function createUserFolder(string $surname, string $name): bool
{
    $folderName = $surname . '_' . $name;
    $path = '../uploads/' . $folderName;

    // Vérifier si le dossier existe déjà
    if (is_dir($path)) {
        return false; // Le dossier existe déjà
    }

    // Créer le dossier
    if (!mkdir($path, 0777, true)) {
        return false; // Impossible de créer le dossier
    }

    return true; // Dossier créé avec succès
}

// Fonction pour récupérer les informations de l'utilisateur depuis la table "tbluser"
function getUserData($userId)
{
    global $conn;

    $query = "SELECT userSurname AS prenom, userName AS nom FROM tbluser WHERE userId = :userId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour enregistrer un nouveau document dans la base de données
function addDocument($filename, $filepath, $userId)
{
    global $conn;

    $query = "INSERT INTO tbldocument (filename, filepath, user_id) VALUES (:filename, :filepath, :user_id)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':filename', $filename);
    $stmt->bindParam(':filepath', $filepath);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

// Fonction pour récupérer les documents de l'utilisateur depuis la table "tbldocument"
function getUserDocuments($userId)
{
    global $conn;

    $sql = "SELECT * FROM tbldocument WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function archiveClass($conn, $classId)
{
    $query = $conn->prepare("UPDATE tblclass SET archived = 1 WHERE classId = :classId");
    $query->bindValue(':classId', $classId, PDO::PARAM_INT);

    return $query->execute();
}
function getArchivedClasses(PDO $conn): array
{
    $sql = "SELECT * FROM tblclass WHERE archived = 1";
    $query = $conn->query($sql);
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
    return $classes;
}

// Suppression d'un utilisateur
function deleteUser(PDO $conn, int $userId): void
{
    $sql = "DELETE FROM tbluser WHERE userId = :userId";
    $query = $conn->prepare($sql);
    $query->bindValue(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
}

// Suppression d'une classe
function deleteClass(PDO $conn, int $classId): void
{
    $sql = "DELETE FROM tblclass WHERE classId = :classId";
    $query = $conn->prepare($sql);
    $query->bindValue(':classId', $classId, PDO::PARAM_INT);
    $query->execute();
}

// Récupération des utilisateurs archivés
function getArchivedUsers(PDO $conn): array
{
    $sql = "SELECT * FROM tbluser WHERE archived = 1";
    $query = $conn->query($sql);
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

// Récupération d'un utilisateur par son numéro de téléphone
function getUserByPhone(PDO $conn, string $phone): ?array
{
    $sql = "SELECT * FROM tbluser WHERE userPhone = :phone";
    $query = $conn->prepare($sql);
    $query->bindValue(':phone', $phone, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}
function getAbsenceCount($studentId)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS absence_count FROM tblabsent WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $studentId, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['absence_count'];
}

function getSentDocuments($studentId)
{
    global $conn;

    $sql = "SELECT tbldocument.document_name as name, tbldocument.uploaded_at as date, 'Document' as type
            FROM tbldocument
            WHERE user_id = ?
            UNION ALL
            SELECT tblabsent.justification as name, tblabsent.date as date, 'Absence' as type
            FROM tblabsent
            WHERE userId = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $studentId, PDO::PARAM_INT);
    $stmt->bindValue(2, $studentId, PDO::PARAM_INT);
    $stmt->execute();

    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $documents;
}

function addAbsenceRequest($studentId, $adminId)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tblAbsenceRequest (userId, adminId, requestedAt) VALUES (?, ?, NOW())");
    $stmt->execute(array($studentId, $adminId));
}

function getUnjustifiedAbsenceRequests($userId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM tblAbsenceRequest WHERE userId = ? AND status = 'requested'");
    $stmt->execute(array($userId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function justifyAbsenceRequest($userId, $documentPath)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE tblAbsenceRequest SET status = 'justified', justificationDocument = ? WHERE userId = ? AND status = 'requested' LIMIT 1");
    $stmt->execute(array($documentPath, $userId));
}

function getRequestedDocuments($userId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM tblAbsenceRequest WHERE userId = ? AND status = 'requested'");
    $stmt->execute(array($userId));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
