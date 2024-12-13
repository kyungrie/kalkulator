<?php
    $current=$_POST['display']?? '';
    $button=$_POST['button']?? '';
    $history=$_POST['history']?? '';


        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['clear_history'])) {
                $history = '';
                $current = '';
            } elseif ($button === 'C'){
                $current = '';
            } elseif ($button === '=') {
                try{
                    $result = eval("return $current;");
                    $history = $current.'='.$result.PHP_EOL;
                    $current = $result;
                } catch (Exception $e) {
                    $current = 'Error';
                }
            } else {
                $current .=$button;
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Analog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="calculator bg-light">
            <div class="card">
                <label class="form-check-label ms-2 col-form-label-sm">Theme</label>
                <div class="form-check form-switch d-inline-block ms-2">
                    <input type="checkbox" class="form-check-input" id="themeToggle">
                </div>
                <div class="card-header text-center bg-primary text-white">
                    <h4>Kalkulator Analog</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="text" class="form-control mb-3 display" name="display" id="display" readonly value="<?php echo $current; ?>">
                        <div class="row g-2 mb-3">
                            <?php
                                $buttons = [
                                    ['7','8','9','/'],
                                    ['4','5','6','*'],
                                    ['1','2','3','-'],
                                    ['0','C','=','+']
                                ];
                                foreach ($buttons as $row) {
                                    foreach ($row as $btn) {
                                        $class = 'btn-number';
                                        if (in_array($btn,['/','*','-','+','='])) {
                                            $class = 'btn-operator';
                                        } elseif ($btn === 'C') {
                                            $class = 'btn-clear';
                                        }
                                        echo '<div class="col-3">';
                                        echo '<button type="submit" name="button" value="'.$btn.'" class="btn'.$class.' w-100"> '.$btn.' </button>';
                                        echo '</div>';
                                    }

                                }
                            ?>
                        </div>
                        <textarea class="form-control mb-3" name="history" rows="5" style="resize: none;" readonly><?php echo  htmlspecialchars($history, ENT_QUOTES) ?>
                        </textarea>
                        <button type="submit" name="clear_history" class="btn btn-clear-history w-100">Clear History</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
