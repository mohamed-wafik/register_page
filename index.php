<?php
require_once("db.php");
require_once("util.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $gender = $_POST['gender'] ?? "" ;
    $username = $_POST['username'];
    $password =$_POST['password'];
    $department = $_POST['department'];
    $skills = $_POST['skills'] ?? [];

    $errors = validation($first_name,$last_name,$address,$country,$gender,$username, $password,$department,$skills);

    if (empty($errors)) {
        $skills_str = implode("|" , $skills);
        try {
            $conn = new DB();
            $conn->create("users" , [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'address' => $address,
                'country' => $country,
                'gender' => $gender,
                'skills' => $skills_str,
                'username' => $username,
                'password' => $password,
                'department' => $department
            ]);
            header("location: list.php");
            exit;

        } catch (PDOException $e) {
            echo "<div class='message error'><span>!</span><p>{$e->getMessage()}</p></div>";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Register</h1>
        <div class="group-inputs">
            <div class="input-wrapper">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo isset($first_name) ? $first_name : ''?>" >
                <?php echo isset($errors["first_name"]) ? "<P class='error'>{$errors['first_name']}</p>" : ""  ?>
            </div>
            <div class="input-wrapper">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo isset($last_name) ? $last_name : ''?>">
                <?php echo isset($errors["last_name"]) ? "<P class='error'>{$errors['last_name']}</p>" : ""  ?>
            </div>
        </div>
        <div class="input-wrapper">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="3"><?php echo isset($address) ? $address : ''?></textarea>
            <?php echo isset($errors["address"]) ? "<P class='error'>{$errors['address']}</p>" : ""  ?>
        </div>
        <div class="group-inputs">
          <div class="input-wrapper">
            <label for="country">Country</label>
            <select name="country" id="country">
                <option value="usa" <?php echo (isset($country) && $country == "usa") ? 'selected' : ''; ?>>USA</option>
                <option value="uk" <?php echo (isset($country) && $country == "uk") ? 'selected' : ''; ?>>UK</option>
                <option value="canada" <?php echo (isset($country) && $country == "canada") ? 'selected' : ''; ?>>Canada</option>
                <option value="australia" <?php echo (isset($country) && $country == "australia") ? 'selected' : ''; ?>>Australia</option>
                <option value="india" <?php echo (isset($country) && $country == "india") ? 'selected' : ''; ?>>India</option>
                <option value="germany" <?php echo (isset($country) && $country == "germany") ? 'selected' : ''; ?>>Germany</option>
            </select>
            <?php echo isset($errors["country"]) ? "<P class='error'>{$errors['country']}</p>" : ""  ?>
        </div>
        <div class="input-wrapper">
            <label for="gender">Gender</label>
            <div>
                <input type="radio" value="male" name="gender" id="male" <?php echo (isset($gender) && $gender == "male") ? 'checked' : ''; ?>>
                <label for="male">male</label>
                <input type="radio" value="female" name="gender" id="female" <?php echo (isset($gender) && $gender == "female") ? 'checked' : ''; ?>>
                <label for="fmale">fmale</label>
            </div>
            <?php echo isset($errors["gender"]) ? "<P class='error'>{$errors['gender']}</p>" : ""  ?>
        </div>
        </div>

        <div class="input-wrapper">
            <label for="skills">Skills</label>
            <div>
                <input type="checkbox" value="php" name="skills[]" id="php" <?php echo (isset($skills) && in_array("php" , $skills)) ? 'checked' : ''; ?>>
                <label for="php">PHP</label>
                <input type="checkbox" value="J2SE" name="skills[]" id="J2SE" <?php echo (isset($skills) && in_array("J2SE" , $skills)) ? 'checked' : ''; ?>>
                <label for="J2SE">J2SE</label>
                <input type="checkbox" value="mysql" name="skills[]" id="mysql" <?php echo (isset($skills) && in_array("mysql" , $skills)) ? 'checked' : ''; ?>>
                <label for="mysql">MySQL</label>
                <input type="checkbox" value="postgreeSQL" name="skills[]" id="postgreeSQL" <?php echo (isset($skills) && in_array("postgreeSQL" , $skills)) ? 'checked' : ''; ?>>
                <label for="postgreeSQL">PostgreeSQL</label>
            </div>
            <?php echo isset($errors["skills"]) ? "<P class='error'>{$errors['skills']}</p>" : ""  ?>
        </div>
        <div class="input-wrapper">
            <label for="username">username</label>
            <input type="text" name="username" id="username" value="<?php echo isset($username) ? $username : ''?>" >
            <?php echo isset($errors["username"]) ? "<P class='error'>{$errors['username']}</p>" : ""  ?>
        </div>
        <div class="input-wrapper">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php echo isset($password) ? $password : ''?>">
            <?php echo isset($errors["password"]) ? "<P class='error'>{$errors['password']}</p>" : ""  ?>
        </div>
        <div class="input-wrapper">
            <label for="department">department</label>
            <input type="text" name="department" id="department" value="IT" readonly >
        </div>
        <div class="input-wrapper controls">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</body>
</html>