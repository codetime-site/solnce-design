<?php
try {
    $number = 10;
    if ($number > 5) {
        throw new Exception("Число слишком большое!");
    }
    echo "Код после throw не выполнится.";
} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
} finally {
    echo "\nЭтот код выполнится всегда.";
}
?>