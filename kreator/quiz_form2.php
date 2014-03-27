<h2>Tworzenie zestawu - Krok 2</h2>
<h4>Nazwa zestawu: 
    <?php
    echo $_GET['name'];
    ?>
</h4>
<h5>Rodzaj gry: Quiz</h5>
<br>


<form id='quiz2' method="GET" action="kreator/quiz_ver2.php" class='form-horizontal'>
    <fieldset>
        <input class="hidden" type="text" name="p_id" id="P_id" value="<?php echo $_GET['p_id'] ?>">
        <input class="hidden" type="text" name="numb" id="Numb" value="<?php echo $_GET['numb'] ?>">
        <input class="hidden" type="text" name="name" id="Name" value="<?php echo $_GET['name'] ?>">

        <h4>Wypełnij poniższe pola swoimi pytaniami i odpowiedziami. Zaznacz, która odpowiedź jest poprawna.</h4>

        <?php
        $numb = $_GET['numb'];
        for ($i = 1; $i <= $numb; $i++) {
            echo'<div class="input-group">
        <span class="input-group-addon">Pytanie:</span>
        <input type="text" class="form-control" name="pytanie'.$i.'" id="pytanie'.$i.'" placeholder="Pytanie">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="checka'.$i.'" id="checka'.$i.'"/>
                </span>
                <input type="text" class="form-control" name="odpa'.$i.'" id="odpa'.$i.'" placeholder="Odpowiedź">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="checkb'.$i.'" id="checkb'.$i.'"/>
                </span>
                <input type="text" class="form-control" name="odpb'.$i.'" id="odpb'.$i.'" placeholder="Odpowiedź">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="checkc'.$i.'" id="checkc'.$i.'"/>
                </span>
                <input type="text" class="form-control" name="odpc'.$i.'" id="odpc'.$i.'" placeholder="Odpowiedź">
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="checkd'.$i.'" id="checkd'.$i.'"/>
                </span>
                <input type="text" class="form-control" name="odpd'.$i.'" id="odpd'.$i.'" placeholder="Odpowiedź">
            </div>
        </div>
    </div>
    <br>';
        }
        ?>

        <input class='btn btn-lg btn-success' value='Stwórz zestaw' type='submit'>

    </fieldset>
</form><!--form-->