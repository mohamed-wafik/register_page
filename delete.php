<?php
    require_once("db.php");
    if (isset($_GET["id"])) {
        try {
            $conn = new DB();
            $id = $_GET["id"];
            $sql = $conn->delete("users","id = $id");
            header("Location: list.php");
            exit;
        } catch (PDOException $e) {
            echo "<div class='message error'><span>!</span><p>{$e->getMessage()}</p></div>";
        }
    }
?>
