<?php
session_start();
function rollDice()
{
    return rand(1, 3);
}
if (!isset($_SESSION['diceA'])) {
    $_SESSION['diceA'] = 0;
}

if (!isset($_SESSION['diceB'])) {
    $_SESSION['diceB'] = 0;
}

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 'A';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['step'] === 'A') {
        $diceAValue = rand(1,3);
        echo "<p>Dice Value of A: ".$diceAValue."</p>";
        $_SESSION['diceA'] += $diceAValue;

        if ($_SESSION['diceA'] <= 8) {
            if ($_SESSION['diceA'] === 8) {
                session_destroy(); 
                echo "A WON !!!";
            }
            if (playerA()) {
                $_SESSION['diceB'] = 0; 
            }
        }

        if ($_SESSION['diceA'] > 8) {
            $_SESSION['diceA'] -= $diceAValue;
        }
        $_SESSION['step'] = 'B';

    } elseif ($_SESSION['step'] === 'B') {
        $diceBValue = rand(1,3);
        echo "<p>Dice Value of B: ".$diceBValue."</p>";
        $_SESSION['diceB'] += $diceBValue;
        if ($_SESSION['diceB'] <= 8) {
            if ($_SESSION['diceB'] === 8) {
                session_destroy(); 
                echo "B WON !!!";
            }
            if (playerB()) {
                $_SESSION['diceA'] = 0; 
            }
        }
        if ($_SESSION['diceB'] > 8) {
            $_SESSION['diceB'] -= $diceBValue;        
        }
        $_SESSION['step'] = 'A';
    }
}

function playerA()
{
    if ($_SESSION['diceA'] == 0 || $_SESSION['diceA'] == 4) {
        return false;
    } else if ($_SESSION['diceA'] == $_SESSION['diceB']) {
        return true;
    } else {
        return false;
    }
}

function playerB()
{
    if ($_SESSION['diceB'] == 0 || $_SESSION['diceB'] == 4) {
        return false;
    } else if ($_SESSION['diceB'] == $_SESSION['diceA']) {
        return true;
    } else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">

    <?php if ($_SESSION['step'] === 'A'): ?>
    <div class="board-container">
    <div class="board">
        <?php
        $diceAValue = $_SESSION['diceA'];
        $diceBValue = $_SESSION['diceB'];

        function getCellContent($cellValue, $diceAValue, $diceBValue) {
            $content = "";
            if ($cellValue == $diceAValue && $cellValue == $diceBValue) {
                $content = "AB";
            } elseif ($cellValue == $diceAValue) {
                $content = "A";
            } elseif ($cellValue == $diceBValue) {
                $content = "B";
            }
            return $content;
        }
        ?>
        <div class="cell" value="7">
            <span class="cell-content">
                <?php echo getCellContent(7, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="6">
            <span class="cell-content">
                <?php echo getCellContent(6, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="5">
            <span class="cell-content">
                <?php echo getCellContent(5, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="0">
            <span class="cell-content">
                <?php echo getCellContent(0, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="8">
            <span class="cell-content">
                <?php echo getCellContent(8, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="4">
            <span class="cell-content">
                <?php echo getCellContent(4, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="1">
            <span class="cell-content">
                <?php echo getCellContent(1, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="2">
            <span class="cell-content">
                <?php echo getCellContent(2, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="3">
            <span class="cell-content">
                <?php echo getCellContent(3, $diceAValue, $diceBValue); ?>
            </span>
        </div>
    </div>
</div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" class="dice-button" title="Roll Dice" onclick="rollDice()">
            <span>Click here</span>
            </button>
            
        </form>
    <?php elseif ($_SESSION['step'] === 'B'): ?>
    <div class="board-container">
    <div class="board">
        <?php
        $diceAValue = $_SESSION['diceA'];
        $diceBValue = $_SESSION['diceB'];

        function getCellContent($cellValue, $diceAValue, $diceBValue) {
            $content = "";
            if ($cellValue == $diceAValue && $cellValue == $diceBValue) {
                $content = "AB";
            } elseif ($cellValue == $diceAValue) {
                $content = "A";
            } elseif ($cellValue == $diceBValue) {
                $content = "B";
            }
            return $content;
        }
        ?>

<div class="cell" value="7">
            <span class="cell-content">
                <?php echo getCellContent(7, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="6">
            <span class="cell-content">
                <?php echo getCellContent(6, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="5">
            <span class="cell-content">
                <?php echo getCellContent(5, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="0">
            <span class="cell-content">
                <?php echo getCellContent(0, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="8">
            <span class="cell-content">
                <?php echo getCellContent(8, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="4">
            <span class="cell-content">
                <?php echo getCellContent(4, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="1">
            <span class="cell-content">
                <?php echo getCellContent(1, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="2">
            <span class="cell-content">
                <?php echo getCellContent(2, $diceAValue, $diceBValue); ?>
            </span>
        </div>
        <div class="cell" value="3">
            <span class="cell-content">
                <?php echo getCellContent(3, $diceAValue, $diceBValue); ?>
            </span>
        </div>
    </div>
</div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" class="dice-button" title="Roll Dice" onclick="rollDice()">
            <span>Click here</span>
            </button>
        </form>
    <?php endif; ?>
    </div>
</body>
</script>
</html>

