<?php
    require_once("db.php");
    if (isset($_GET["id"])) {
        try {
            $id = $_GET["id"];
            $sql = $conn->prepare("DELETE FROM users WHERE id = :id");
            $sql->execute([":id" => $id]);
            header("Location: list.php");
            exit;
        } catch (PDOException $e) {
            echo "<div class='message error'><span>!</span><p>{$e->getMessage()}</p></div>";
        }
    }
?>
